@extends('layouts.public')
@section('title', 'Catalogo')
@section('content')

@push('scripts')
<script type="text/javascript">
    $(function () {
        var actionUrl = "{{ route('Ricerca') }}";
        var formId = 'ricerca';
        $("form#ricerca :input").on('blur', function (event) {
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, actionUrl, formId);
        });
        $("#ricerca").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(actionUrl, formId);
        });    
    });
</script>
@endpush

@include('layouts.ricerca')

<hr>

<div class="eventi_catalogo">
    <div class="grid_container">
        @isset($events)
        @forelse($events as $event) <!-- forelse serve per fare un for se la variabile non è vuota o altro altrimenti-->
        <div class="event_box"><a href="{{Route('Pagina_Evento',[$event->eventid]) }}">
                <h2>{{$event->nome}}</h2>
                <p class="luogo_evento">{{$event->luogo}}</p>
                <p class="data_evento">{{$event->data}}</p>
                <hr>
                <h5>{{$event->categoria}}</h5>
                <div class="img_container">
                    @include('helpers/EventsImages', ['img' => $event->image])
                </div>
            </a>
        </div>
        @empty
            <p class="no_events">La ricerca non ha generato risultati.</p>
        @endforelse
        </div>
        <!--Paginazione -->
        @include('paginator/paginate', ['paginate' => $events])
        @endisset
</div>
@endsection