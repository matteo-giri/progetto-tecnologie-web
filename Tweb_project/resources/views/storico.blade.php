@extends('layouts.public')		

@section('title', 'Storico')
@section('content')
<div class="storico_grid">
    @isset($tickets)
    @forelse($tickets as $ticket)
    <div class="biglietto">
            <div class="img_biglietto_container">
                    @include('helpers/EventsImages', ['img' => $ticket->image]) 
            </div>
            <div class="contenuto_biglietto">
                    <div class="top_contenuto_biglietto">
                            <div class="top_up_contenuto_biglietto">
                                    <h3>data evento: {{$ticket->data }}</h3>	
                            </div>
                            <div class="top_down_contenuto_biglietto">
                                    <h1>{{$ticket->nome}}</h1>
                                    <h3>luogo evento: {{$ticket->luogo}}</h3>
                                    <h3> data di acquisto: {{$ticket->data_acquisto}}</h3>
                                    <h3> N. biglietti aquistati: {{$ticket->quantita}}</h3>
                            </div>							
                    </div>
                    <div class="bottom_contenuto_biglietto">
                            <div class="organizzatore">
                                    <h3>Organizzatore: {{$ticket->societa}}</h3>
                            </div>
                            <div class="costo_biglietto">
                                    <h5>costo totale:</h5>
                                    <h2>{{$ticket->costoTot}}€</h2>
                            </div>
                    </div>
            </div>
            <div class="decorazione_biglietto">
                    @include('helpers/OtherImages', ['img' => 'barcode.jpg'])
            </div>
    </div>
    @empty
        <p class="no_biglietti">Non hai ancora comprato nessun biglietto.</p>
    @endforelse
    @endisset
</div>		
@endsection