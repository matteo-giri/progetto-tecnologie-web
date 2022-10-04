@extends('layouts.public')
@section('title', 'Area Amministratore')
@section('content')

@push('scripts')
<script>
    $(function () {
//insererimento nuova compagnia con ajax
        var new_company_Url = "{{ route('new_company') }}";
        var new_company_formId = 'addCompany';
        $("#addCompany").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(new_company_Url, new_company_formId);
        });
        $("form#addCompany :input").on('blur', function (event) {
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, new_company_Url, new_company_formId);
        });

//update compagnia con ajax
        var update_compant_Url = "{{route('update_company')}}";
        var update_company_formId = 'updateCompany';

        $("#updateCompany").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(update_compant_Url, update_company_formId);
        });
        $("form#updateCompany :input").on('blur', function (event) {
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, update_compant_Url, update_company_formId);
        });
//animazione finestre, ombre ecc...
        var clienti = $('.gest-clienti');
        var organizzazione = $('.gest-organizzazioni');
        var childright = $('.float-child-right');
        var childleft = $('.float-child-left');
        var wrap = $('.wrap_admin');
        var button = $('#table_org div ');
        childleft.on('click', function () {
            if (!childleft.hasClass('active_admin')) {
                childleft.addClass('active_admin');
                childright.removeClass('active_admin');
                childright.animate({boxShadow: '2px -2px 1px 1px'}, {duration: 300});
                wrap.animate({boxShadow: '2px -2px 1px 1px'}, {duration: 300, queue: false});
                organizzazione.animate({opacity: '0%'}, {duration: 300});
                childleft.css('border-bottom', 'none');
                childright.css('border-bottom', '2px solid black');
                organizzazione.addClass('hide');
                clienti.removeClass('hide');
                childleft.animate({boxShadow: '13px -10px 5px 5px'}, {duration: 300});
                wrap.animate({boxShadow: '13px -10px 5px 5px'}, {duration: 300, queue: false});
                childleft.css({'background-color': '#FFFFFF'}, {duration: 300, queue: false});
                wrap.css({'background-color': '#FFFFFF'}, {duration: 300, queue: false});
                childright.css({'background-color': '#EEEEEE'}, {duration: 300, queue: false});
                clienti.animate({opacity: '100%'}, "slow");
                $('#aggiungiorg').hide();
                $('#company_details').html("");
                $("#modificaorg").hide("normal");
                $('.container_aggiungi_areaAdmin').show();
                $('.panel_areaAdmin').hide("slow");
                $('#company_details').hide();
            }
        });
        childright.on('click', function () {
            if (!childright.hasClass('active_admin')) {
                childright.addClass('active_admin');
                childleft.removeClass('active_admin');
                childleft.animate({boxShadow: '2px -2px 1px 1px'}, {duration: 300});
                wrap.animate({boxShadow: '2px -2px 1px 1px'}, {duration: 300, queue: false});
                clienti.animate({opacity: '0%'}, {duration: 300});
                childright.css('border-bottom', 'none');
                childleft.css('border-bottom', '2px solid black');
                clienti.addClass('hide');
                organizzazione.removeClass('hide');
                childright.animate({boxShadow: '13px -10px 5px 5px'}, {duration: 300});
                wrap.animate({boxShadow: '13px -10px 5px 5px'}, {duration: 300, queue: false});
                childleft.css({'background-color': '#EEEEEE'}, {duration: 300, queue: false});
                wrap.css({'background-color': '#FFFFFF'}, {duration: 300, queue: false});
                childright.css({'background-color': '#FFFFFF'}, {duration: 300, queue: false});
                organizzazione.animate({opacity: '100%'}, "slow");
            }
        });
        
        //aggiunge il nome della compagnia nell'analisi
        $('.details_button').on('click', function () {
            trigId = $(this).attr('at');
            var nome = $("#" + trigId).text();
            $('#company_details').html(nome);
        });
        
        //aggiunge i dati dell'analisi della compagnia all'analisi
        $('.details_button').on('click', function () {
            trigId = $(this).attr('at');
            var analisi = $("#analisi" + trigId).html();
            $('#company_details').hide();
            $('#company_details').html(analisi);
            $('#company_details').slideDown('slow');
 
        });
        
        //funzione che mostra la form di aggiunta della compagnia
        $('#aggiungi_areaAdmin').on('click', function () {
            $("#updateCompany :input[name=nome]").attr("id", "hidden_nome");
            $("#updateCompany :input[name=email]").attr("id", "hidden_email");
            $("#updateCompany :input[name=username]").attr("id", "hidden_username");
            $("#updateCompany :input[name=data_nascita]").attr("id", "hidden_data_nascita");
            $("#updateCompany :input[name=telefono]").attr("id", "hidden_telefono");
            $("#updateCompany :input[name=sitoweb]").attr("id", "hidden_sitoweb");
            $("#addCompany :input[name=nome]").attr("id", "nome");
            $("#addCompany :input[name=email]").attr("id", "email");
            $("#addCompany :input[name=username]").attr("id", "username");
            $("#addCompany :input[name=data_nascita]").attr("id", "data_nascita");
            $("#addCompany :input[name=telefono]").attr("id", "telefono");
            $("#addCompany :input[name=sitoweb]").attr("id", "sitoweb");
            $("#modificaorg").hide();
            $('.panel_areaAdmin').show("slow");
            $("html, body").animate({scrollTop: $(document).height()}, 1000);
            $('.errors').hide();
        });
        
        //funzione che mostra la modifica della compagnia
        $('.edit_button').each(function () {
            $(this).on('click', function () {
                $("#modificaorg").hide("fast");
                $('.container_aggiungi_areaAdmin').hide("slow");
                $("#modificaorg").show("slow");
                $("html, body").animate({scrollTop: $(document).height()}, 1000);
                $('.errors').hide();
                $("#addCompany :input[name=nome]").attr("id", "hidden_nome");
                $("#addCompany :input[name=email]").attr("id", "hidden_email");
                $("#addCompany :input[name=username]").attr("id", "hidden_username");
                $("#addCompany :input[name=data_nascita]").attr("id", "hidden_data_nascita");
                $("#addCompany :input[name=telefono]").attr("id", "hidden_telefono");
                $("#addCompany :input[name=sitoweb]").attr("id", "hidden_sitoweb");
                $("#updateCompany :input[name=nome]").attr("id", "nome");
                $("#updateCompany :input[name=email]").attr("id", "email");
                $("#updateCompany :input[name=username]").attr("id", "username");
                $("#updateCompany :input[name=data_nascita]").attr("id", "data_nascita");
                $("#updateCompany :input[name=telefono]").attr("id", "telefono");
                $("#updateCompany :input[name=sitoweb]").attr("id", "sitoweb");
                $("#this_email").attr('id','');
                $(this).closest('tr').find('td:eq(1)').attr('id','this_email');
                var companyid = $(this).closest('tr').find('td:eq(0)').attr('id');
                var nome = $(this).closest('tr').find('td:eq(0)').text();
                var email = $(this).closest('tr').find('td:eq(1)').text();
                var username = $(this).closest('tr').find('td:eq(2)').text();
                var data_nascita = $(this).closest('tr').find('td:eq(3)').text();
                var telefono = $(this).closest('tr').find('td:eq(4)').text();
                var sitoweb = $(this).closest('tr').find('td:eq(5)').text();
                $('#companyid').val(companyid);
                $('#nome').val(nome);
                $('#email').val(email);
                $('#username').val(username);
                $('#data_nascita').val(data_nascita);
                $('#telefono').val(telefono);
                $('#sitoweb').val(sitoweb);
            });
        });
        $('#annulla_update').on('click', function () {
            $("#modificaorg").hide("normal");
            $('.container_aggiungi_areaAdmin').show("normal");
            $('.panel_areaAdmin').hide("slow");
        });
        $('#annulla_add').on('click', function () {
            $("#modificaorg").hide("normal");
            $('.container_aggiungi_areaAdmin').show();
            $('.panel_areaAdmin').hide("slow");
        });
    });
</script>
@endpush

@isset($users)
<div class="float-container">

    <div class="float-child-left">
        <h2>gestione clienti</h2>
    </div>
    <div class="float-child-right"">
        <h2>gestione organizzazioni</h2>
    </div>
</div>
<div class="wrap_admin">
    <div class="gest-clienti">
        <table class="table_area_admin">
            <tr>
                <th>Username</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Data di nascita</th>
                <th>Telefono</th>
                <th>Sito Web</th>
                <th>Elimina</th>
            </tr>
            @foreach($users as $user)
            @if($user->role == ('user'))
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->nome}}</td>
                <td>{{$user->cognome}}</td>
                <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                <td><nobr>{{$user->data_nascita}}</nobr></td>
            <td><a href="tel:{{$user->telefono}}">{{$user->telefono}}</a></td>
            <td><a href="https://www.{{$user->sitoweb}}" target="_blank">{{$user->sitoweb}}</a></td>
            <td><div class="btn_Tab">{{Form::open(array('route' => 'delete_user','id' => 'delete_user'))}}
                    {{Form::hidden('userid', $user->id, )}}
                    {{Form::image(asset('images/Btn.png'), 'elimina', ['type'=> 'submit', 'class' => 'btn_img']) }}
                    {{Form::Close()}}</div></td>


            </tr>
            @endif
            @endforeach
        </table>
    </div>
    <div class="gest-organizzazioni hide">
        <div class="table-gest-organizzazioni">
            <table class="table_area_admin">
                <tr>
                    <th>Nome</th>
                    <th id='this_email'>Email</th>
                    <th>Username</th>
                    <th>Data Fondazione</th>
                    <th>Telefono</th>
                    <th>Sito Web</th>
                    <th>Elimina</th>
                    <th>Modifica</th>
                    <th>Vendita</th>
                </tr>
                @foreach($companiesWithAnalisi as $companyWithAnalisi)
                <tr>
                    <td id="{{$companyWithAnalisi['company']->id}}">{{$companyWithAnalisi['company']->nome}}</td>

                    <td><a href="mailto:{{$companyWithAnalisi['company']->email}}">{{$companyWithAnalisi['company']->email}}</a></td>

                    <td>{{$companyWithAnalisi['company']->username}}</td>

                    <td><nobr>{{$companyWithAnalisi['company']->data_nascita}}</nobr></td>

                <td><a href="tel:{{$companyWithAnalisi['company']->telefono}}">{{$companyWithAnalisi['company']->telefono}}</a></td>

                <td><a href="https://www.{{$companyWithAnalisi['company']->sitoweb}}" target="_blank">{{$companyWithAnalisi['company']->sitoweb}}</a></td>

                <td><div class="btn_Tab">{{Form::open(array('route' => 'delete_user','id' => 'delete_company'))}}
                        {{Form::hidden('userid', $companyWithAnalisi['company']->id, )}}
                        {{Form::image(asset('images/Btn.png'), 'elimina', ['type'=> 'submit', 'class' => 'btn_img']) }}
                        {{Form::Close()}}
                    </div></td>
                <td><div class="btn_Tab"><img src="{{ asset('images/Edit.png')}}" class="edit_button btn_img"></div></td>

                <td><div class="btn_Tab"><img at="{{$companyWithAnalisi['company']->id}}" src="{{ asset('images/ticket.png')}}" class="details_button btn_img"></div></td>

                </tr>
                <div id="analisi{{$companyWithAnalisi['company']->id}}" style="display:none">
                    <h3>Analisi vendita per società {{$companyWithAnalisi['company']->nome}} :</h3>
                    <ul>
                        <li>Incasso totale: {{$companyWithAnalisi['incasso']}}€</li><br>
                    <li>Numero biglietti venduti: {{$companyWithAnalisi['venduti']}}</li>
                    </ul>
                </div>
                @endforeach
            </table>
        </div>
        <p id="company_details" class="analisiVendita" >
        </p>
        <div class="gest-organizzazioni-form ">
            <div id="modificaorg" hidden>
                <hr>
                {{Form::open(array('route' => 'update_company','class' => 'form_area_admin','id' => 'updateCompany'))}}
                {{ Form::hidden('companyid','' , [ 'id' => 'companyid']) }}
                <div>
                    {{Form::label('username', 'Username:')}}
                    {{Form::text('username','',['class'=> 'input', 'id' => 'hide_username' ,'disabled'])}}
                </div>
                <div>
                    {{Form::label('nome', 'nome Società:')}}
                    {{Form::text('nome' ,'',['class'=> 'input', 'id'=>'hide_nome'])}}
                </div>
                <div>
                    {{Form::label('email', 'Email Società:')}}
                    {{Form::text('email','',['class'=> 'input', 'id' => 'hide_email'])}}
                </div>
                <div>
                    {{Form::label('data_nascita', 'Data fondazione società')}}
                    {{Form::date('data_nascita','',['class'=> 'input','id' => 'hide_data_nascita','min'=>'0001-01-01', 'max'=>'9999-12-31'])}}
                </div>
                <div>
                    {{Form::label('telefono', 'Telefono:')}}
                    {{Form::text('telefono','',['class'=> 'input', 'id' => 'hide_telefono'])}}
                </div>
                <div>
                    {{Form::label('sitoweb', 'sito Web:')}}
                    {{Form::text('sitoweb','',['class'=> 'input', 'id' => 'hide_sitoweb'])}}
                </div>

                <div class="formUtenteBottoni">
                    {{ Form::button('<span>Conferma Modifiche</span>', ['id' => 'confirm', 'class' => 'admin_button', 'type' => 'submit']) }}
                    <button type='button' id = "annulla_update" class ="admin_button"><span>Annulla</span></button>
                </div>
                {{Form::close()}}
            </div>
            <div class="container_aggiungi_areaAdmin">
                <button id='aggiungi_areaAdmin' class="admin_button"><span>Aggiungi Compagnia</span></button>

                <div class="panel_areaAdmin" style="display:none">
                    <hr>
                    {{Form::open(array('route' => 'new_company','class' => 'form_area_admin','id' => 'addCompany'))}}
                    <div>
                        {{Form::label('nome', 'nome Società:')}}
                        {{Form::text('nome' ,'',['class'=> 'input', 'placeholder'=>'nome...', 'id'=>'nome'])}}
                    </div>
                    <div>
                        {{Form::label('email', 'Email Società:')}}
                        {{Form::text('email','',['class'=> 'input', 'placeholder'=>'email...', 'id' => 'email'])}}
                    </div>
                    <div>
                        {{Form::label('username', 'Username:')}}
                        {{Form::text('username','',['class'=> 'input', 'placeholder'=>'username...', 'id' => 'username'])}}
                    </div>
                    <div>
                        {{Form::label('password', 'Password:')}}
                        {{Form::text('password','',['class'=> 'input', 'placeholder'=>'password...', 'id' => 'password'])}}
                    </div>
                    <div>
                        {{Form::label('data_nascita', 'Data fondazione società:')}}
                        {{Form::date('data_nascita','',['class'=> 'input', 'placeholder'=>'data nascita...', 'id' => 'data_nascita'])}}
                    </div>
                    <div>
                        {{Form::label('data_nascita', 'Data fondazione società')}}
                        {{Form::date('data_nascita','',['class'=> 'input', 'placeholder'=>'data nascita...', 'id' => 'data_nascita','min'=>'0001-01-01', 'max'=>'9999-12-31'])}}
                    </div>
                    <div>
                        {{Form::label('telefono', 'Telefono:')}}
                        {{Form::text('telefono','',['class'=> 'input', 'placeholder'=>'telefono...', 'id' => 'telefono'])}}
                    </div>
                    <div>
                        {{Form::label('sitoweb', 'sito Web:')}}
                        {{Form::text('sitoweb','',['class'=> 'input', 'placeholder'=>'sito...', 'id' => 'sitoweb'])}}
                    </div>

                    <div class="formUtenteBottoni">
                        {{ Form::button('<span> aggiungi </span>', ['id' => 'confirm', 'class'=>'admin_button','type' => 'submit']) }}
                        <button type="button" id = "annulla_add" class ="admin_button"><span>Annulla</span></button>
                    </div>
                    {{Form::close()}}

                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection
