@extends('layouts.app')

@section('musuario','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Usuarios</h5>
        </div>

        <div class="col-md-8 pr-5">
            <a class="btn btn-success float-right" href="/courses/{{$coursecode}}/add_users">Adicionar Usuário</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <courseusers-component coursecode="{{json_encode($coursecode)}}"></courseusers-component>
        </div>
    </div>
</div>
@endsection

