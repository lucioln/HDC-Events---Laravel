@extends('layouts.main')

@section('title', 'Dinamico')

@section('content')
    <h1>Algum titulo</h1>
    @if(10 > 5)
        <p>Condição verdadeira</p>
    @endif

    <h2>Passando dados dinamicos pela rota:</h2>
    <p>{{$nome}}</p>

    <h2>Loop:</h2>
    @for($i=0; $i<count($array); $i++)
        <p>{{ $array[$i]}}</p>
    @endfor

    @php
        $nome1 = "Lúcio";
        $sobrenome = "Noleto";
        echo $nome1 .' '. $sobrenome;
    @endphp

    <!-- Comentário em HTML-->

    {{-- Comentário com Blade--}}
@endsection

