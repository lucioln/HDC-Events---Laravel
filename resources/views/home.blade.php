@extends('layouts.main')
@section('title', 'HDC events')
@section('content')

    @foreach($events as $event)
        <p>| {{$event->id}} | {{$event->title}} -- {{$event->description}} -> <button>Abrir</button></p>
    @endforeach


    <script src="/js/script.js"></script>
@endsection
