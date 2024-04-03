<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
// Aggiunti per response JSON
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class NewEventRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        // Nella form non mettiamo restrizioni d'uso su base utente
        // Gestiamo l'autorizzazione ad un altro livello
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nome' => 'required|max:25',
            'prezzo' => 'required|numeric|min:0',
            'sconto' => 'required',
            'scontoPerc' => 'required|numeric|min:0|max:100',
            'nGiorniAttSconto' => 'required|numeric|min:0',
            'societaid' => 'required',
            'luogo' => 'required|max:30',
            'bigl_tot' => 'required|numeric|min:0',
            'bigl_acquis' => 'required|min:0',
            'categoria' => 'required|max:30',
            'Ycord' => 'required|numeric',
            'Xcord' => 'required|numeric',
            'descrizione' => 'required|max:100',
            'programma' => 'required|max:100',
            'data' => 'required|date',
            'orario' => 'required|date_format:H:i',
            'image' => 'file|mimes:jpeg,png|max:1024',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
