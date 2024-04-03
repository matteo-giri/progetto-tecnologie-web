<?php

namespace App\Models;

use App\Models\Resources\Event;
use App\Models\Resources\Ticket;
use App\Models\Resources\Partecipation;
use Illuminate\Support\Facades\Auth;

class application_company {

    public function getEventById($eventId) {
        return Event::where('eventid', $eventId)->first();
    }

    //ritorna gli eventi dell'organizzatore loggato
    public function getCompanyEvents() {
        $societa = Auth::user()->id;
        return $events = Event::where('societaid', $societa)->join('users','event.societaid','=','users.id')->
                get(['event.*','users.nome as societa']);
    }
    
    //aggiunge un evento
    public function addEvent($Event, $imageName) {
        
        $event = new Event;
        $event->fill($Event->validated());
        $event->image = $imageName;
        $event->save();
        
    }
    
    //modifica un evento
    public function updateEventById($id,$request,$imageName) {
        $event =  Event::find($id);
        $event->nome = $request->nome;
        $event->luogo = $request->luogo;
        $event->prezzo = $request->prezzo;
        $event->societaid = Auth::user()->id;
        $event->luogo = $request->luogo;
        $event->bigl_tot = $request->bigl_tot;
        $event->bigl_acquis = $request->bigl_acquis;
        $event->categoria = $request->categoria;
        $event->Ycord = $request->Ycord;
        $event->Xcord = $request->Xcord;
        $event->descrizione = $request->descrizione;
        $event->programma = $request->programma;
        $event->data = $request->data;
        $event->orario = $request->orario;
        $event->sconto = $request->sconto;

        if ($request->sconto) {
            $event->scontoPerc = $request->scontoPerc;
            $event->nGiorniAttSconto = $request->nGiorniAttSconto;
        } else {
            $event->scontoPerc = 0;
            $event->nGiorniAttSconto = 0;
        }
        $event->image = $imageName;
        $event->save();
    }

    //funzione che elimina i biglietti di un evento
    public function deleteTicketById($eventId) {
        $ticket = Ticket::where('eventid',$eventId)->first();
        if($ticket!=null)
            $ticket->delete();
    }
    //funzione che elimina un evento
    public function deleteEventById($id) {
            $this->getEventById($id)->delete();
    }
    
    //funzione che elimina i parteciperò di un evento
    public function deletePartecipazioneByEventId($id){
        $partecipazione = Partecipation::where('eventid',$id);
        if($partecipazione!=null){
            $partecipazione->delete();
        }
            
    }
}
