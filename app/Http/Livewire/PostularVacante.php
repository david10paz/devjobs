<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    public $cv;
    public $vacante;

    use WithFileUploads;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function render()
    {
        return view('livewire.postular-vacante');
    }

    public function mount(Vacante $vacante){
        $this->vacante = $vacante;
    }

    public function postularme(){
        $this->validate();

        ////Almacenar CV en el el proyecto
        //La guardamos en el proyecto
        $cv = $this->cv->store('public/cv');
        //Queremos solo el nombre generado para la imagen así que le quitamos el public/vacantes/ del nombre que tiene $imagen
        $cvName = str_replace('public/cv/', '', $cv);

        ////Crear la solicitud del candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $cvName
        ]);

        ////Crear notificación y enviamos un email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        ////Mensaje y redireccionamos
        session()->flash('mensaje', 'La solicitud a la vacante se envió correctamente');
        return redirect()->back();

    }
}
