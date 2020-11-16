@extends('layouts.app', ["current" => "novoBoletim"])

@section('body')

<form method="POST" action="/boletim/store" enctype="multipart/form-data" class="row">
    @csrf
    <div class="form-group col-sm-12">
        <label for="mes">Insira o mês do boletim</label>
        <input type="number" step="1.0" min="1" max="12" name="mes" id="mes" placeholder="Mês" class="form-control" />
    </div>
    <div class="form-group col-sm-12">
        <label for="ano">Insira o ano do boletim</label>
        <input type="number" step="1.0" max="{{ date('Y') }}" name="ano" id="ano" placeholder="Ano" class="form-control" />
    </div>
    <div class="form-group col-sm-12">
        <label for="numeroPaginas">Insira o número de páginas do boletim</label>
        <input type="number" step="1.0" min="1" name="numeroPaginas" id="numerosPaginas" placeholder="Número de Páginas" class="form-control" />
    </div>
    <div class="form-group col-sm-12">
        <label for="numeroVisualizacoes">Insira o número de visualizações do boletim</label>
        <input type="number" step="1.0" min="0" value="0" name="numeroVisualizacoes" id="numeroVisualizacoes" placeholder="Número de visualizações" class="form-control" />
    </div>
    <div class="form-group col-sm-12">
        <label for="arquivo">Insira o boletim</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="2147483647" />
        <input name="arquivo" id="arquivo" type="file" accept="application/pdf" class="form-control"/>
    </div>
    <div class='form-group col-sm-12'>
        <input type="submit" class="btn btn-outline-success" value="Salvar"/>
    </div>
</form>

@endsection

@section('javascript')

<script type="text/javascript">

</script>

@endsection