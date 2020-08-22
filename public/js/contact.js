$(function () {

    //Green message functionality
    setTimeout(function () {
        $('.message').slideUp();
    }, 4000);

    $('#tel-numbers > #add-tel').click(function () {
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

    $('#contact-form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            processData: false,
            contentType: false,
            type: form.attr('method'),
            data: new FormData(this),
            url: form.attr('action'),
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
            },
        });
    });

});
