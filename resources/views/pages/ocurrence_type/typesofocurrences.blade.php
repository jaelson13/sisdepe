@extends('layouts.app')

@section('mtipodedemandas','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Tipos de Ocorrências</h5>
        </div>

        <div class="col-md-8 pr-5">
            <a class="btn btn-success float-right" href="/new_type_ocurrence">Novo Tipo</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <typeofocurrence-component></typeofocurrence-component>
        </div>
    </div>
</div>
@endsection

