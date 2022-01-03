@extends('layouts.app', ["current" => "home"])

@section('body')


<style type="text/css">
    .apresentacao{
        font-size: 18px;
        color: rgb(52, 58, 64);
    }

    .apresentacao h3{
        font-size: 30px;
    }

    .boletim_do_mes{
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

    #boletim_atual_title{
        text-align: center;
        vertical-align:middle;
        display:table-cell;
    }

    .boletim-item{
        min-width: 300px;
        height: 200px;
    }

    #carregamento{
        display:none;
    }
</style>

<div class="row m-5 apresentacao">
    <div class="col-12">
        <h3>Apresentação</h3>
    </div>
    <div class="col-12 text-justify">
        <p>O boletim ACCB/UESC é uma produção do Projeto Acompanhamento do Custo da Cesta Básica do Departamento de Ciências
            Econômicas da Universidade Estadual de Santa Cruz.</p>

        <p>Os boletins contêm informações acerca das variações de preço dos produtos que compõem a cesta básica oficial a partir
            de levantamento de preço realizado em estabelecimentos comerciais das cidades baianas de Ilhéus e Itabuna. Aqui são
            disponibilizadas informações acerca do gasto mensal, preço médio, tempo de trabalho necessário, variação mensal,
            semestral, anual e do ano de cada item da cesta. Também são feitas análises conjunturais sobre os principais fatores
            que geram os movimentos dos preços dos produtos da cesta básica. Essa publicação é encaminhada mensalmente para os
            meios de comunicação impresso, televisivo e eletrônico.</p>
    </div>
</div>


<div class="row m-5 boletim_do_mes">
    <div class="col-12">
        <h3>Última publicação</h3>
    </div>
    @if(!$ultimos_boletins)
    <div class="alert alert-info" role="alert">
        Ainda não houveram publicações!
    </div>
    @else
    <div class="col-sm-12 col-md-6 boletim_area">
        <p id="boletim_atual_title" data-boletim="titulo">{{ ucfirst( $ultimo_boletim->mes->nome ) }} / {{ strval($ultimo_boletim->ano) }}</p>
    </div>
    <div class="col-sm-12 col-md-6">
        <ul class="list-group detalhes_boletim">
            @if($ultimo_boletim->especial == NULL)
                <li class="list-group-item info-item"><strong><span data-boletim="subtitulo">Boletim ACCB/UESC, ano {{ strval($ultimo_boletim->ano) - 2003 }}, n. {{$ultimo_boletim->mes->numeracao}}, {{ $ultimo_boletim->mes->nome }} {{ strval($ultimo_boletim->ano) }}</span></strong></li>
            @else
                <li class="list-group-item info-item"><strong><span data-boletim="subtitulo">Boletim ACCB/UESC, {{$ultimo_boletim->especial}}, {{ $ultimo_boletim->mes->nome }} {{ strval($ultimo_boletim->ano) }}</span></strong></li>
            @endif    
            <li class="list-group-item info-item"><strong>Data de publicação:</strong> <span data-boletim="data-publicacao">{{ date('d/m/Y \à\s H:i', strtotime($ultimo_boletim->updated_at)) }}</span></li>
            <li class="list-group-item info-item"><strong>Número de páginas:</strong> <span data-boletim="numero-paginas">{{ $ultimo_boletim->numero_paginas }} páginas</span></li>
            <li class="list-group-item info-item"><strong>Quantidade de visualizações:</strong>
                <span data-boletim="quantidade-visualizacoes-{{ $ultimo_boletim->id }}">
                    {{ $ultimo_boletim->numero_visualizacoes }}
                @if($ultimo_boletim->numero_visualizacoes != 1)
                    visualizações
                @else
                    visualização
                @endif
                </span>
            </li>
            <li class="list-group-item a-item">
                <a id="linkAtu{{ $ultimo_boletim->id }}" href="/{{ $ultimo_boletim->id }}" target="_blank" class="btn btn-outline-info doc_boletim">Ver boletim</a>
                <a id="linkAtu{{ $ultimo_boletim->id }}" href="/{{ $ultimo_boletim->id }}" target="_blank" class="btn btn-outline-secondary doc_boletim" download="Boletim ACCB {{ ucfirst( $ultimo_boletim->mes->nome ) }} de {{ strval($ultimo_boletim->ano) }}">Baixar boletim</a>
                <span id="carregamento">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </span>
            </li>
        </ul>
    </div>
    @endif
</div>

<div class="row m-5">
@if(count($ultimos_boletins) < 2)
    <div class="alert alert-info" role="alert">
        Nenhum boletim foi publicado até o momento!
    </div>
@else
    <div class="col-12">
        <h3>Publicações anteriores</h3>
    </div>
    @foreach($ultimos_boletins as $boletim)
        {{--@if($boletim->mes->id == $ultimo_boletim->mes->id && $boletim->ano == $ultimo_boletim->ano)--}}
        @if($boletim->id == $ultimo_boletim->id)
            @continue
        @else
        <div class="col-sm-12 col-md-4 col-lg-3 m-3 boletim-item">
            <div class="card mx-auto">
                <div class="card-body">
                    <h5 class="card-title">{{ ucfirst($boletim->mes->nome) }} {{ strval($boletim->ano) }}</h5>
                    @if($boletim->especial == NULL)
                        <h6 class="card-subtitle mb-2 text-muted">Boletim ACCB/UESC, ano {{ strval($boletim->ano) - 2003 }}, n. {{$boletim->mes->numeracao}}</h6>
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
        @endif
    @endforeach
@endif
</div>

@endsection

@section('javascript')

<script type="text/javascript">
    $(".doc_boletim").click(function(){
        atribuirVisualizacao($(this), 1);
    });

    $(".doc_boletim_small").click(function(){
        atribuirVisualizacao($(this), 2);
    });

    function atribuirVisualizacao(obj, tipo){
        $("#carregamento").css('display', 'block');
        id = $(obj).attr('id').substr(7);
        $.get('/api/boletim/atrvis/' + id, function(retorno){
            if(retorno){
                qtd = parseInt($("[data-boletim = 'quantidade-visualizacoes-"+id+"']").text());
                qtd++;
                if(tipo == 1){
                    var viz = "";
                    if(qtd == 1)
                        viz = " visualização";
                    else
                        viz = " visualizações";
                    $("[data-boletim = 'quantidade-visualizacoes-"+id+"']").text(qtd + viz);
                }else if(tipo = 2){
                    $("[data-boletim = 'quantidade-visualizacoes-"+id+"']").text(qtd);
                }
            }else{
                $("[data-boletim = 'quantidade-visualizacoes-"+id+"']").text("Visualizações NÃO estão sendo auto incrementadas! Por favor, chamar técnico");
            }
            $("#carregamento").css('display', 'none');
        });
    }
</script>

@endsection