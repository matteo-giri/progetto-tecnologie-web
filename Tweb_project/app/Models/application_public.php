<?php

namespace App\Models;

use App\Models\Resources\Event;
use App\Models\Resources\Partecipation;
use App\Models\Resources\Faqs;
use App\User;
use Illuminate\Support\Facades\Auth;

class application_public {

    public function getEvents() {
       return Event::paginate(10);
    }
    public function getNotPaginateEvents() {
       return Event::join('users','event.societaid','=','users.id')->
                get(['event.*','users.nome as societa']);
    }
    
    public function getEventById($eventid){
         $event = Event::where('eventid',$eventid)->join('users','event.societaid','=','users.id')->
                get(['event.*','users.nome as societa'])->first();
         return $event;
    }
    
    
    //funzione che prende gli eventi che stanno per scadere
    public function getExpiringEvents(){
        return $events = Event::where('data', '>=', date('Y-m-d'))
            ->orderBy('data')
            ->take(5)->get();
    }

    //funzione per ottenere i risultati della ricerca
    public function getEventsBySearch($request){
        if($request['organizzazione'] == ""){
            return Event::where([['descrizione', 'like', '%' . $request['descrizione'] . '%'],
                    ['luogo', 'Like' ,$request['luogo']],
                    ['data', 'Like',$request['data']]])->paginate(10);
        }
        else{
            $organizationid = User::where('nome','Like',$request['organizzazione'])->pluck('id')->first();
            return Event::where([['descrizione', 'like', '%' . $request['descrizione'] . '%'],
                    ['luogo', 'Like' ,$request['luogo']],
                    ['data', 'Like',$request['data']],
                    ['societaid', '=',$organizationid]])->paginate(10);
        }
    }
    
    //funzione per ottenere gli eventi popolari
    public function getPopularEvents(){
        return $events = Event::orderBy('bigl_acquis','desc')->take(5)->get();
    }
    
    //funzione che prende il numero dei parteciperò di un evento
    public function getNumPartecipero($eventid){
        $partecipero = Partecipation::where('eventid',$eventid)->get();
        return count($partecipero);
    }
    
    public function getFaq() {
       return Faqs::all();
    }
    
}