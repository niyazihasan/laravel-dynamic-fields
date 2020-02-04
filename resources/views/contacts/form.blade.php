<div class="form-group">
    {{Form::label('email','Email:')}}
    {{Form::email('email',null,['placeholder'=>'Enter email','class'=>'form-control'])}}
    <span id="error-email" class="invalid-feedback"></span>
</div>
<div class="form-group">
    {{Form::label('profile_image','Profile picture:')}}
    {{Form::file('profile_image',['class' =>'form-control','accept'=>'image/*'])}}
    <span id="error-profile_image" class="invalid-feedback"></span>
</div>
<div class="form-group">
    <div id="tel-numbers">
        {{Form::label('numbers','Number/s :')}}
        <button type="button" id="add-tel" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> add more
        </button>
        @if(count($contact->telephoneNumbers) === 0)
        <div class="form-group">
            {{Form::number('telephone_number_new[]',null,['placeholder'=>'Enter telephone number','class'=>'form-control'])}}
            <span id="error-telephone_number_new.0" class="invalid-feedback"></span>
        </div>
        @else
        @foreach($contact->telephoneNumbers as $key=>$value)
        <div class="form-group">
            <div class="d-flex">
                {{Form::number("telephone_number[$value->id]", $value->number,['placeholder'=>'Enter telephone number','class'=>'form-control mr-1'])}}
                @if(0 !== $key)
                <button type="button" title="remove" class="remove-tel btn btn-danger"><i class="fa fa-trash"></i></button>
                @endif
            </div>
            <span id="error-telephone_number.{{$value->id}}" class="invalid-feedback"></span>
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="form-group">
    {{Form::label('tags','Tags :')}}
    {{Form::select('tags_id[]',$tags,$contact->tags,['id'=>'tags_id','multiple'=>true,'class'=>'form-control'])}}
    <span id="error-tags_id" class="invalid-feedback"></span>
</div>
{{Form::submit($submitButtonText,['class'=>'btn btn-primary'])}}