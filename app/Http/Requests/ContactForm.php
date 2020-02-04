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
        
        $rules =[
            'email' => 'required|email|unique:contact,email,'.$cn,
            'profile_image' => $cn ? 'image|mimes:jpeg,jpg,png|max:2048' : 'required|image|mimes:jpeg,jpg,png|max:2048',
            'tags_id' => 'required|array',
        ];
        
        if(!empty($this->request->get('telephone_number'))){
            foreach($this->request->get('telephone_number') as $key => $value) {
                $rules["telephone_number.{$key}"] = 'required';
            }
        }
        
        // dynamic number fields
        if(!empty($this->request->get('telephone_number_new'))){
            foreach($this->request->get('telephone_number_new') as $key => $value) {
                $rules["telephone_number_new.{$key}"] = 'required';
            }
        }
        
        return $rules;
    }
    
    public function messages(): array 
    {
        $messages = [];
        
        if(!empty($this->request->get('telephone_number_new'))){
            foreach ($this->request->get('telephone_number_new') as $key => $val) {
                $messages['telephone_number_new.' . $key . '.required'] = 'The telefone number field is required.';
            }
        }
        
        // dynamic number fields
        if(!empty($this->request->get('telephone_number'))){
            foreach ($this->request->get('telephone_number') as $key => $val) {
                $messages['telephone_number.' . $key . '.required'] = 'The telefone number field is required.';
            }
        }
        
        return $messages;
    }
}