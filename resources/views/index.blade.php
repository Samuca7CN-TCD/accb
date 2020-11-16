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
        <h3>Última publicação {{ date('Y') }}</h3>
    </div>
    @if(!$boletim_mes_atual)
    <div class="alert alert-info" role="alert">
        Ainda não houveram publicações este ano!
    </div>
    @else
    <div class="col-sm-12 col-md-6 boletim_area">
        <p id="boletim_atual_title" data-boletim="titulo">{{ ucfirst( $boletim_mes_atual->mes->nome ) }} / {{ strval($boletim_mes_atual->ano) }}</p>
    </div>
    <div class="col-sm-12 col-md-6">
        <ul class="list-group detalhes_boletim">
            <li class="list-group-item info-item"><strong><span data-boletim="subtitulo">Boletim do mês de {{ ucfirst( $boletim_mes_atual->mes->nome ) }} / {{ strval($boletim_mes_atual->ano) }}</span></strong></li>
            <li class="list-group-item info-item"><strong>Data de publicação:</strong> <span data-boletim="data-publicacao">{{ date('d/m/Y \à\s H:i', strtotime($boletim_mes_atual->updated_at)) }}</span></li>
            <li class="list-group-item info-item"><strong>Número de páginas:</strong> <span data-boletim="numero-paginas">{{ $boletim_mes_atual->numero_paginas }} páginas</span></li>
            <li class="list-group-item info-item"><strong>Quantidade de visualizações:</strong> <span data-boletim="quantidade-visualizacoes">{{ $boletim_mes_atual->numero_visualizacoes }} visualizações</span></li>
            <li class="list-group-item a-item">
                <a id="linkAtu{{ $boletim_mes_atual->id }}" href="/{{ $boletim_mes_atual->id }}" target="_blank" class="btn btn-outline-info doc_boletim">Ver boletim</a>
                <a id="linkAtu{{ $boletim_mes_atual->id }}" href="/{{ $boletim_mes_atual->id }}" target="_blank" class="btn btn-outline-secondary doc_boletim" download="Boletim ACCB {{ ucfirst( $boletim_mes_atual->mes->nome ) }} de {{ strval($boletim_mes_atual->ano) }}">Baixar boletim</a>
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
@if(!count($boletins_ano_atual))
    <div class="alert alert-info" role="alert">
        Nenhum boletim foi publicado este ano até o momento!
    </div>
@else
    <div class="col-12">
        <h3>Publicações {{ date('Y') }}</h3>
    </div>
    @foreach($boletins_ano_atual as $boletim)
        <div class="col-sm-12 col-md-4 col-lg-3 m-0 boletim-item">
            <div class="card mx-auto">
                <div class="card-body">
                    <h5 class="card-title">{{ ucfirst( $boletim->mes->nome ) }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">
                        Informações básicas:<br />
                        <span><strong>Número de páginas:</strong> {{ $boletim->numero_paginas }}</span> <br />
                        <span><strong>Número de visualizações:</strong> {{ $boletim->numero_visualizacoes }}</span>
                    </p>
                    <a id="linkAnt{{ $boletim->id }}" href="/{{ $boletim->id }}" target="_blank" class="card-link doc_boletim">Ver boletim</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
</div>

@endsection

@section('javascript')

<script type="text/javascript">
    $(".doc_boletim").click(function(){
        $("#carregamento").css('display', 'block');
        id = $(this).attr('id').substr(7);
        $.get('/api/boletim/atrvis/' + id, function(retorno){
            if(retorno){
                qtd = $("[data-boletim = 'quantidade-visualizacoes']").text();
                qtd = qtd.split(' ');
                qtd = qtd[0];
                qtd++;
                $("[data-boletim = 'quantidade-visualizacoes']").text(qtd + " visualizações");
            }else{
                $("[data-boletim = 'quantidade-visualizacoes']").text("Visualizações NÃO estão sendo auto incrementadas! Por favor, chamar técnico");
            }
            $("#carregamento").css('display', 'none');
        });
    });
</script>

@endsection