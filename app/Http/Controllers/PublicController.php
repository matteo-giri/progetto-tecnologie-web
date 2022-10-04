<?php

namespace App\Http\Controllers;

use App\Models\application_public;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller  {

    protected $_applicationPublic;
  


    public function __construct() {
        $this->_applicationPublic = new application_public;
    }

    //funzione che mostra la home con gli eventi popolari e i prossimi
    public function showHome() {
        $ExpiringEvents = $this->_applicationPublic->getExpiringEvents();
        $PopularEvents = $this->_applicationPublic->getPopularEvents();
        return view('frontpage')->with('expiringEvents',$ExpiringEvents)
                                ->with('popularEvents', $PopularEvents );
    }
    
    //funzione che mostra il catalogo con tutti gli eventi e tutti gli eventi non paginati
    public function showCatalog() {
        
        $TotalEvents = $this->_applicationPublic->getNotPaginateEvents();
        $Events = $this->_applicationPublic->getEvents();
        return view('catalogo')->with('events',$Events)->with('totalevents',$TotalEvents);
    }
    
    public function showModAdes() {

        return view('Mod_adesione');
    }
    
        public function showModForn() {

        return view('Mod_Fornitura_Servizi');
    }
    
    //funzione che mostra la pagina delle faq con tutte le faq
    public function showFaq() {
        $Faq = $this->_applicationPublic->getFaq();
        return view('Faq')->with('faq',$Faq); //aggiunta faq.php, Faq.php
    }
    
    //funzione che mostra la pagina evento con l'evento che gli viene passato tramite id e i numero parteciperò associati
    public function showEvent($idevent) {
        $Event = $this->_applicationPublic->getEventById($idevent);
        $numPartecipero = $this->_applicationPublic->getNumPartecipero($idevent);
        return view('Pag_evento')->with('event',$Event)->with('nPartecipero',$numPartecipero);
    }
    public function showAccedi() {

        return view('Accedi');
    }
     public function showRegistrati() {

        return view('Registrati');
    }
    
    //funzione che viene chiamata quando si fa la ricerca: mette i filtri nella sessione e fa il redirect con il json
    public function search(SearchRequest $request) {
        Session::put('descrizione', $request->descrizione);
        Session::put('luogo', $request->luogo);
        Session::put('data', $request->data);
        Session::put('organizzazione', $request->organizzazione);
     
        /*return view('catalogo')->with('events',$Events)->with('totalevents',$TotalEvents)->with('filters',$filters);*/
        return response()->json(['redirect' => route('processingSearch')]);    
    }
   
    //funzione che processa la ricerca, utilizzando le variabili salvate nella sessione: ritorna il catalogo con gli eventi risultati dalla ricerca e tutti gli eventi non paginati
    public function processSearch(){
        $filters = array('descrizione' => Session::get('descrizione'), 'luogo' => Session::get('luogo'),'data' => Session::get('data'),'organizzazione' =>  Session::get('organizzazione'));
        $Events = $this->_applicationPublic->getEventsBySearch($filters);
        $TotalEvents = $this->_applicationPublic->getNotPaginateEvents();
        return view('catalogo')->with('events',$Events)->with('totalevents',$TotalEvents);
    }
   
}