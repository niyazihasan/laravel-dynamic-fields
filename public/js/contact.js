$(function () {

    $('#tel-numbers > #add-tel').click(function (e) {
        let countNumbers = $("span[id^='error-telephone_number_new']").length;
        let i = 1 === countNumbers ? 1 : countNumbers;
        $('#tel-numbers').append('<div class="form-group"><div class="d-flex"><input type="number" name="telephone_number_new[]" placeholder="Enter telephone number" class="form-control mr-1" /><button title="remove" type="button" class="remove-tel btn btn-danger"><i class="fa fa-trash"></i></button></div><span id="error-telephone_number_new.' + i++ + '" class="invalid-feedback"></span></div>');
    });

    $('body').on('click', '#tel-numbers .remove-tel', function () {
        $(this).closest('.form-group').remove();
        $("span[id^='error-telephone_number_new']").each(function (i) {
            $(this).attr('id', 'error-telephone_number_new.' + i);
        });
    });

    $.validator.addMethod("checkEmail", function (value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, "Please enter a valid email address.");

    $.validator.addMethod('checkSize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let email = $("input[name='email']");
    $('#contact-form').validate({
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
            profile_image: {extension: "jpg,jpeg,png", checkSize: 200000}
        },
        messages: {
            email: {remote: "Email cannot be used."},
            profile_image: {extension: "Please upload file in these format only (jpg, jpeg, png)."}
        },
        highlight: function (element) {
            jQuery(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            jQuery(element).closest('.form-control').removeClass('is-invalid');
            jQuery(element).closest('.form-control').addClass('is-valid');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
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
                    $("span[id^='error-']").text('');
                    $("#contact-form :input").removeClass('is-invalid');
                    $("#contact-form :input").addClass('is-valid');
                    $.each(errors, function (i, item) {
                        let t = i.replace('.', '\\.');
                        $('#error-' + t).parent().find('input:first, select:first').addClass('is-invalid');
                        $('#error-' + t).html(item);
                    });
                }
            });
        },
    });

});
