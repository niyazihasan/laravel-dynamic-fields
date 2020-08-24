@foreach($contacts as $key=>$contact)
    <tr>
        <td>{{ $key }}</td>
        <td>
            <img src="{{ URL::to('/') }}/images/{{ $contact->profile_image }}" class="rounded-circle" height="60" width="60"/>
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
