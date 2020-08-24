<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cn = count(\Request::segments()) > 1 ? \Request::segments()[1] : '';

        $rules = [
            'email' => 'required|email:rfc,dns|unique:contact,email,' . $cn,
            'profile_image' => 'image|mimes:jpeg,jpg,png|max:200000',
            //'tags_id' => 'required',
        ];

        if (!empty($this->request->get('telephone_number'))) {
            foreach ($this->request->get('telephone_number') as $key => $value) {
                $rules["telephone_number.{$key}"] = 'required|digits:10|starts_with:0';
            }
        }

        return $rules;
    }
}
