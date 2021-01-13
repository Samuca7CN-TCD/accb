<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boletim;
use App\Mes;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ultimos_boletins = Boletim::orderBy('ano', 'desc')->orderBy('mes_id', 'desc')->limit(9)->get();
        $ultimo_boletim = $ultimos_boletins->first();
        return view('index', compact(['ultimos_boletins', 'ultimo_boletim']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novo-boletim');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate([
            'arquivo' => 'required|mimes:pdf',
        ]);

        if($request->file('arquivo')->getSize() > 2147483647)
            return "O arquivo enviado é muito grande! Tente outro...";

        $f = $request->file('arquivo');
        if($f){
            $conteudo_arquivo = file_get_contents($f->getRealPath());
            $nome_arquivo = $f->getClientOriginalName();
            $tipo_arquivo = $f->getMimeType();
            $verif = Boletim::where('mes_id', $request->input('mes'))->where('ano', $request->input('ano'))->get();
            if(!count($verif)){
                $boletim = new Boletim;
                $boletim->mes_id = $request->input('mes');
                $boletim->ano = $request->input('ano');
                $boletim->numero_paginas = $request->input('numeroPaginas');
                $boletim->numero_visualizacoes = $request->input('numeroVisualizacoes');
                $boletim->boletim = $conteudo_arquivo;
                $boletim->tipo_boletim = $tipo_arquivo;
                $boletim->titulo_boletim = $nome_arquivo;
                $boletim->save();
            }else{
                return "Já cadastrado!";
            }
        }else{
            return "Nenhum arquivo enviado! Tente de novo...";
        }
        return redirect('/');
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
    public function atribuirVisualizacao($id){
        if(isset($id)){
            $boletim = Boletim::find($id);
            $boletim->numero_visualizacoes += 1;
            $boletim->save();
            return 1;
        }else{
            return 0;
        }
    }

    public function verPDF($id){
        if($id){
            $info = Boletim::find($id);

            if(!empty($info)){
                $boletim = $info->boletim;

                return response($boletim)
                        ->header('Content-Transfer-Encoding', 'binary')
                        ->header('Cache-Control', 'no-cache private')
                        ->header('Content-Description', 'File Transfer')
                        ->header('Content-length', strlen($boletim))
                        ->header('Content-Disposition', 'inline; filename=' . $info->nome_boletim)
                        ->header('Content-Type', $info->tipo_boletim);

                /* Código para conferir os dados do boletim

                $dados = "";
                $dados .= "<ul>";
                    $dados .= "<li>ID: ". $id ."</li>";
                    $dados .= "<li>TAMANHO DO BLOB: ". strlen($arquivo) ."</li>";
                    $dados .= "<li>NOME: ". $info->nome_arquivo ."</li>";
                    $dados .= "<li>TIPO: ". $info->tipo_arquivo ."</li>";
                    $dados .= "<li>BLOB: ". $arquivo ."</li>";
                $dados .= "</ul>";
                return $dados;
                */
            }
        }
        return redirect('/');
    }
}
