@extends('layouts/public')
@section('title', 'Registrati')
@section('content')
<div class="wrapper">
        <br>
        <h1> Registrati </h1>
	<div class="login_box">
                {{Form::open(array('route' => 'Registrati')) }}
                {{Form::label ('nome', 'Nome') }}
                {{Form::text('nome', '',['id' => 'nome', 'placeholder' => 'Il tuo Nome' ])}}
                 @if ($errors->first('nome'))
                <ul class="errors">
                    @foreach ($errors->get('nome') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{Form::label ('cognome', 'Cognome') }}
                {{Form::text('cognome', '',['id' => 'cognome', 'nome','placeholder' => 'Il tuo Cognome' ])}}
                 @if ($errors->first('cognome'))
                <ul class="errors">
                    @foreach ($errors->get('cognome') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{Form::label ('data_nascita', 'Data di nascita') }}
                {{Form::date('data_nascita', '',['id' => 'data_nascita','min'=>'0001-01-01', 'max'=>'9999-12-31'])}}
                 @if ($errors->first('data_nascita'))
                <ul class="errors">
                    @foreach ($errors->get('data_nascita') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{Form::label ('telefono', 'Numero di Telefono') }}
                {{Form::text('telefono', '',['id' => 'telefono',])}}
                 @if ($errors->first('telefono'))
                <ul class="errors">
                    @foreach ($errors->get('telefono') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{Form::label ('email', 'Email') }}
                {{Form::email('email', '',['id' => 'email' , 'placeholder' => 'yourname@example.it' ])}}
                 @if ($errors->first('email'))
                <ul class="errors">
                    @foreach ($errors->get('email') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
		{{Form::label ('username', 'Username') }}
                {{Form::text('username', '',['id' => 'username','placeholder' => 'Username...' ])}}
                 @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
		{{Form::label ('password', 'Password') }}
                {{Form::password('password', ['id' => 'password', 'placeholder' => 'Password...' ])}}
                 @if ($errors->first('password'))
                <ul class="errors">
                    @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{ Form::label('password-confirm', 'Conferma password', []) }}
                {{ Form::password('password_confirmation', ['id' => 'password-confirm']) }}
		{{Form::submit('Registrati') }}
                {{Form::close()}}
	</div>
	<h1> Accedi</h1>
	<div>
            <p> Sei già registrato?  </p> 
            <a href="{{ route('Accedi') }}">  Clicca qui per accedere </a>
     
	</div>
</div>

@endsection