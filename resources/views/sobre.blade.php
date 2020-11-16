@extends('layouts.app', ["current" => "sobre"])

@section('body')

<style type="text/css">
    h3{
        font-size: 40px;
    }

    .apresentacao{
        font-size: 18px;
        color: rgb(52, 58, 64);
        width:100%;
    }

    .apresentacao h2{
        font-size: 30px;
    }

    .endereco{
        background-color: rgb(240,240,240);
    }

    #mapholder{
        width: 100%;
    }
    #mapholder iframe{
        width: 100%;
        height: 500px;
        border: 0px;
    }
</style>

<div class="row m-5 apresentacao">
    <div class="col-sm-12 col-md-6 row">
        <div class="mx-auto">
            <div class="col-12">
                <h2>Corpo editorial</h2>
            </div>
            <div class="col-12 text-justify">
                @if(!count($editores))
                <div class="alert alert-danger" role="alert">
                    Erro! Os editores não foram carregados!
                </div>
                @else
                <ul>
                @foreach($editores as $editor)
                    <li>{{ $editor->nome }} ({{ $editor->departamentos }})</li>
                @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 row">
        <div class="mx-auto">
            <div class="col-12">
                <h2>Autor Corporativo</h2>
            </div>
            <div class="col-12 text-justify">
                <ul class="list-group">
                    <li class="list-group-item">Laboratório de Análises Econômicas Regionais (LABOR)</li>
                    <li class="list-group-item">Departamento de Ciências Econômicas (DCEC)</li>
                    <li class="list-group-item">Universidade Estadual de Santa Cruz (UESC)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row p-5 apresentacao endereco">
    <div class="col-sm-12 col-md-6 row">
        <div class="mx-auto">
            <div class="col-12">
                <h2>Endereço</h2>
            </div>
            <div class="col-12 text-justify">
                <p>Universidade Estadual de Santa Cruz</p>
                <p>Departamento de Ciências Econômicas</p>
                <p>Rodovia Jorge Amado, Km 16 - Salobrinho</p>
                <p>Ilhéus- Bahia - Brasil</p>
                <p>CEP 45662-900</p>
                <p>Fones: <br />
                    <a href="tel:+557336805215">+55 (73) 3680-5215</a> <br />
                    <a href="tel:+557336805238">+55 (73) 3680-5238</a>
                </p>
                <p>e-mails: <br />
                    <a href="mailto:cestabasica@uesc.br">cestabasica@uesc.br</a> <br />
                    <a href="mailto:cestabasica@uesc.br">cbuesc@gmail.com</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 row">
        <div id="mapholder">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3857.507174866795!2d-39.175571085332855!3d-14.796766789677752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x739a9cffe548e19%3A0xe91ca23dc7294b8!2sUESC%20%E2%80%93%20Universidade%20Estadual%20De%20Santa%20Cruz!5e0!3m2!1spt-BR!2sbr!4v1602255431505!5m2!1spt-BR!2sbr" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>

<div class="row m-5 apresentacao text-center">
    <div class="col-sm-12 col-md-6 row">
        <div class="col-12">
            <h2>Formato</h2>
        </div>
        <div class="col-12">
            <p>Eletrônico</p>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 row">
        <div class="col-12">
            <h2>Periodicidade da publicação</h2>
        </div>
        <div class="col-12">
            <p>Mensal</p>
        </div>
    </div>
</div>

@endsection