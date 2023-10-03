<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class CandidatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vacante $vacante, Request $request)
    {
        if($request->notificacion != null){
            auth()->user()->unreadNotifications->where('id', $request->notificacion)->markAsRead();
        }
        return view('candidatos.index', ['vacante' => $vacante]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(auth()->user()->id == $user->id){

            $candidaturas_solicitadas = Candidato::where('user_id', $user->id)->get();
            $vacantes_solicitadas = array();

            foreach($candidaturas_solicitadas as $candidatura){
                $vacante = Vacante::select('id','titulo', 'empresa')->where('id', $candidatura->vacante_id)->first();
                $vacante->rechazado = $candidatura->rechazado;
                array_push($vacantes_solicitadas, $vacante);
            }

            //dd($vacantes_solicitadas);

            return view('candidatos.mis-candidaturas', ['vacantes_solicitadas' => $vacantes_solicitadas, 'candidaturas_solicitadas' => $candidaturas_solicitadas]);
        }
        else{
            return back();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }

    public function rechazar(Vacante $vacante, User $user)
    {
        if(auth()->user()->id == $vacante->user_id){
            Candidato::where('vacante_id', $vacante->id)->where('user_id', $user->id)->update(['rechazado' => 1]);
            return back();
        }
        else{
            return back();
        }
    }
}
