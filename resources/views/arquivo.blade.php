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
                <label for="arquivo-ano">Selecione o ano do boletim desejado</label>
                <select id="arquivo-ano" class="custom-select data-boletim">
                @foreach($anos_boletins as $boletim)    
                    @if($boletim->ano == $destaque->ano)
                    <option value="{{ $boletim->ano }}" selected="selected" >{{ $boletim->ano }}</option>
                    @else
                    <option value="{{ $boletim->ano }}">{{ $boletim->ano }}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="col-6">
        <form method="GET" action="arquivo">
            <div class="form-group mx-auto m-5">
                <label for="arquivo-mes">Selecione o mês do boletim desejado</label>
                <select id="arquivo-mes" class="custom-select data-boletim">
                @foreach($meses_destaque as $mes)
                    @if($mes->mes->numeracao == $destaque->mes->numeracao)
                    <option value="{{ $mes->mes->numeracao }}" selected="selected">{{ ucfirst( $mes->mes->nome ) }}</option>
                    @else
                    <option value="{{ $mes->mes->numeracao }}">{{ ucfirst( $mes->mes->nome ) }}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </form>
    </div>
</div>


<div class="row m-5 boletins_anteriores">
    @if(!$destaque)
    <div class="alert alert-info" role="alert">
        Não há boletins dos anos anteriores cadastrados
    </div>
    @else
    <div class="col-sm-12 col-md-6 boletim_area">
        <p id="boletim_title" data-boletim="titulo">{{ ucfirst( $destaque->mes->nome ) }} / {{ strval($destaque->ano) }}</p>
    </div>
    <div class="col-sm-12 col-md-6">
        <ul class="list-group detalhes_boletim">
            <li class="list-group-item info-item"><strong><span data-boletim="subtitulo">Boletim do mês de {{ ucfirst( $destaque->mes->nome ) }} / {{ strval($destaque->ano) }}</span></strong></li>
            <li class="list-group-item info-item"><strong>Data de publicação:</strong> <span data-boletim="data-publicacao">{{ date('d/m/Y \à\s H:i', strtotime($destaque->updated_at)) }}</span></li>
            <li class="list-group-item info-item"><strong>Número de páginas:</strong> <span data-boletim="numero-paginas">{{ $destaque->numero_paginas }} páginas</span></li>
            <li class="list-group-item info-item"><strong>Quantidade de visualizações:</strong>
                <span data-boletim="quantidade-visualizacoes-{{ $destaque->numero_visualizacoes }}">{{ $destaque->numero_visualizacoes }}
                @if($destaque->numero_visualizacoes != 1)    
                    vizualizações
                @else
                    vizualização
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
    </div>
    @endif
</div>

@endsection

@section('javascript')

<script type="text/javascript">
    var meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    var mes = 0;
    var ano = 0;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    $(".data-boletim").on("change", function(){
        mes = $("#arquivo-mes").val();
        ano = $("#arquivo-ano").val();
        id = $(this).attr('id');

        switch(id){
            case 'arquivo-ano':
                $("#carregamento").css('display', 'block');
                loadMeses(mes, ano)
            break;
            case 'arquivo-mes':
                $("#carregamento").css('display', 'block');
                loadBoletim(mes, ano);
            break;
        }
    });

    function loadMeses(mesSearch, anoSearch){
        $.getJSON('/api/arquivo/0/' + anoSearch, function(data){
            if(data.length){
                options = "";
                mesInfo = data[0].mes_id;
                for(i = 0 ; i < data.length ; i++){
                    if(data[i].mes_id == mesSearch){
                        selected = "selected='selected'";
                        mesInfo = data[i].mes_id;
                    }else{ selected = ""; }
                    options += "<option value=" + data[i].mes_id +  " " + selected + ">" + meses[data[i].mes_id - 1] + "</option>";
                }
            }else{
                options = "<option>Não há meses no ano selecionado!</option>";
            }
            $("#arquivo-mes").html(options);
            loadBoletim(mesInfo, ano);
        });
    }

    function loadBoletim(mes, ano){
        $.getJSON('/api/arquivo/' + mes + '/' + ano, function(dados){
            if(dados.length){
                dados = dados[0];
                $(".detalhes_boletim span").each(function(){
                    data = $(this).attr("data-boletim");
                    $("#boletim_title").text(meses[dados.mes_id - 1] + " / " + dados.ano);
                    switch(data){
                        case 'subtitulo':
                            $(this).text("Boletim do mês de "+ meses[dados.mes_id - 1] + " / " + dados.ano);
                        break;
                        case 'data-publicacao':
                            dataA = dados.created_at.split('T');
                            ano = dataA[0].substr(0, 4);
                            mes = dataA[0].substr(5, 2);
                            dia = dataA[0].substr(8, 2);
                            horas = dataA[1].substr(0, 2);
                            minutos = dataA[1].substr(3, 2);
                            $(this).text(dia + "/" + mes + "/" + ano + " às " + horas + ":" + minutos);
                        break;
                        case 'numero-paginas':
                            $(this).text(dados.numero_paginas + " páginas");
                        break;
                        default:
                            var viz = "";
                            if(dados.numero_visualizacoes != 1)
                                viz = " vizualizações";
                            else
                                viz = " vizualização";
                                $(this).attr('data-boletim', "quantidade-visualizacoes-"+dados.id);
                                $(this).text(dados.numero_visualizacoes + viz);
                    }
                    $(".doc_boletim").attr("id", "linkAnt"+dados.id);
                    $(".doc_boletim").attr("href", "/" + dados.id);
                });
            }else{
                $(".detalhes_boletim span").each(function(){
                    $(this).text("Não há boletins para o mês/ano selecionado!");
                    $(".doc_boletim").attr("href", "/0");
                });
            }
            $("#carregamento").css('display', 'none');
        });
    }

    $(".doc_boletim").click(function(){
        atribuirVizualizacao($(this), 1);
    });

    $(".doc_boletim_small").click(function(){
        atribuirVizualizacao($(this), 2);
    });

    function atribuirVizualizacao(obj, tipo){
        $("#carregamento").css('display', 'block');
        id = $(obj).attr('id').substr(7);
        $.get('/api/boletim/atrvis/' + id, function(retorno){
            if(retorno){
                qtd = parseInt($("[data-boletim = 'quantidade-visualizacoes-"+id+"']").text());
                qtd++;
                if(tipo == 1){
                    var viz = "";
                    if(qtd == 1)
                        viz = " vizualização";
                    else
                        viz = " vizualizações";
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