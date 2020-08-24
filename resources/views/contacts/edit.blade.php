@extends('app')
@section('title')
    Edit Contact Information
@endsection
@section('contacts.edit')
    {{ Form::model($contact,['method'=>'PATCH','route'=>['contacts.update', $contact->id],'files'=>'true', 'id'=>'contact-form']) }}
    @include('contacts.form',['submitButtonText'=>'edit'])
    {{ Form::close() }}
@stop
@section('scripts')
    <script src="{{ asset('js/contact.js') }}"></script>
@endsection
