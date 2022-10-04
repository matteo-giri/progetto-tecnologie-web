@extends('layouts.public')

@push('scripts')

<script type="text/javascript">
$(function(){
      //funzioni per lo sconto
        if($("#sconto").val()==0){
            $("#scontoPerc").val("0");
            $("#scontoPerc").prop("readonly", true);
            $("#nGiorniAttSconto").val("0");
            $("#nGiorniAttSconto").prop("readonly", true);
        }
        else{
            $("#scontoPerc").prop("readonly", false);
            $("#nGiorniAttSconto").prop("readonly", false);
            
        }
    
    
    $("#sconto").on('change', function (event) {
        if(this.value==0){
            $("#scontoPerc").val("0");
            $("#scontoPerc").prop("readonly", true);
            $("#nGiorniAttSconto").val("0");
            $("#nGiorniAttSconto").prop("readonly", true);
        }
        else{
            $("#scontoPerc").prop("readonly", false);
            $("#nGiorniAttSconto").prop("readonly", false);
            
        }
    });
    
    //funzioni per ajax modifica
    var update_action_url = "{{ route('updateEvent') }}";
    var updateFormId = 'updateevent';

    $("#updateevent").on('submit', function (event) {
        event.preventDefault();
        doFormValidation(update_action_url, updateFormId);
    });

    $("form#updateevent :input").on('blur', function (event) {
        var formElementId = $(this).attr('id');
        event.preventDefault();
        doElemValidation(formElementId, update_action_url, updateFormId);
    });
    
    //funzioni per ajax aggiunta
    var add_action_url = "{{ route('store_event') }}";
    var addFormId = 'addevent';

    $("#addevent").on('submit', function (event) {
        event.preventDefault();
        doFormValidation(add_action_url, addFormId);
    });

    $("form#addevent :input").on('blur', function (event) {
        var formElementId = $(this).attr('id');
        doElemValidation(formElementId, add_action_url, addFormId);
    });
});
</script>
@endpush

@section('title', 'Area organizzatore')
@section('content')


@isset($events)
<div class="wrapper">
    <br>
    <h1>Area Organizzatore: {{ Auth::user()->nome }}</h1>
    <hr>
    <div class="tab-container">
        <table class="events_Tab">
            <tr>
                <th>Nome</th>
                <th>Luogo</th>
                <th>Biglietti totali</th>
                <th>Biglietti Venduti</th>
                <th>Biglietti Venduti(%)</th>
                <th>Prezzo</th>
                <th>Prezzo Pieno</th>
                <th>Sconto(%)</th>
                <th>Incasso totale</th>
                <th></th>

            </tr>
            @foreach($events as $event)

            <tr>
                <td><strong> <a href="{{Route('Pagina_Evento',[$event->eventid]) }}">{{$event->nome}} </a></strong></td>
                <td>{{$event->luogo}}</td>
                <td>{{$event->bigl_tot}}</td>
                <td>{{$event->bigl_acquis}}</td>
                <td>{{ number_format($event->getVendutiPerc(), 2, ',', '.') }}%</td>
                <td>{{$event->getPrice($event->sconto)}}€</td>
                <td>{{$event->prezzo}}€</td>
                @if($event->scontoIsEnable())
                <td>{{$event->scontoPerc}}%</td>
                @elseif($event->sconto)
                <td>Non ancora attivo</td>
                @else
                <td>Assente</td>
                @endif
                <td>{{$event->incassoTotale}}€</td>
                <td>
                    <div class="btn_Tab"><a href="{{Route('getEventToUpdate',[$event->eventid]) }}" >
                            <img src="{{ asset('images/Edit.png')}}" class="btn_img" ></a>
                        {{Form::open(array('route' => 'deleteEvent','id' => 'deleteEvent'))}}
                        {{Form::hidden('eventid', $event->eventid )}}
                        {{Form::image(asset('images/Btn.png'), 'elimina', ['type'=> 'submit', 'class' => 'btn_img']) }}
                        {{Form::Close()}}
                    </div></td>
            </tr>        


            @endforeach
        </table>
    </div>
    <hr>
    <h3>Guadagno Totale Eventi: {{$guadagno}}€</h3>

    @if(@isset($selected_event))
    <div class="panel_modificaEvento">
        {{ Form::open(array('route'=>'updateEvent','id' => 'updateevent', 'files' => true,'class' => 'form-biglietto')) }}
        {{ Form::hidden('eventid', $selected_event->eventid , [ 'id' => 'eventid']) }}
        <div>
        {{ Form::label('nome', 'Nome Evento', ['class' => 'label-input']) }}
        {{ Form::text('nome', $selected_event->nome, ['class' => 'input', 'id' => 'nome']) }}
        </div>
        <div>
        {{ Form::label('prezzo', 'Prezzo') }}
        {{ Form::text('prezzo', $selected_event->prezzo, [ 'id' => 'prezzo']) }}
        </div>
        <div>
        {{ Form::label('sconto', 'In Sconto', ['class' => 'label-input']) }}
        {{ Form::select('sconto', ['1' => 'Si', '0' => 'No'], $selected_event->sconto, ['class' => 'input','id' => 'sconto']) }}
        </div>
        <div>
        {{ Form::label('scontoPerc', 'Sconto (%)', ['class' => 'label-input']) }}
        {{ Form::text('scontoPerc', $selected_event->scontoPerc, ['class' => 'input', 'id' => 'scontoPerc']) }}
        </div>
        
        <div>
        {{ Form::label('nGiorniAttSconto', 'Numero giorni attivazion sconto', ['class' => 'label-input']) }}
        {{ Form::text('nGiorniAttSconto', $selected_event->nGiorniAttSconto, ['class' => 'input', 'id' => 'nGiorniAttSconto']) }}
        </div>
        {{ Form::hidden('societaid',Auth::user()->id, ['id' => 'societaid', 'readonly'] ) }}
        <div>
        {{ Form::label('luogo', 'Luogo') }}
        {{ Form::select('luogo',  array_unique([$selected_event->luogo => $selected_event->luogo ,'Marche' => 'Marche','Lazio'=>'Lazio',
                        'Piemonte'=>'Piemonte','Lombardia'=>'Lombardia','Veneto'=>'Veneto',
                        'Trentino-Alto Adige'=>'Trentino-Alto Adige','Friuli-Venezia Giulia'=>'Friuli-Venezia Giulia',
                        'Liguria'=>'Liguria','Emilia Romagna'=>'Emilia Romagna','Abruzzo'=>'Abruzzo',
                        'Molise'=>'Molise','Umbria'=>'Umbria','Calabria'=>'Calabria','Sardegna'=>'Sardegna',
                        'Puglia'=>'Puglia', 'Sicilia'=>'Sicilia','Valle d&#39;Aosta'=>'Valle d&#39;Aosta','Basilicata'=>'Basilicata',
                        'Toscana'=>'Toscana','Campania'=>'Campania'])
            , [ 'id' => 'luogo']) }}
        </div>
        <div>
        {{ Form::label('bigl_tot', 'Biglietti totali') }}
        {{ Form::text('bigl_tot', $selected_event->bigl_tot, [ 'id' => 'bigl_tot']) }}
        </div>
        <div>
        {{ Form::label('bigl_acquis', 'Biglietti acquistati') }}
        {{ Form::text('bigl_acquis', $selected_event->bigl_acquis, [ 'id' => 'bigl_acquis','readonly' => 'true']) }}
        </div>
        <div>
        {{ Form::label('categoria', 'Categoria') }}
        {{ Form::text('categoria', $selected_event->categoria, [ 'id' => 'categoria']) }}
        </div>
        {{Form::label('posizione','Posizione')}}
        <div id='map_canvas'></div>
        <div>
        {{ Form::label('Xcord', 'Xcord') }}
        {{ Form::text('Xcord', $selected_event->Xcord, [ 'id' => 'Xcord', 'readonly'=>'true']) }}
        </div>
        <div>
        {{ Form::label('Ycord', 'Ycord') }}
        {{ Form::text('Ycord', $selected_event->Ycord, [ 'id' => 'Ycord', 'readonly'=>'true']) }}
        </div>
        <div>
        {{ Form::label('descrizione', 'Descrizione') }}
        {{ Form::text('descrizione', $selected_event->descrizione, ['id' => 'descrizione']) }}
        </div>
        <div>
        {{ Form::label('programma', 'Programma') }}
        {{ Form::text('programma', $selected_event->programma, [ 'id' => 'programma', 'rows'=>4]) }}
        </div>
        <div>
        {{ Form::label('data', 'Data') }}
        {{ Form::date('data',$selected_event->data, ['id' => 'data','min'=>'0001-01-01', 'max'=>'9999-12-31']) }}
        </div>
        <div>
        {{ Form::label('orario', 'Orario') }}
        {{ Form::time('orario',\Carbon\Carbon::createFromFormat('H:i:s',$selected_event->orario)->format('h:i'), ['id' => 'data']) }}
        </div>
        <div>
        {{ Form::label('image', 'Immagine') }}
        {{ Form::file('image', [ 'id' => 'image']) }}
        </div>
        {{ Form::hidden('image_path', $selected_event->image , [ 'id' => 'image']) }}

        <div class="formUtenteBottoni">
            {{ Form::submit('Modifica Evento', ['id' => 'confirm']) }}
            <button onclick="location.href ='{{ route('Area_Organizzazione') }}'" type="button" id = "annulla" class ="event_button">Annulla</button>
        </div>

        {{ Form::close() }}

    </div>
    @else

    <div class="accordion_container_areaOrg">
        <button class="accordion_areaOrg">Aggiungi Evento</button>
        <div class="panel_areaOrg">
            {{ Form::open(array('route'=>'store_event','id' => 'addevent', 'files' => true,'class' => 'form-biglietto')) }}
            
            <div>
            {{ Form::label('nome', 'Nome Evento', ['class' => 'label-input']) }}
            {{ Form::text('nome', '', ['class' => 'input', 'id' => 'nome']) }}
            </div>
            <div>
            {{ Form::label('prezzo', 'Prezzo') }}
            {{ Form::text('prezzo', '', [ 'id' => 'prezzo']) }}
            </div>
              <div>
            {{ Form::label('sconto', 'In Sconto', ['class' => 'label-input']) }}
            {{ Form::select('sconto', ['1' => 'Si', '0' => 'No'], 1, ['class' => 'input','id' => 'sconto']) }}
            </div>
            <div>
            {{ Form::label('scontoPerc', 'Sconto (%)', ['class' => 'label-input']) }}
            {{ Form::text('scontoPerc', '', ['class' => 'input', 'id' => 'scontoPerc']) }}
            </div>
          
            <div>
            {{ Form::label('nGiorniAttSconto', 'Numero giorni attivazion sconto', ['class' => 'label-input']) }}
            {{ Form::text('nGiorniAttSconto', '', ['class' => 'input', 'id' => 'nGiorniAttSconto']) }}
            </div>
           {{ Form::hidden('societaid',Auth::user()->id, ['id' => 'societaid', 'readonly'] ) }}
            <div>
            {{ Form::label('luogo', 'Luogo') }}
            {{ Form::select('luogo', ['Marche' => 'Marche','Lazio'=>'Lazio',
                        'Piemonte'=>'Piemonte','Lombardia'=>'Lombardia','Veneto'=>'Veneto',
                        'Trentino-Alto Adige'=>'Trentino-Alto Adige','Friuli-Venezia Giulia'=>'Friuli-Venezia Giulia',
                        'Liguria'=>'Liguria','Emilia Romagna'=>'Emilia Romagna','Abruzzo'=>'Abruzzo',
                        'Molise'=>'Molise','Umbria'=>'Umbria','Calabria'=>'Calabria','Sardegna'=>'Sardegna',
                        'Puglia'=>'Puglia', 'Sicilia'=>'Sicilia','Valle d&#39;Aosta'=>'Valle d&#39;Aosta','Basilicata'=>'Basilicata',
                        'Toscana'=>'Toscana','Campania'=>'Campania']
            , [ 'id' => 'luogo']) }}
            </div>
            <div>
            {{ Form::label('bigl_tot', 'Biglietti totali') }}
            {{ Form::text('bigl_tot', '', [ 'id' => 'bigl_tot']) }}
            </div>
            <div>
            {{ Form::hidden('bigl_acquis', 0, [ 'id' => 'bigl_acquis']) }}
            </div>
            <div>
            {{ Form::label('categoria', 'Categoria') }}
            {{ Form::text('categoria', '', [ 'id' => 'categoria']) }}
            </div>
           {{Form::label('posizione','Posizione')}}
            <div id='map_canvas'></div>
            <div>
            {{ Form::label('Xcord', 'Xcord') }}
            {{ Form::text('Xcord', '', [ 'id' => 'Xcord',  'readonly'=>'true']) }}
            </div>
            <div>
            {{ Form::label('Ycord', 'Ycord') }}
            {{ Form::text('Ycord', '', [ 'id' => 'Ycord', 'readonly'=>'true']) }}
            </div>
            <div>
            {{ Form::label('descrizione', 'Descrizione') }}
            {{ Form::text('descrizione', '', ['id' => 'descrizione']) }}
            </div>
            <div>
            {{ Form::label('programma', 'Programma') }}
            {{ Form::text('programma', '', [ 'id' => 'programma', 'rows'=>4]) }}
            </div>
            <div>
            {{ Form::label('data', 'Data') }}
            {{ Form::date('data',\Carbon\Carbon::now(), ['id' => 'data','min'=>'0001-01-01', 'max'=>'9999-12-31']) }}
            </div>
            <div>
            {{ Form::label('orario', 'Orario') }}
            {{ Form::time('orario',\Carbon\Carbon::now()->format('h:i') , ['id' => 'data']) }}
            </div>
            <div>
            {{ Form::label('image', 'Immagine') }}
            {{ Form::file('image', [ 'id' => 'image']) }}
            </div>


            <div class="container-form-btn">
                {{ Form::submit('Aggiungi Evento', ['class' => 'form-btn1', 'id' => 'sub-btn']) }}
            </div>

            {{ Form::close() }}
            

        </div>

    </div>

    @endif


</div>
@endisset   




@push('scripts')
<script>
        //accordion
    $(function () {
        $(".accordion_areaOrg").on("click", function (){
            $(this).toggleClass("active_areaOrg");
            /*La proprietà nextElementSibling ritorna un riferimento all'oggetto nel DOM associato all'elemento immediatamente successivo(cioè la tag) a quello su cui chiamo la proprietà */
            var panel = this.nextElementSibling;
             if (panel.style.maxHeight) {
                    /*La proprietà maxHeight è la proprietà che indica l'altezza msssima di un elemento. Se messa a null l'elemento scompare ed è come se non venisse visualizzato*/
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = "none";
                }
        });
    });
</script>
<script>
window.onload = function(){
var map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 5,
    center: new google.maps.LatLng(42.7882, 12.8193),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
});

var myMarker = new google.maps.Marker({
    position: new google.maps.LatLng(42.7882, 12.8193),
    draggable: true
});

google.maps.event.addListener(myMarker, 'dragend', function (evt) {
    document.getElementById('Xcord').value = evt.latLng.lat().toFixed(7);
    document.getElementById('Ycord').value = evt.latLng.lng().toFixed(7);
});

map.setCenter(myMarker.position);
myMarker.setMap(map);
}
</script>
@endpush
@endsection