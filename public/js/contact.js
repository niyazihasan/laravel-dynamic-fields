$(function () {

    //add dynamic number fields
    $('#tel-numbers > #add-tel').click(function (e) {
        let countNumbers = $("span[id^=error-telephone_number]").length;
        let i = 1 === countNumbers ? 1 : countNumbers;
        $('#tel-numbers').append('<div class="form-group"><div class="d-flex"><input type="number" name="telephone_number[]" placeholder="Enter telephone number" id="telephone_number' + i + '" class="form-control mr-1" /><button title="remove" type="button" class="remove-tel btn btn-danger"><i class="fa fa-trash"></i></button></div><span id="error-telephone_number.' + i + '" class="error"></span></div>');
    });

    //remove dynamic number fields
    $('body').on('click', '#tel-numbers .remove-tel', function () {
        $(this).closest('.form-group').remove();
        $("input[id^=telephone_number]").each(function (i) {
            $(this).attr('id', 'telephone_number' + i + '');
        });
        $("span[id^=error-telephone_number]").each(function (i) {
            $(this).attr('id', 'error-telephone_number.' + i + '');
        });
    });

    $.validator.addMethod("checkEmail", function (value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, "Please enter a valid email address.");

    $.validator.addMethod('checkSize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes');

    $.validator.addMethod("checkNumbers", function (value, element) {
        let flag = true;
        $("input[name^=telephone_number]").each(function (i, j) {
            $(this).closest('.form-group').find('label.error').remove();
            let numberPattern = new RegExp(/^[0][0-9]{9}$/);
            let number = numberPattern.test($(this).val());
            console.log(6);
            if (number == false) {
                flag = false;
                $(this).closest('.form-group').append('<label id="telephone_number' + i + '-error" class="error">The field must be 10 digits and start with one of the following: 0</label>');
            }
        });
        return flag;
    }, "");

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    let email = $("input[name='email']");
    $('#contact-form').validate({
        ignore: '',
        rules: {
            email: {
                required: true,
                email: true,
                checkEmail: true,
                maxlength: 30,
                remote: {
                    url: email.data('url'),
                    data: {'id': email.data('id'),},
                    type: "post"
                }
            },
            profile_image: {extension: "jpg,jpeg,png", checkSize: 200000},
            "telephone_number[]": {checkNumbers: true}
        },
        messages: {
            email: {remote: "Email cannot be used."},
            profile_image: {extension: "Please upload file in these format only (jpg, jpeg, png)."}
        },
        highlight: function (element) {
            $(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).closest('.form-control').removeClass('is-invalid');
            $(element).closest('.form-control').addClass('is-valid');
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        errorClass: 'error',
        submitHandler: function (form) {
            $.ajax({
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(form),
                mimeType: "multipart/form-data",
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                dataType: 'json',
                success: function (data) {
                    window.location = data.route;
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    $("span[id^=error-]").text('');
                    $("#contact-form :input").removeClass('is-invalid');
                    $("#contact-form :input").addClass('is-valid');
                    $.each(errors, function (i, item) {
                        let t = i.replace('.', '\\.');
                        $('#error-' + t).parent().find('input:first, select:first').addClass('is-invalid');
                        $('#error-' + t).html(item);
                    });
                }
            });
        }
    });

    // show upload image
    $("input[name=profile_image]").change(function () {
        input = this;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(".rounded-circle").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    });

});
