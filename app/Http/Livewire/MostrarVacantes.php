<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(2);

        return view('livewire.mostrar-vacantes', ['vacantes' => $vacantes]);
    }
}
