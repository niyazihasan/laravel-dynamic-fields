@extends('app')
@section('title')
    Create Contact Information
@endsection
@section('contacts.create')
{{Form::model($contact=new App\Contact,['method'=>'post','route'=>['contacts.store'],'files'=>'true', 'id'=>'contact-form'])}}
@include('contacts.form',['submitButtonText'=>'save'])
{{Form::close()}}
@stop
@section('scripts')
    <script src="{{asset('js/contact.js')}}"></script>
@endsection
