<!--Helper per il prezzo dell'evento -->

<p class="price"> {{ number_format($event->getPrice($event->scontoIsEnable()), 2, ',', '.') }} € </p>

@if ($event->scontoIsEnable())
<p class="discprice"> Valore <del>{{ number_format($event->getPrice(false), 2, ',', '.') }} €</del><br>
    Sconto {{ $event->scontoPerc }}%</p>
@endif
