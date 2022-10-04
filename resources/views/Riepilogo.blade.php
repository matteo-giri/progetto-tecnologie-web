@extends('layouts/public')
@section('title', 'Grazie')
@section('content')
<div class ="wrapper">
        <h2>Grazie per l'acquisto!!!!!!</h2>
        <h4>Caro {{$user->nome}} {{$user->cognome}},</h4>
        <p>Ticket World è lieta di comunicarle che la sua richiesta per l'acquisto di {{ $ticket->quantita }} biglietto/i per                l'evento {{ $event->nome }} che si terrà in data {{$event->data}} alle ore {{ $event->orario }} presso 
           {{ $event->luogo }} è andata a buon fine! Qui di seguito ritrova tutti i dati del pagamento che ha effettuato</p> 
        <div class ="form-biglietto">
            <fieldset class ="riep">
                <legend>Dati di Pagamento</legend>
                    <label>Nome sulla carta:
                        <input id = "nomeR" type ="text" value = "{{$card['nome']}}" readonly>
                    </label>
                    <label>Numero carta:
                        <input id = "numeroR" type ="text" value = "{{$card['numero']}}" readonly>
                    </label>
                    <label>Data di Scadenza
                        <input id = "dataR" type ="text" value = "{{$card['data']}}" readonly>
                    </label>
                    <label>CVV:
                        <input id = "cvvR" type ="text" value = "{{$card['cvv']}}" readonly>
                    </label>
            </fieldset>
        </div>
        <div class="riep_buttons">
            <a href="{{Route('Pagina_Evento',[$event->eventid]) }}"><button class ="event_button">Info Evento</button></a>
            <a href="{{Route('Storico',[$user])}}"><button class ="event_button">Vedi Storico</button></a>
        </div>
</div>
@endsection
