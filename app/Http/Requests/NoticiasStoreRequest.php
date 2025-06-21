<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiasStoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string => mixed>
     */
    public function rules()
    {
        return [
            'titulo'        =>  "required",
            'categoria_id'  =>  "required",
            'arquivo'       =>  "required",
            'descricao'     =>  "required",
            'status'        =>  "required",
            'seo_titulo'    =>  "required",
            'seo_keywords'  =>  "required",
            'seo_descricao' =>  "required"
        ];
    }
}