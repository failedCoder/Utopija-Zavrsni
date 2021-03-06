<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\User;

use Illuminate\Support\Facades\Auth;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::check()|| !User::pluck('is_admin')){

        return false;
    }
    return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|min:3|string',
            'image' => 'image|required',
            'price' => 'required|digits_between:1,4',
            'description' => 'required|max:2000|min:3|string',
            'category' => 'required'
        ];
    }

     public function messages()
     {
        return [
            'required' => 'Ovo polje je obavezno',
            'max' => 'Previše znakova',
            'min' => 'Potrebna su najmanje 3 znaka',
            'image.required' => 'Odaberite sliku',
            'digits_between' => 'Cijena mora biti broj sa 1 do 4 znamenke',
        ];
    }

}
