@extends('app')
@section('title')
    All contacts Information
@endsection
@section('contacts.index')
    <a class="btn btn-success btn-sm" href="{{ route('contacts.create') }}">new contact</a>
    <input type="hidden" id="sort" value="asc">
    <table id="tbl-contacts" class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Picture</th>
            <th scope="col">
                Email<i class="fa fa-sort" onclick='sortTable("email")'></i>
            </th>
            <th scope="col">Numbers</th>
            <th scope="col">Tags</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $key=>$contact)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    <img src="{{ URL::to('/') }}/images/{{ $contact->profile_image }}" class="rounded-circle"
                         height="60" width="60"/>
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->getTelephoneNumbers() }}</td>
                <td>{{ $contact->getTags() }}</td>
                <th>
                    <a class="btn btn-primary btn-sm" href="{{ route('contacts.edit',$contact->id) }}">edit</a>
                    {{ Form::open(['method' => 'DELETE','route' => ['contacts.destroy', $contact->id],'style'=>'display:inline', 'class' => 'delete']) }}
                    {{ Form::submit('delete',['class' => 'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                    <a class="btn btn-warning btn-sm" href="{{route('contacts.show',$contact->id) }}">show</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('scripts')
    <script type="text/javascript">
        //Delete contact confirm
        $(".delete").on('submit', function () {
            return confirm("Do you want to delete this item?");
        });
        //Green message functionality
        setTimeout(function () {
            $('.message').slideUp();
        }, 4000);
        //Sort table for column name
        function sortTable(column) {
            let sort = $("#sort").val();
            $.ajax({
                url: "{{ route('contacts.sort.table') }}",
                type: 'post',
                data: {column: column, sort: sort, "_token": "{{ csrf_token() }}"},
                success: function (response) {
                    $("#tbl-contacts tr:not(:first)").remove();
                    $("#tbl-contacts").append(response.view);
                    if (sort == "asc") {
                        $("#sort").val("desc");
                    } else {
                        $("#sort").val("asc");
                    }
                }
            });
        }
    </script>
@endsection
