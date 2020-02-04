@extends('app')
@section('contacts.show')
<h2>Contact Information</h2>
<img src="{{asset("/images/$contact->profile_image")}}" />
<p>Email: {{$contact->email}}<p/>
<p>Telephone numbers:
    @foreach($contact->telephoneNumbers as $number)
    {{$number->number}}
    @endforeach
</p>
<p> Tags:
    @foreach($contact->tags as $tag)
    {{$tag->name}}
    @endforeach
</p>
<a class="btn btn-link" href="{{route('contacts.index')}}">back</a>
@stop