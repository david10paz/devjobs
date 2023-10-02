<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{

    //para que sepa que lo va a escuchar como una llamada
    protected $listeners = ['eliminarVacante'];

    public function eliminarVacante(Vacante $vacante){
        $vacante->delete();
    }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(2);

        return view('livewire.mostrar-vacantes', ['vacantes' => $vacantes]);
    }
}
