@extends('layouts/public')

@section('content')
@push('scripts')
<script>
    //funzione per scrivere il prezzo totale dell'acquisto
    function price() {
            var numBiglietti = parseInt(document.getElementById("numeroBiglietti").value);
            var prezzo = parseFloat(document.getElementById("hiddenPriceBox").value);
            var prezzoTotale = numBiglietti * prezzo;
            console.log(prezzoTotale, numBiglietti, prezzo);
            document.getElementById("priceBox").value = prezzoTotale;
        }
        
    $(function(){
        
        $("#numeroBiglietti").attr("onmouseup","price();");
        $("#numeroBiglietti").attr("onkeydown","return false");
        //funzioni per ajax
        var action_url = "{{ route('Compra') }}";
        var formId = 'CompraBiglietto';

        $("#CompraBiglietto").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(action_url, formId);
        });

        $("#CompraBiglietto :input").on('blur', function (event) {
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, action_url, formId);
        });
    });
</script>
@endpush
<div class = "wrapper">
    {{Form::open(['route' => 'Compra','class' => 'form-biglietto','id' => 'CompraBiglietto'])}}
    <fieldset id="DatiEvento">
        <legend>Dati Evento</legend>
        {{Form::label('nome','Evento:',[])}}
        {{Form::text('nome',$event->nome,['id' => 'inputNomeEvento', 'readonly' => true])}}
        {{Form::label('data','Data:',[])}}
        {{Form::date('data',$event->data,['id' => 'inputDataEvento', 'readonly' => true])}}
        {{Form::label('luogo','Luogo:',[])}}
        {{Form::text('luogo',$event->nome,['id' => 'inputLuogoEvento', 'readonly' => true])}}
        {{Form::hidden('eventId',$event->eventid,['id' => 'eventId'])}}
    </fieldset>
    <fieldset id="DatiAcquisto">
        <legend>Dati Acquisto</legend>
        <h3 id ="cardsLabel">Metodi di pagamento accettati</h3>
        <div class="icon-container">
            <i class="fa fa-cc-visa" style="color:violet;"></i>
            <i class="fa fa-cc-paypal" style="color:blue;"></i>
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
        </div>
        {{Form::label('numbiglietti','Biglietti:',[])}}
        {{Form::number('numbiglietti','1',['id' => 'numeroBiglietti', 'min' => '1', 
                                   'max' => $event->bigl_tot-$event->bigl_acquis, 'step'=>'1'])}}
        {{Form::label('metodoPagamento','Metodo di Pagamento:',[])}}
        {{Form::select('metodoPagamento', 
                            collect(array('Prepagata' => 'Carta Prepagata','Credit' => 'Carta di credito')),
                            'Prepagata',
                            ['id' => 'metodoPagamento', 'onchange' => 'change()'],['Prepagata' => ['id' => 'Carta_Prepagata'],                                 'Credit' => ['id' => 'Carta_Credito']])}}
        {{Form::label('priceBox','Prezzo:',[])}}
        {{Form::text('priceBox',number_format($event->getPrice($event->sconto), 2),['id' => 'priceBox', 'readonly' => true])}}
        {{Form::hidden('hiddenPriceBox',number_format($event->getPrice($event->sconto), 2),['id' => 'hiddenPriceBox', 'disabled' => true])}}
        <div class ="datiPagamentoAttivo" id = "DivPag">
            <h3>Dati di pagamento</h3>
            <div>
                {{Form::label('cardname','Nome sulla Carta:',[])}}
                {{Form::text('cardname','',['id' => 'cardname', 'placeholder' => 'Il tuo Nome'])}}
            </div>
            <div>
                {{Form::label('cardnumber','Numero Carta:',[])}}
                {{Form::text('cardnumber','',['id' => 'cardnumber', 'placeholder' => '1111-2222-3333-4444'])}}
            </div>
            <div class = "payment">
                <div class = "expdate">
                    {{Form::label('month','Data di Scadenza:',['class' => 'labelAcquisto'])}}
                    {{Form::selectMonth('month', null,[])}}
                    {{Form::selectRange('year', 2025, 2021, null,[])}}
                </div>
                <div class ="cvv">
                    {{Form::label('cvv','CVV:',["class" => "labelAcquisto"])}}
                    {{Form::text('cvv','',['id' => 'cvv'])}}
                </div>
            </div>
        </div>
    </fieldset>
    <div class = "formbuttons">
        {{Form::submit('Acquista',['id' => 'submitPagamento'])}}
        {{Form::reset('Pulisci',['id' => 'resetPagamento'])}}
    </div>
    {{Form::close()}}
</div>
@endsection