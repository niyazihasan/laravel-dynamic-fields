<div class="row">
    <div class="col-sm-6">
        {{ Form::label('email','Email:') }}
        {{ Form::email('email',null,['data-id'=>$contact->id,'data-url' => route('contacts.email.exists'),'placeholder'=>'Enter email','class'=>'form-control']) }}
        <span id="error-email" class="error"></span>
    </div>
    <div class="col-sm-6">
        {{ Form::label('profile_image','Profile picture:') }}
        <input type="file" name="profile_image" class="form-control"/>
        <img src="{{ URL::to('/') }}/images/{{ $contact->profile_image }}" class="rounded-circle" height="100" width="100" />
        <span id="error-profile_image" class="error"></span>
    </div>
</div>
<div class="form-group">
    <div id="tel-numbers">
        {{ Form::label('numbers','Number/s :') }}
        <button type="button" id="add-tel" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> add more
        </button>
        @if(count($contact->telephoneNumbers) === 0)
            <div class="form-group">
                {{ Form::number('telephone_number[]',null,['id'=>'telephone_number0','placeholder'=>'Enter telephone number','class'=>'form-control']) }}
                <span id="error-telephone_number.0" class="error"></span>
            </div>
        @else
            @foreach($contact->telephoneNumbers as $key=>$value)
                <div class="form-group">
                    <div class="d-flex">
                        {{ Form::number("telephone_number[]", $value->number,['id'=>"telephone_number$key",'placeholder'=>'Enter telephone number','class'=>'form-control mr-1']) }}
                        @if(0 !== $key)
                            <button type="button" title="remove" class="remove-tel btn btn-danger">
                                <i class="fa fa-trash"></i></button>
                        @endif
                    </div>
                    <span id="error-telephone_number.{{ $key }}" class="error"></span>
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('tags','Tags :') }}
    {{ Form::select('tags_id[]',$tags,$contact->tags,['id'=>'tags_id','multiple'=>true,'class'=>'form-control']) }}
    <span id="error-tags_id" class="error"></span>
</div>
{{ Form::submit($submitButtonText,['class'=>'btn btn-primary']) }}
