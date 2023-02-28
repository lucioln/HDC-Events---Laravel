@extends('layouts.main')

@section('title', 'Produto')
@section('content')
    @if($id!==null)
    <p>O id de produto é: {{$id}}</p>
    @endif
@endsection
