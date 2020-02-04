<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Contact;
use App\TelephoneNumber;
use App\Http\Requests\ContactForm;

class ContactController extends Controller 
{
    /**
     * @return \Illuminate\Http\Response
     */
    protected function index() 
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function create() 
    {
        $tags = Tag::pluck('name', 'id');
        return view('contacts.create', compact('tags'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(ContactForm $form) 
    {
        $name = $this->upload();
        
        $contact = Contact::create(['email' => request('email'), 'profile_image' => $name]);
        $this->addTel($contact, request('telephone_number_new'));
        $contact->tags()->sync(request('tags_id'));
        
        return response()->json(['route'=> route('contacts.index')]); 
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function edit(Contact $contact) 
    {
        $tags = Tag::pluck('name', 'id');
        return view('contacts.edit', compact('contact', 'tags'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(ContactForm $form, Contact $contact) 
    {   
        if($form->profile_image){
            
            $name = $this->upload();
            unlink("images/$contact->profile_image");
            $contact->update(['email' => request('email'), 'profile_image' => $name]);  
            
        }else{
            $contact->update(request(['email']));
        }   
        
        $contact->tags()->sync(request('tags_id'));
        
        $contact->updateTels(request('telephone_number'));
        $this->addTel($contact, request('telephone_number_new'));    
        
        return response()->json(['route'=> route('contacts.index')]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function destroy(Contact $contact) 
    {
        $contact->delete();
        
        if(file_exists("images/$contact->profile_image")){
            unlink("images/$contact->profile_image");
        }
        
        return back()->withSuccess('Successfully deleted contact.');
    }
    
    private function addTel(Contact $contact, array $tels = null): void
    {
        if(!empty($tels)){
            foreach($tels as $value){
              $contact->addTelephoneNumber(new TelephoneNumber(['number'=> $value]));
            }
        }    
    }
    
    private function upload(): string
    {   
        $image = request('profile_image');
        $name = time().'.'.$image->extension();
        $image->move(public_path('images'), $name);
        
        return $name;
    }
}
