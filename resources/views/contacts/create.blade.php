@extends('app')
@section('contacts.create')
<h2>Create Contact Information</h2>
{{Form::model($contact=new App\Contact,['method'=>'post','route'=>['contacts.store'],'files'=>'true', 'id'=>'contact-form'])}}
@include('contacts.form',['submitButtonText'=>'save'])
{{Form::close()}}
@stop