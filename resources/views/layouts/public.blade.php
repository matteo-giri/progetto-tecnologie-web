<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('tWeb.css') }}" >
        <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png')}}">
        <title>ProgTweb | @yield('title', 'Catalogo')</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://bitstorm.org/jquery/shadow-animation/jquery.animate-shadow-min.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false&.js"></script>
        <script src="{{ asset('js/functions.js') }}" ></script>
        <script>
         function myFunction (){
                  var x = document.getElementById("myTopnav");
                  if (x.className === "topnav") {
                    x.className += " responsive";
                  } else {
                    x.className = "topnav";
                  }
                }
                </script>
    @stack('scripts') <!-- direttiva che inietta tutti gli scripts pushati-->
    </head>
     <body>
	<div class="header">
		<div class="logo">
                    <a href = "{{ route('frontpage') }}"><img src="{{ asset('images/logo.png') }}" alt="logo" class="img_logo"/></a>
                </div>
		<div class="login_signup">
                    @guest
                    <a id ="SignIn" href="{{ route('Accedi') }}">Accedi</a>
                    /
                    <a id="SignUp" href="{{ route('Registrati') }}">Registrati</a>
                    @endguest
                    @auth
                    <a href="" id="SignIn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                    </form>
                    @endauth
		</div>				
	</div>
        <div class="topnav" id="myTopnav">
		@include('layouts/topnav')
        </div>
        <section id="content">
                @yield('content')
        </section>    
        <div class="footer">
                @include('layouts/footer')
        </div>
</html>