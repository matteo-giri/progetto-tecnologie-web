<?php

namespace App\Http\Controllers;

use App\Models\application_company;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\DeleteEventRequest;

class CompanyController extends Controller {

    protected $_companyModel;

    public function __construct() {
        $this->middleware('can:isCompany');
        $this->_companyModel = new application_company;
    }

    //funzione che mostra l'area organizzatore con i suoi eventi e il guadagno totale
    public function showAreaOrg() {

        $TotalEvents = $this->_companyModel->getCompanyEvents();
        $GuadagnoTot = 0;
        foreach ($TotalEvents as $event) {
            $GuadagnoTot += $event->incassoTotale;
        }
        return view('Area_Organizzazione')->with('events', $TotalEvents)->with('guadagno', $GuadagnoTot);
    }

    //funzione attivata quando aggiungiamo un evento
    public function storeEvent(NewEventRequest $request) {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = NULL;
        }
        $this->_companyModel->addEvent($request,$imageName);
        if (!is_null($imageName)) {
            $destinationPath = storage_path() . '/app/EventImages';
            $image->move($destinationPath, $imageName);
        };

         return response()->json(['redirect' => route('Area_Organizzazione')]);
    }

    //funzione attivata quando aggiorniamo un evento
    public function updateEvent(UpdateEventRequest $request) {


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = $request->image_path;
        }
        $this->_companyModel->updateEventById($request->eventid, $request, $imageName);


        if ($request->hasFile('image')) {
            $destinationPath = storage_path() . '/app/EventImages';
            $image->move($destinationPath, $imageName);
        };

        return response()->json(['redirect' => route('Area_Organizzazione')]);
    }

    //funzione che elimina un evento
    public function deleteEvent(DeleteEventRequest $request) {
        $this->_companyModel->deleteTicketById($request->eventid);
        $this->_companyModel->deletePartecipazioneByEventId($request->eventid);
        $this->_companyModel->deleteEventById($request->eventid);

        return redirect('AreaOrganizzazione');
    }

    //funzione che ritorna la vista dell'area organizzazione ma con l'evento da modificare aperto
    public function getEventToUpdate($id) {
        $selected_event = $this->_companyModel->getEventById($id);
        $TotalEvents = $this->_companyModel->getCompanyEvents();

        $GuadagnoTot = 0;
        foreach ($TotalEvents as $event) {
            $GuadagnoTot += $event->incassoTotale;
        }
        return view('Area_Organizzazione')->with('selected_event', $selected_event)->with('events', $TotalEvents)->with('guadagno', $GuadagnoTot);
    }

}
