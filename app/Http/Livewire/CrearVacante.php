<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Ciudades;
use App\Models\Paises;
use App\Models\Vacante;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $pais;
    public $ciudad;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    public $paises;
    public $ciudades;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'pais' => 'required',
        'ciudad' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];

    public function mount(){
        $this->paises = Paises::all();
        $this->ciudades = collect();
    }

    public function render()
    {

        //Consultar BBDD para enviar información
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', ['salarios' => $salarios, 'categorias' => $categorias]);
    }

    public function updatedPais($value){
        $this->ciudades = Ciudades::where('paises_id', $value)->get();
        $this->ciudad = $this->ciudades->first()->id ?? null;
        //dd($ciudades->count());
    }

    public function crearVacante()
    {
        $datos = $this->validate();

        ////Almacenar la imagen////
        //La guardamos en el proyecto
        $imagenGuardada = $this->imagen->store('public/vacantes');
        //Queremos solo el nombre generado para la imagen así que le quitamos el public/vacantes/ del nombre que tiene $imagen
        $nombreImagen = str_replace('public/vacantes/', '', $imagenGuardada);

        ////Crear la vacante////
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ciudad_id' => $datos['ciudad'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombreImagen,
            'user_id' => auth()->user()->id,
        ]);

        ////Mandar un mensaje
        session()->flash('mensaje', 'La vacante se publicó correctamente');

        ////Redireccionar al usuario
        return redirect()->route('vacantes.index');

    }
}
