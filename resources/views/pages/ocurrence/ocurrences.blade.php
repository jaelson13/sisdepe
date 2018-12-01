@extends('layouts.app')

@section('mtipodedemandas','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Ocorrências</h5>
        </div>

        <div class="col-md-8 pr-5">
            <a class="btn btn-success float-right" href="/new_ocurrence">Nova Ocorrência</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <ocurrences-component></ocurrences-component>
        </div>
    </div>
</div>
@endsection

