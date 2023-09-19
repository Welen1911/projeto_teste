@extends('layout.main')

@section('title', 'HDC events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="get">
        <input type="text" id="search"  value="{{ $search }}" name="search" class="form-control" placeholder="Procurar...">
        <button class="btn btn-primary"><ion-icon name="search-outline"></ion-icon></button>
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Mostrando resultado para {{$search}}:</h2>
    @else
    <h2>Próximos eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif

    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            @php
                $image = "/img/event_placeholder.jpg";
                if ($event->image != "") {
                    $image = "/images/".$event->image;
                }
            @endphp
            <img src="{{$image}}" alt="{{$event->title}}">
            <div class="card-body">
                <p class="card-date">
                   {{ date('d/m/Y', strtotime($event->date)) }}
                </p>
                <h5 class="card-title">
                    {{$event->title}}
                </h5>
                <p class="card-participants">
                    {{ count($event->users) }} participantes
                </p>
                <a class="btn btn-primary" href="/events/{{$event->id}}">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi encontrado nenhum evento relacionado! <a href="/" class="btn btn-primary">Ver todos</a></p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponíveis no momento!</p>
        @endif
    </div>
</div>
@endsection
