<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Event;
use App\Models\Resources\Ticket;
use App\User;
use App\Models\Resources\Partecipation;

/**
 * Description of user
 *
 * @author lorti
 */
class application_user {
    
    //funzione che serve per modificare il numero di biglietti comprati di un evento quando un utente li compra
    public function modifyTicketNumberById($eventId,$numbiglietti){
        $Event = Event::find($eventId);
        $Event->bigl_acquis = $Event->bigl_acquis + $numbiglietti;
        $Event->save();
    }
    
    //Funzione aggiunta per aggiornare incasso compagnie su singolo evento
    public function modifyTicketIncassoById($eventId, $numbiglietti) {
        $Event = Event::find($eventId);
        $Event->incassoTotale += $numbiglietti*$Event->getPrice($Event->sconto);
        $Event->save();
    }
    
    //funzione per aggiungere un biglietto al database
    public function insertTicket($eventId,$userId,$nBiglietti,$price){
        $data = array('user_id' => $userId,'eventid' => $eventId, 'quantita' => $nBiglietti, 'prezzo' => $price ,'data_acquisto' => date("Y/m/d"));
        $ticket = new Ticket();
        $ticket->fill($data);
        $ticket->save();
        return $ticket;
    }
    
    public function getTicketById($id){
        return Ticket::find($id);
    }
    public function getUser(){
        return Auth::user();
    }
    
    //funzione per modificare le credenziali di un utente
    public function modifyCredentials($userid,$credentials){
        $user = User::find($userid);
        $user->fill($credentials);
        $user->save();
        return $user;
    }
    
    //funzione per prendere i biglietti di un utente
    public function getTickets(){
        $user = Auth::user();
        $tickets = Ticket::where('user_id',$user->id)->join('event','event.eventid','=','ticket.eventid')->join('users','event.societaid','=','users.id')->orderBy('data_acquisto','desc')->
                        get(['event.*','users.nome as societa', 'ticket.TransId as TransId', 'ticket.data_acquisto as data_acquisto','ticket.prezzo as costoTot','ticket.quantita as quantita','ticket.user_id as user_id, ticket.eventid as eventid']);
                        
        return $tickets;
    }
    
    //funzione per aggiungere un parteciperò
    public function addPartecipero($userid,$eventid){
        $partecipero = new Partecipation;
        $partecipero->user_id = $userid;
        $partecipero->eventid = $eventid;
        $partecipero -> save();
    }
    
    //funzione per prendere uno specifico parteciperò
    public function getPartecipero($userid,$eventid){
        return Partecipation::where([['user_id', $userid],
                ['eventid', $eventid]])->first();
    }
    
    //funzione per rimuovere un parteciperò
    public function deletePartecipero($userid,$eventid){
        Partecipation::where([['user_id', $userid],
                ['eventid', $eventid]])->first()->delete();
    }
}   
