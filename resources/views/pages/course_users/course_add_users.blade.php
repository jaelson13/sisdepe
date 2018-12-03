@extends('layouts.app')

@section('musuario','active')

@section('conteudo')

            <courseaddusers-component coursecode="{{json_encode($coursecode)}}"></courseaddusers-component>

@endsection

