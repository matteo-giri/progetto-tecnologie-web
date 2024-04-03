<!--Helper per le immagini degli eventi, mette l'immagine di default se non è specificata-->

@if($img != NULL)
<img src="{{ asset('../storage/app/EventImages/' .$img) }}" >
@else
<img src="{{ asset('../storage/app/EventImages/default.jpg') }}" >
@endif