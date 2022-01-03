@extends('layouts.app', ["current" => "arquivo"])

@section('body')

<style type="text/css">
    form{
        width: 100%;
    }
    form .form-group{
        max-width: 500px;
    }

    .boletins_anteriores, .formularios, .loading{
        width: 100%;
    }

    .boletim_area{
        background-color: rgb(52, 58, 64);
        font-size: 5vw;
        color: white;
        text-align: center;
        width:100%;
        height: 250px;
        display: table;
        background-image: url('storage/imagens/fixas/background-black-triangles.png');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #boletim_title{
        text-align: center;
        vertical-align:middle;
        display:table-cell;
    }

    #carregamento{
        display:none;
    }
</style>

<div class="row formularios">
    <div class="col-6">
        <form method="GET" action="arquivo">
            <div class="form-group mx-auto m-5">
                <label for="ano">Selecione o ano desejado</label>
                <select id="ano" name="ano" class="custom-select data-boletim" onchange="this.form.submit();">
                @foreach($anos_boletins as $oneAno) 
                    @if($oneAno->ano == $ano)
                        <option value="{{ $oneAno->ano }}" selected="selected" >{{ $oneAno->ano }}</option>
                    @else
                        <option value="{{ $oneAno->ano }}">{{ $oneAno->ano }}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </form>
    </div> 
</div>    


<div class="row m-5 boletins_anteriores">
    @if(!count($boletins))
        <div class="alert alert-info" role="alert">
            Não há boletins dos anos anteriores cadastrados {{ count($boletins)  }}
        </div>
    @else
        @foreach($boletins as $boletim)
            <div class="col-sm-12 col-md-4 col-lg-3 m-3 boletim-item">
                <div class="card mx-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($boletim->mes->nome) }} {{ strval($boletim->ano) }}</h5>
                        @if($boletim->especial == NULL)
                            <h6 class="card-subtitle mb-2 text-muted">Boletim ACCB/UESC, ano {{ strval($boletim->ano) - 2003 }}, n. {{$boletim->mes->numeracao}} </h6>
                        @else
                            <h6 class="card-subtitle mb-2 text-muted">{{$boletim->especial}}</h6>
                        @endif    
                        <p class="card-text">
                            Informações básicas:<br />
                            <strong>Número de páginas:</strong> <span>{{ $boletim->numero_paginas }}</span> <br />
                            <strong>Número de visualizações:</strong> <span data-boletim="quantidade-visualizacoes-{{ $boletim->id }}">{{ $boletim->numero_visualizacoes }}</span>
                        </p>
                        <a id="linkAnt{{ $boletim->id }}" href="/{{ $boletim->id }}" target="_blank" class="card-link doc_boletim_small">Ver boletim</a>
                    </div>
                </div>
            </div>
        @endforeach
    {{--<div class="col-sm-12 col-md-6">
        <ul class="list-group detalhes_boletim">            
            <li class="list-group-item info-item"><strong><span data-boletim="subtitulo">Boletim ACCB/UESC, ano {{ strval($destaque->ano) - 2003 }}, n. {{$destaque->mes->numeracao}}, {{ $destaque->mes->nome }} {{ strval($destaque->ano) }}</span></strong></li>
            <li class="list-group-item info-item"><strong>Data de publicação:</strong> <span data-boletim="data-publicacao">{{ date('d/m/Y \à\s H:i', strtotime($destaque->updated_at)) }}</span></li>
            <li class="list-group-item info-item"><strong>Número de páginas:</strong> <span data-boletim="numero-paginas">{{ $destaque->numero_paginas }} páginas</span></li>
            <li class="list-group-item info-item"><strong>Quantidade de visualizações:</strong>
                <span data-boletim="quantidade-visualizacoes-{{ $destaque->numero_visualizacoes }}">{{ $destaque->numero_visualizacoes }}
                @if($destaque->numero_visualizacoes != 1)    
                    visualizações
                @else
                    visualização
                @endif
                </span>
            </li>
            <li class="list-group-item a-item">
                <a id="linkAnt{{ $destaque->id }}" href="/{{ $destaque->id }}" target="_blank" class="btn btn-outline-info doc_boletim">Ver boletim</a>
                <a id="linkAnt{{ $destaque->id }}" href="/{{ $destaque->id }}" target="_blank" class="btn btn-outline-secondary doc_boletim" download="Boletim ACCB {{ ucfirst( $destaque->mes->nome ) }} de {{ strval($destaque->ano) }}">Baixar boletim</a>
                <span id="carregamento">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </span>
            </li>
        </ul>
    </div>--}}
    @endif
</div>
@endsection

