<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public $termino;
    public $categoria;
    public $salario;

    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        //No utilizamos where directamente porque estan vacios cuando cargan de un principio, con el when le decimos que cuando haya algo introducido
        $vacantes = Vacante::when($this->termino, function ($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
            ->when($this->categoria, function ($query) {
                $query->where('categoria_id', $this->categoria);
            })
            ->when($this->salario, function ($query) {
                $query->where('salario_id', $this->salario);
            })
            ->orderBy('created_at', 'desc')->get();

        return view('livewire.home-vacantes', ['vacantes' => $vacantes]);
    }
}
