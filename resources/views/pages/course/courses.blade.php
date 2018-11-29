@extends('layouts.app')

@section('mtipodedemandas','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Cursos</h5>
        </div>

        <div class="col-md-8 pr-5">
            <a class="btn btn-success float-right" href="/new_course">Novo Curso</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <courses-component></courses-component>
        </div>
    </div>
</div>
@endsection

