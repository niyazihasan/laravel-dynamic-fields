@extends('app')
@section('title')
    All contacts Information
@endsection
@section('contacts.index')
    <a class="btn btn-success btn-sm" href="{{route('contacts.create')}}">new contact</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Picture</th>
            <th scope="col">Email</th>
            <th scope="col">Numbers</th>
            <th scope="col">Tags</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>
                    {{$contact->profile_image ? "yes" : "no"}}
                </td>
                <td>{{$contact->email}}</td>
                <td>
                    @foreach($contact->telephoneNumbers as $number)
                        {{$number->number}}
                    @endforeach
                </td>
                <td>
                    @foreach($contact->tags as $tag)
                        {{$tag->name}}
                    @endforeach
                </td>
                <th>
                    <a class="btn btn-primary btn-sm" href="{{route('contacts.edit',$contact->id)}}">edit</a>
                    {{Form::open(['method' => 'DELETE','route' => ['contacts.destroy', $contact->id],'style'=>'display:inline', 'class' => 'delete'])}}
                    {{Form::submit('delete',['class' => 'btn btn-danger btn-sm'])}}
                    {{Form::close()}}
                    <a class="btn btn-warning btn-sm" href="{{route('contacts.show',$contact->id)}}">show</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('scripts')
    <script type="text/javascript">
        //Delete contact confirm
        $('.delete').on('submit', function () {
            return confirm("Do you want to delete this item?");
        });
        //Green message functionality
        setTimeout(function () {
            $('.message').slideUp();
        }, 4000);
    </script>
@endsection
