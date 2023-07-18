<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Le decimos que solo vea el modelo de Vacantes quien tenga de rol el numero 2 (Recruiters) que son los que
        //pueden crear, editar, borrar... las vacantes
        //MIRAR EN VacantePolicy DENTRO DE Policies: Policies/VacantePolicy

        $this->authorize('viewAny', Vacante::class);

        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Le decimos que solo puede crear el modelo de Vacantes quien tenga de rol el numero 2 (Recruiters) que son los que
        //pueden crear, editar, borrar... las vacantes
        //MIRAR EN VacantePolicy DENTRO DE Policies: Policies/VacantePolicy

        $this->authorize('create', Vacante::class);

        return view('vacantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {

        $candidatoYaPresentado = false;
        $candidatoYaPresentadoQuery = DB::table('candidatos')->where('user_id', auth()->user()->id)->where('vacante_id', $vacante->id)->first();
        
        if($candidatoYaPresentadoQuery){
            $candidatoYaPresentado = true;
        }

        return view('vacantes.show', ['vacante' => $vacante, 'candidatoPresentado' => $candidatoYaPresentado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        //Le dejamos ver la pagina de editar si el usuario registrado es el mismo que esta registrado como creador de la vacante
        //Mirar la función update dentro de Policies/VacantePolicy.php
        $this->authorize('update', $vacante);

        return view('vacantes.edit', ['vacante' => $vacante]);
    }
}
