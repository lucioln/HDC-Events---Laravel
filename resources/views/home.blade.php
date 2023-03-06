@extends('layouts.main')
@section('title', 'HDC events')
@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar..." >
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Resultados para: {{$search}}</h2>
    @else
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{$event->image}}" alt="{{ $event->tilte}}" class="card-img">
                <div class="card-body">
                    <div class="card-date">
                        <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                    </div>
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="card-participants">X card-participantes</p>
                    <a href="/events/{{$event->id}}"  class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if(count($events)==0)
            @if(!$search)
            <p>Não há eventos disponíveis</p>
            @else
            <p>Nenhum resultado encontrado</p>
            @endif
        @endif
    </div>
</div>

    <script src="/js/script.js"></script>
@endsection
