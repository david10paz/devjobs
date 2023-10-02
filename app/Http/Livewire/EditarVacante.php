<?php

namespace App\Http\Livewire;

use App\Models\Paises;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Ciudades;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{

    public $vacante_id;

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ciudad;
    public $pais;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagenNueva;

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
        'imagenNueva' => 'nullable|image|max:1024',
    ];


    public function render()
    {

        //Consultar BBDD para enviar información
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', ['salarios' => $salarios, 'categorias' => $categorias]);
    }

    public function mount(Vacante $vacante){
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ciudad = $vacante->ciudad_id;
        $this->ultimo_dia = $vacante->ultimo_dia;
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;

        $ciudadInfo = Ciudades::where('id', $vacante->ciudad_id)->first();
        $paisInfo = Paises::where('id', $ciudadInfo->paises_id)->first();
        $this->pais = $paisInfo->id;

        $this->paises = Paises::all();
        $this->ciudades = Ciudades::where('paises_id', $paisInfo->id)->get();
    }

    public function updatedPais($value){
        $this->ciudades = Ciudades::where('paises_id', $value)->get();
        $this->ciudad = $this->ciudades->first()->id ?? null;
        //dd($ciudades->count());
    }

    public function editarVacante(){
        $datos = $this->validate();

        //Si hay una imagen

        if($this->imagenNueva){
            $imagenNuevaGuardada = $this->imagenNueva->store('public/vacantes');
            $nombreImagen = str_replace('public/vacantes/', '', $imagenNuevaGuardada);
        }

        //Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        //dd($datos);

        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ciudad_id = $datos['ciudad'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];        
        $vacante->imagen = $nombreImagen ?? $vacante->imagen;        

        //Guardar la vacante
        $vacante->save();

        //Mensaje y Redireccionar
        session()->flash('mensaje', 'La vacante se actualizó correctamente');
        return redirect()->route('vacantes.index');

    }
}
