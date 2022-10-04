
<a href="{{ route('frontpage') }}"  id="home" class="{{ (Route::currentRouteName() == 'frontpage') ? 'active' : '' }}">Home</a>
<a href="{{ route('catalog') }}" id="catalogo" class="{{ (Route::currentRouteName() == 'catalog' || Route::currentRouteName() == 'Ricerca') ? 'active' : '' }}">Catalogo</a>
<a href="{{ asset('Relazione.pdf') }}" id="relazione" target = "_blank">Relazione</a>
@can('isUser')
<a href="{{ route('Area_Utente',[Auth::user()]) }}"  id="AreaUtente" class="{{ Route::currentRouteName() == 'Area_Utente' ? 'active' : '' }}">Area Utente</a>
@endcan
@can('isCompany')
<a href="{{ route('Area_Organizzazione') }}"  id="AreaOrganizzazione" class="{{ (Route::currentRouteName() == 'Area_Organizzazione') ? 'active' : '' }}">Area Organizzazione</a>
@endcan
@can('isAdmin')
<a href="{{ route('Area_Admin') }}"  id="AreaAdmin" class="{{ (Route::currentRouteName() == 'Area_Admin') ? 'active' : '' }}">Area Amministratore</a>
@endcan
			<a href="javascript:void(0);" id = "icon" class="icon" onclick ="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
