@extends('layouts.public')	
@push('scripts')

<script type="text/javascript">
$(function(){
    //funzioni per ajax
    var action_url = "{{ route('Modifica_Utente',[$user->id]) }}";
    var formId = 'DatiUtente';

    $("#DatiUtente").on('submit', function (event) {
        event.preventDefault();
        doFormValidation(action_url, formId);
    });

    $("form#DatiUtente :input").on('blur', function (event) {
        var formElementId = $(this).attr('id');
        doElemValidation(formElementId, action_url, formId);
    });
    
    /
    var values = [];
    //funzione per mettere i valori dei vari input della form nella variabile values
    $('#DatiUtente input[type != submit]').each(function(i){
        values.push(this.value);
    });
    
    //quando clicco sul bottone di modifica si rimuovono gli attributi readonly dagli input
    $('#modify').on("click",function(){
       $('#DatiUtente input').removeAttr('readonly');
       $('#modify').hide();
       $('#confirm').show();
       $('#annulla').show();
    });
    
    //funziona che rimette i valori iniziali e il readonly
    $('#annulla').on("click",function(){
       $('#DatiUtente input[type != submit]').each(function(i){
           this.value = values[i];
           this.innerHTML = values[i];
       });
       $('#DatiUtente input[type != submit]').attr('readonly','true');
       $('#modify').show();
       $('#confirm').hide();
       $('#annulla').hide();
    });
});
</script>
@endpush
@section('title', 'Area Personale')
@section('content')

<div class="wrapper">
    <h2>Dati Personali</h2>
    {{Form::open(array('route'  => array('Modifica_Utente',$user), 'id' => 'DatiUtente','class' => 'formUtente')) }}
                <div>
                {{Form::label ('nome', 'Nome') }}
                {{Form::text('nome', $user->nome,['id' => 'nome', 'readonly' => 'true' ])}}
                </div>
                <div>
                {{Form::label ('cognome', 'Cognome') }}
                {{Form::text('cognome', $user->cognome,['id' => 'cognome', 'readonly' => 'true' ])}}
                </div>
                <div>
                {{Form::label ('data_nascita', 'Data di nascita') }}
                {{Form::date('data_nascita', $user->data_nascita,['id' => 'data_nascita','readonly' => 'true','min'=>'0001-01-01', 'max'=>'9999-12-31'])}}
                </div>
                <div>
                {{Form::label ('telefono', 'Numero di Telefono') }}
                {{Form::text('telefono', $user->telefono,['id' => 'telefono','readonly' => 'true'])}}
                </div>
                <div>
                {{Form::label ('email', 'Email') }}
                {{Form::email('email', $user->email,['id' => 'email' , 'readonly' => 'true' ])}}
                </div>
                <div>
		{{Form::label ('username', 'Username') }}
                {{Form::text('username', $user->username,['id' => 'username','disabled' => 'true'])}}
                </div>
                <div class="formUtenteBottoni">
		{{Form::submit('Conferma',['id' => 'confirm', 'hidden' => 'true']) }}
                <button type="button" id = "annulla" class ="event_button" hidden>Annulla</button>
                </div>
                {{Form::close()}}
    <div class ="riep_buttons">
       <button type="button" id = "modify" class ="event_button">Modifica Dati</button>
       <a href="{{ route('Storico',[$user]) }}"><button type="button" class ="event_button">Storico Biglietti</button></a>
    </div>
</div>
@endsection