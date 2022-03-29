<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Contact;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check() === true){   
            $user = Auth::user();
            if($user->uid == 0 )
                return true;
            else
                return false;          
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('phone_unique', function ($attribute, $value, $parameters, $validator) {
            $value = preg_replace('/-/', '', preg_replace('/[^z0-9.-]/', '', $value));            
            return Contact::where([ ['phone', $value], ['id', '<>', $this->contato] ])->count() == 0;
        });
       
        return [
            'name' => 'required|min:3',
            'email' => 'required|unique:App\Models\Contact,email'. ($this->contato ? ",$this->contato" : ''). '|max:255',
            'phone' => 'phone_unique|max:15:numeric'
        ];
        
    }

    public function messages()
    {
        return [
            'email.unique' => 'Já existe um cadastro de Contato utilizando o e-mail informado',
            'phone_unique' => 'Já existe um cadastro de Contato utilizando o telefone informado'
        ];
    }
}
