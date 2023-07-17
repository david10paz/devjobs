<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{

    public $vacante_id;

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagenNueva;

    use WithFileUploads;


    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
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
        $this->ultimo_dia = $vacante->ultimo_dia;
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
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

        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
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
