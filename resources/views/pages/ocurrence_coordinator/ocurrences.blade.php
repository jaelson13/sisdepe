@extends('layouts.app')

@section('mtipodedemandas','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Ocorrências</h5>
        </div>       
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <ocurrencescoordinator-component></ocurrencescoordinator-component>
        </div>
    </div>
</div>
@endsection

