@extends('layouts.public')		

@section('title', 'Home')
@section('content')
<div class="home_evidenza">
    <h1>Non perdere i prossimi eventi!</h1>
    <div class="grid_container">
        @isset($expiringEvents)
        @foreach($expiringEvents as $event)
        <div class="event_box">
            <a href="{{Route('Pagina_Evento',[$event->eventid]) }}">		
                <h2>{{$event->nome}}</h2>
                <p class="luogo_evento">{{$event->luogo}}</p>
                <p class="data_evento">{{$event->data}}</p>
                <hr>
                <h5>{{$event->categoria}}</h5>
                <div class="img_container">
                    @include('helpers/EventsImages', ['img' => $event->image])
                </div>
                </a>
        </div>
        @endforeach
        @endisset
    </div>			
</div>
<div class="home_scopri">
    <h1>Eventi in Evidenza</h1>
    <div class="grid_container">
        @isset($popularEvents)
        @foreach($popularEvents as $event)
        <div class="event_box">
            <a href="{{Route('Pagina_Evento',[$event->eventid]) }}">		
                <h2>{{$event->nome}}</h2>
                <p class="luogo_evento">{{$event->luogo}}</p>
                <p class="data_evento">{{$event->data}}</p>
                <hr>
                <h5>{{$event->categoria}}</h5>
                <div class="img_container">
                    @include('helpers/EventsImages', ['img' => $event->image])
                </div>
                </a>
        </div>
        @endforeach
        @endisset
    </div>
</div>		
@endsection