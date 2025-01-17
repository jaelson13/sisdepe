@extends('layouts.app')

@section('mcurso','active')

@section('conteudo')
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Turmas</h5>
        </div>


        <div class="col-md-8 pr-5">
            <a class="float-right" href="/courses/{{$coursecode}}/grades">
                <span class="input-group-text" id="basic-addon1">
                      <i class="material-icons">keyboard_backspace</i>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">
            <newgrade-component coursecode="{{json_encode($coursecode)}}"></newgrade-component>
        </div>
    </div>
</div>
@endsection

