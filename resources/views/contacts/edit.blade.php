@extends('app')
@section('contacts.edit')
<h2>Edit Contact Information</h2>
{{Form::model($contact,['method'=>'PATCH','route'=>['contacts.update', $contact->id],'files'=>'true', 'id'=>'contact-form'])}}
@include('contacts.form',['submitButtonText'=>'edit'])
{{Form::close()}}
@stop