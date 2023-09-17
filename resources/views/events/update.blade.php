{{ $event->image }}
@extends('layout.main')

@section('title', 'Editando o evento '. $event->title)

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Edite o evento</h1>
    <form action="/update/{{$event->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image" class="form-control-file">
            @php
                $image = "/img/event_placeholder.jpg";
                if ($event->image != "") {
                    $image = "/images/".$event->image;
                }
            @endphp
            <img src="{{ $image }}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group mb-3">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}">
        </div>
        <div class="form-group mb-3">
            <label for="date">Data:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>
        <div class="form-group mb-3">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento"  value="{{ $event->city }}">
        </div>
        <div class="form-group mb-3">
            <label for="private">O evento é privado?</label>
            <select class="form-control" name="private" id="private">
                @if($event->private)
                <option value="0">Não</option>
                <option value="1" selected>Sim</option>
                @else
                <option value="0" selected>Não</option>
                <option value="1">Sim</option>
                @endif
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="description">Descrição do evento:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Descrição">{{ $event->description }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="items">Adicione elementos de infraestrutura do evento:</label>
            @php
                $infra = ['Cadeiras', 'Palco', 'Cerveja grátis', 'Openfood', 'Brindes'];
            @endphp
            @if($event->items != '')
            @foreach($event->items as $key => $item)
            @if(in_array($item, $infra))
            @php
            $index = array_search($item, $infra);
            @endphp
            <div class="form-group">
                <input type="checkbox" name="items[]" id="items" value="{{$item}}" checked> {{ $item }}
            </div>
            @php
                unset($infra[$index]);
            @endphp
            @endif
            @endforeach
            @endif

            @foreach($infra as $item)
            <div class="form-group">
                <input type="checkbox" name="items[]" id="items" value="{{$item}}"> {{$item}}
            </div>
            @endforeach

        </div>
        <div class="form-group">
            <input type="submit" value="Salvar alterações" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
