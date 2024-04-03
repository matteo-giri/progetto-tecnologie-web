<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;


class NewCompanyRequest extends FormRequest {

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
            'nome' => 'required|string|max:20',
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($this->companyid)],
            'username' => ['required', 'string', 'min:8', 'max:20', Rule::unique('users')->ignore($this->companyid)],
            'password' => 'min:8',
            'data_nascita' => 'required|date',
            'telefono' => 'required|min:10|max:10|regex:^[0-9]{10}^',
            'sitoweb' => 'string|max:50',          
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

  

}
