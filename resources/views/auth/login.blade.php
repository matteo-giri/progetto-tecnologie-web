<script>
    window.onload = function(){
        // Get the input field
        var input = document.getElementById("pass");

        // Get the warning text
        var text = document.getElementById("text");

        // When the user presses any key on the keyboard, run the function
        input.addEventListener("keyup", function(event) {

        // If "caps lock" is pressed, display the warning text
        if (event.getModifierState("CapsLock")) {
                text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    });
};
</script>
@extends('layouts/public')
@section('title', 'Accedi')
@section('content')
<div class="wrapper">
        <br>
        <h1> Accedi </h1>
	<div class="login_box">
                {{Form::open(array('route' => 'Accedi')) }}
		{{Form::label ('username', 'Username') }}
		<span><i class="fa fa-user"></i></span>
                {{Form::text('username', '',['placeholder' => 'Username...' ])}}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
                {{Form::label ('password', 'Password') }}
		<span><i class="fa fa-lock"></i></span>
                {{Form::password('password', ['id' => 'pass','placeholder' => 'Password...' ])}}	
                <p id = "text" style = "display:none;">Attenzione CapsLock Attivo</p>
                @if ($errors->first('password'))
                <ul class="errors">
                    @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
		{{ Form::submit('Login') }}
                {{Form::close()}}
	</div>
	<h1> Registrati</h1>
	<div>
                <p> Sei un nuovo cliente?  </p> 
                <a href="{{ route('Registrati') }}">Clicca qui per registrarti </a>
	</div>
</div>

@endsection