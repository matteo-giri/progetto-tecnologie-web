@if ($paginate->lastPage() != 1)
<div id="paginate">
    {{ $paginate->firstItem() }} - {{ $paginate->lastItem() }} di {{ $paginate->total() }} ---

    <!-- Link alla prima pagina -->
    @if (!$paginate->onFirstPage())
        <a href="{{ $paginate->url(1) }}">Inizio</a> |       
    @else
        Inizio |
    @endif

    <!-- Link alla pagina precedente -->
    @if ($paginate->currentPage() != 1)
        <a href="{{ $paginate->previousPageUrl() }}">&lt; Precedente</a> |      
    @else
        &lt; Precedente |
    @endif

    <!-- Link alla pagina successiva -->
    @if ($paginate->hasMorePages())
        <a href="{{ $paginate->nextPageUrl() }}">Successivo &gt;</a> |       
    @else
        Successivo &gt; |
    @endif

    <!-- Link all'ultima pagina -->
    @if ($paginate->hasMorePages())
        <a href="{{  $paginate->url($paginate->lastPage())  }}">Fine</a>        
    @else
        Fine
    @endif
</div>
@endif