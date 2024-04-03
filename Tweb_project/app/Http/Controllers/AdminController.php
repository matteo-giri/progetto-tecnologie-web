<?php

namespace App\Http\Controllers;

use App\Models\application_public;
use App\Models\application_admin;
use App\Http\Requests\NewCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\NewFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\DeleteFaqRequest;

Class AdminController extends Controller {

 protected $_applicationPublic;
protected $_applicationAdmin;

 public function __construct() {
$this->middleware('can:isAdmin');
$this->_applicationPublic = new application_public;
$this->_applicationAdmin = new application_admin;
}

//funzione che mostra l'area admin, con gli utenti, le compagnie e le compagnie con le varie analisi
 public function showAreaAdmin() {
$users = $this->_applicationAdmin->getUsers();
$companies = $this->_applicationAdmin->getCompanies();
$companiesWithAnalisi = [];
foreach ($companies as $company)
$companiesWithAnalisi[$company->id] = ["company" => $company, 'incasso' => $this->_applicationAdmin->getCompanyEventsIncasso($company->id), 'venduti' => $this->_applicationAdmin->getCompanyEventsVenduti($company->id)];

 return view('Area_admin')->with('users', $users)->with('companies', $companies)->with('companiesWithAnalisi', $companiesWithAnalisi);
}

/*
public function showAreaAdmin(){
$users = $this->_applicationAdmin->getUsers();
return view('Area_admin')->with('users',$users);
} */

//funzione che elimina un utente
 public function deleteUser(DeleteUserRequest $request) {
$this->_applicationAdmin->deleteTicketsById($request->userid);
$this->_applicationAdmin->deleteUserById($request->userid);
return redirect('AreaAmministratore');
}

//funzione attivata quando aggiungo una compagnia
 public function newCompanyRequest(NewCompanyRequest $request) {
$this->_applicationAdmin->addCompany($request);
return response()->json(['redirect' => route('Area_Admin')]);
}

//funzione attivata quando aggiorno una compagnia
 public function updateCompanyRequest(UpdateCompanyRequest $request) {
$this->_applicationAdmin->updateCompany($request);
return response()->json(['redirect' => route('Area_Admin')]);
}

//funzione obsoleta
 public function getCompanyToUpdate($id) {
$selected_company = $this->_applicationAdmin->getUserById($id);
$users = $this->_applicationAdmin->getUsers();
$companies = $this->_applicationAdmin->getCompanies();
$companiesWithAnalisi = [];
foreach ($companies as $company)
$companiesWithAnalisi[$company->id] = ["company" => $company, 'incasso' => $this->_applicationAdmin->getCompanyEventsIncasso($company->id), 'venduti' => $this->_applicationAdmin->getCompanyEventsVenduti($company->id)];

 return view('Area_Admin')->with('users', $users)->with('companiesWithAnalisi', $companiesWithAnalisi);
}

//funzione attivata quando elimino una faq
 public function getFaqToDelete(DeleteFaqRequest $request) {
$this->_applicationAdmin->deleteFaqById($request->faqId);
return redirect('Faq');
}

//funzione attivata quando aggiorno una faq
 public function getFaqToUpdate(UpdateFaqRequest $request) {
$this->_applicationAdmin->updateFaq($request);
return response()->json(['redirect' => route('Faq')]);
}

//funzione attivata quando creo una fqa
 public function newFaqRequest(NewFaqRequest $request) {
$this->_applicationAdmin->addFaq($request);
return response()->json(['redirect' => route('Faq')]);
}

//funzione obsoleta
 public function showAdminFaq() {
$Faq = $this->_applicationPublic->getFaq();
return view('Faq_Admin')->with('_faq', $Faq);
}

}