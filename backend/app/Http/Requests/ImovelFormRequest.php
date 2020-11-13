<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImovelFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email_proprietario' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages(){
        return [
            'email_proprietario.required' => 'E-mail informado não é valido',
            'rua.required' => 'Rua é obrigatória',
            'bairro.required' => 'Bairro é obrigatório',
            'cidade.required' => 'Cidade é obrigatória',
            'estado.required' => 'Estado é obrigatório',
        ];
    }
}
