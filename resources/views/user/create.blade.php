@extends('app')

@section('content')
    <h2>Tworzenie pracownika</h2>
    {!! Form::open(['method' => 'POST', 'action' => 'userController@store'] ) !!}
        @include('user._form', ['submitButtonText' => 'Utworz'])
    {!! Form::close() !!}
@endsection