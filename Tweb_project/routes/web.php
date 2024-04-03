<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*ROTTE PUBBLICHE*/
Route::get('/','PublicController@showHome') //rotta che mostra la homepage
        ->name('frontpage');

Route::get('/catalog','PublicController@showCatalog') //rotta che mostra il catalogo
        ->name('catalog');

Route::get('/catalog/search','PublicController@processSearch') //rotta che viene attivata quando ottengo la risposta ajax della ricerca
        ->name('processingSearch');

Route::post('/catalog','PublicController@search') //rotta attivata dalla form di ricerca
        ->name('Ricerca');

Route::get('/ModAdesione','PublicController@showModAdes') //rotta che mostra la pagina di modalità adesione
        ->name('Mod_Adesione');

Route::get('/ModFornServ','PublicController@showModForn') //rotta che mostra la pagina di modalità fornitura
        ->name('Mod_Fornitura_servizi');

Route::get('/Faq','PublicController@showFaq') //rotta che mostra la pagina delle faq
        ->name('Faq');

Route::get('/PagEvento/{idevent}','PublicController@showEvent') //rotta che mostra la pagina di uno specifico evento
        ->name('Pagina_Evento');


/*ROTTE DELL'UTENTE DI LIVELLO 2*/
Route::get('/PagEvento/{idevent}/compra','UserController@showBuyForm') //rotta che mostra la pagina di acquisto di un evento
        ->name('Compra_Biglietto')->middleware('can:isSoldout,idevent')->middleware('can:isPastEvent,idevent');

Route::post('/PagEvento/compra/process','UserController@buyForm') //rotta attivata dalla form di acquisto biglietti
        ->name('Compra');

Route::get('/PagEvento/compra/riepilogo','UserController@buyFormProcess') //rotta che mostra la pagina di riepilogo d'acquisto
        ->name('Riepilogo');

Route::get('/AreaRiservata/{user}', 'UserController@showAreaRiservata') //rotta che mostra l'area riservata dell'utente
        ->name('Area_Utente'); //->middleware('can:isUser');

Route::post('/AreaRiservata/{user}','UserController@updateUser') //rotta attivata dalla form di modifica dell'utente
        ->name('Modifica_Utente');

Route::get('/AreaRiservata/{user}/Storico', 'UserController@showStorico') //rotta che mostra lo storico di uno specifico utente
        ->name('Storico');

Route::post('/PagEvento/Partecipero', 'UserController@partecipero') //rotta attivata dal pulsante "parteciperò" nella pagina evento
        ->name('Partecipero');

Route::post('/PagEvento/AnnullaPartecipazione', 'UserController@annullaPartecipazione') //rotta attivata dal pulsante "annulla partecipazione" nella pagina evento
        ->name('Annulla_Partecipazione');

/*ROTTE DELL'UTENTE DI LIVELLO 3*/

Route::get('/AreaOrganizzazione', 'CompanyController@showAreaOrg') //rotta che mostra l'area organizzazione
        ->name('Area_Organizzazione');

Route::post('/AreaOrganizzazione/modifica', 'CompanyController@updateEvent') //rotta attivata dalla form di modifica di un evento
        ->name('updateEvent');

Route::post('/AreaOrganizzazione/add', 'CompanyController@storeEvent') //rotta attivata dalla form di aggiunta di un evento
        ->name('store_event');

Route::post('/AreaOrganizzazione/deleteEvent', 'CompanyController@deleteEvent') //rotta attivata dal pulsante di eliminazione di un evento
        ->name('deleteEvent');

Route::get('/AreaOrganizzazione/getEventToUpdate/{id}', 'CompanyController@getEventToUpdate') //rotta che serve per ricaricare la pagina ma con l'evento da modificare aperto
        ->name('getEventToUpdate');
        


/*ROTTE DELL'UTENTE DI LIVELLO 4*/

Route::get('/AreaAmministratore', 'AdminController@showAreaAdmin') //rotta che mostra l'area admin
        ->name('Area_Admin');

Route::get('/AreaAmministratore/FaqAdmin','AdminController@showAdminFaq')
        ->name('Faq_Admin');

Route::post('/AreaAmministratore/delete_user','AdminController@deleteUser') //rotta attivata dal bottone di eliminazione di un utente
        ->name('delete_user');

Route::post('/AreaAmministratore/update_company','AdminController@updateCompanyRequest') //rotta attivata dalla form di modifica di un'organizzazione
        ->name('update_company');

Route::post('/AreaAmministratore/new_company','AdminController@newCompanyRequest') //rotta attivata dalla form di inserimento di un'organizzazione
        ->name('new_company');

Route::get('/AreaAmministratore/update_company/{companyid}','AdminController@getCompanyToUpdate') 
        ->name('company_to_update');

Route::post('/AreaAmministratore/modificaFaq','AdminController@getFaqToUpdate') //rotta attivata dalla form di modifica di una faq
        ->name('modificaFaq');

Route::post('/deleteFaq', 'AdminController@getFaqToDelete') //rotta attivata dal pulsante di eliminazione di una faq
        ->name('FaqToDelete');

Route::post('/new_faq','AdminController@newFaqRequest') //rotta attivata dal pulsante di aggiunta di una faq
        ->name('newFaq');



/*ROTTE PER L'AUTENTICAZIONE*/
Route::get('login', 'Auth\LoginController@showLoginForm') //rotta che mostra la pagina di login
        ->name('Accedi');

Route::post('login', 'Auth\LoginController@login'); //rotta attivata dalla form di login

Route::post('logout', 'Auth\LoginController@logout') //rotta attivata dal pulsante di logout
        ->name('logout');



/*ROTTE PER LA REGISTRAZIONE*/
Route::get('register', 'Auth\RegisterController@showRegistrationForm') //rotta che mostra la pagina di registrazione
        ->name('Registrati');

Route::post('register', 'Auth\RegisterController@register'); //rotta attivata dalla form di registrazione
/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 */
