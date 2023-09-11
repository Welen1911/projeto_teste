@extends('layout.main')

@section('title', $event->title)

@section('content')
@php
    $image = "/img/event_placeholder.jpg";
    if ($event->image != "") {
        $image = "/images/".$event->image;
    }

@endphp
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="{{ $image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-city">
                    <ion-icon name="location-outline"></ion-icon>
                    {{ $event->city }}
                </p>
                <p class="event-date">
                    <ion-icon name="calendar-outline"></ion-icon>
                    {{ date('d/m/Y', strtotime($event->date)) }}
                </p>
                <p class="events-partipants">
                    <ion-icon name="people-outline"></ion-icon>
                    X participantes
                </p>
                <p class="event-owner">
                    <ion-icon name="star-outline"></ion-icon>
                    Dono do evento
                </p>
                <a href="#" class="btn btn-primary" id="event-submit">Se inscrever</a>
                @if($event->items != "")
                <h3>O evento conta com:</h3>
                <url id="items-list">
                    @foreach($event->items as $item)
                        <li><ion-icon name="play-outline"></ion-icon><span>{{ $item }}</span></li>
                    @endforeach
                </url>
                @else
                <h3>Adicionais não informados!</h3>
                @endif
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento:</h3>
                <p class="event-description">
                    {{ $event->description }}
                </p>
            </div>
        </div>
    </div>

@endsection
