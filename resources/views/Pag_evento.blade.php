@extends('layouts/public')
@section('title', 'Evento')
@section('content')

@isset($event)
<div class="page_container">
    <div class="event_wrapper">

        <div class="img_event_container">
            @include('helpers/EventsImages', ['img' => $event->image])
        </div>
        <div class="cont_container">
            <div class="cont_container_header">
                <div>
                    <h1>{{$event->nome}}</h1>
                    <h4>{{$event->data}} alle {{$event->orario}}</h4>
                    <h5>{{$event->luogo}}</h5>
                </div>
                <div class="cont_container_header_right">
                    @can('isPastEvent',[$event->eventid])
                    @can('isUser')
                    <div>
                        @can('hasNoPartecipation', [$event->eventid])
                        <div>
                            {{ Form::open(['route'=>'Partecipero','id' => 'partecipero', 'files' => false,'class' => 'form-partecipero']) }}
                            {{ Form::hidden('eventid', $event->eventid , [ 'id' => 'eventid']) }}
                            {{ Form::button('Partecipero', ['class' => 'partecipero_button', 'type' => 'submit']) }}
                            {{ Form::close() }}
                        </div>
                        @else
                        <div>
                            {{ Form::open(['route'=>'Annulla_Partecipazione','id' => 'annulla_Partecipazione', 'files' => false,'class' => 'form_annulla_partecipazione']) }}
                            {{ Form::hidden('eventid', $event->eventid , [ 'id' => 'eventid']) }}
                            {{ Form::button('Annulla Partecipazione', ['class' => 'annulla_partecipazione_button', 'type' => 'submit']) }}
                            {{ Form::close() }}
                        </div>
                        @endcan
                    </div>
                    @endcan
                    @endcan

                    @isset($nPartecipero)
                    <h5>Numero di partecipanti: {{$nPartecipero}} </h5>
                    @endisset
                </div>

            </div>
            <div class="accordion_container">	
                <button class="accordion_event">DESCRIZIONE EVENTO</button>
                <div class="panel_event">
                    <p>{{$event->descrizione}}</p>
                </div>
            </div>
            <div class="accordion_container">	
                <button class="accordion_event">PROGAMMA EVENTO</button>
                <div class="panel_event">
                    <p>{{$event->programma}}</p>
                </div>
            </div>
            <div class="accordion_container">
                <button class="accordion_event">INFO LOCATION</button>
                <div class="panel_event">
                    <div id="googleMap" style="width:99%;height:300px; background-color:white; border:none">
                        <iframe src = "https://maps.google.com/maps?q={{$event->Xcord}},{{$event->Ycord}}&hl=es;z=100&amp;output=embed" style="width:100%;height:300px"></iframe>
                    </div>
                </div>
            </div>
            <h2>ORGANIZZATORE</h2>
            <h3>{{$event->societa}}</h3>
            @guest
            <p>Per acquistare i biglietti per questo evento <a href="{{route('Accedi')}}">accedi</a> con un account Ticket Planet!</p>
            @endguest
            @can('isUser')
            @if($event->isPastEvent())
            <p> Evento Passato!</p>
            @elseif(!$event->isPastEvent())
            @can('isSoldout',[$event->eventid])             
            <div class="buy_price">
                <a href="{{route('Compra_Biglietto',[$event->eventid])}}"><button type="button" class="event_button">Compra biglietti</button></a>
                <div class="pricebox">
                    @include('helpers/EventsPrice')
                </div>

            </div>            
            @else
            <p>Non sono più disponibili biglietti per questo evento!</p>

            @endcan
            @endcan
            @endcan
        </div>				
    </div>
</div>
@push('scripts')
<script>
    //accordion
    $(function () {
        $(".accordion_event").on("click", function (){
            $(this).toggleClass("active_event");
            /*La proprietà nextElementSibling ritorna un riferimento all'oggetto nel DOM associato all'elemento immediatamente successivo(cioè la tag) a quello su cui chiamo la proprietà */
            var panel = this.nextElementSibling;
             if (panel.style.maxHeight) {
                    /*La proprietà maxHeight è la proprietà che indica l'altezza msssima di un elemento. Se messa a null l'elemento scompare ed è come se non venisse visualizzato*/
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
        });
    });
</script>
@endpush
@endisset
@endsection