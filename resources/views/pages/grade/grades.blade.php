@extends('layouts.app')

@section('mcursos','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Turmas</h5>
        </div>

        <div class="col-md-8 pr-5">
            <a class="btn btn-success float-right" href="/courses/{{$coursecode}}/new_grade">Nova Turma</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <grades-component coursecode="{{json_encode($coursecode)}}"></grades-component>
        </div>
    </div>
</div>
@endsection

