@extends('app')
@section('title')
    Contact Information
@endsection
@section('contacts.show')
    <img src="{{ asset("/images/$contact->profile_image") }}"/>
    <p>Email: {{ $contact->email }}<p/>
    <p>Telephone numbers: {{ $contact->getTelephoneNumbers() }}</p>
    <p>Tags: {{ $contact->getTags() }}</p>
    <a class="btn btn-link" href="{{ route('contacts.index') }}"><-- back</a>
@stop
