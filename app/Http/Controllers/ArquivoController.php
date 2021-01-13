<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boletim;
use App\Mes;

class ArquivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $destaque = Boletim::orderBy('ano', 'desc')->orderBy('mes_id', 'desc')->limit(10)->get()->last();

        $meses_destaque = Boletim::select('mes_id')
                                        ->where('ano', $destaque['ano'])
                                        ->groupBy('mes_id')
                                        ->orderBy('mes_id', 'desc')
                                        ->get();

        $anos_boletins = Boletim::select('ano')
                                        ->groupBy('ano')
                                        ->orderBy('ano', 'desc')
                                        ->get();

        return view('arquivo', compact(['destaque', 'meses_destaque', 'anos_boletins']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexJson($mes = 0, $ano)
    {
        if(!$mes){
            $mesesBoletim = Boletim::select('mes_id')
                                        ->where('ano', $ano)
                                        ->groupBy('mes_id')
                                        ->orderBy('mes_id', 'desc')
                                        ->get();
            return json_encode($mesesBoletim);
        }

        $boletim = Boletim::select('id', 'mes_id', 'ano', 'numero_paginas', 'numero_visualizacoes', 'created_at')->where('ano', $ano)->where('mes_id', $mes)->get();
        return json_encode($boletim);
    }
}
