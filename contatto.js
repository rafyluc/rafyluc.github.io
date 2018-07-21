$('.ajax-contact-form').on('submit', function(e) {
    e.preventDefault();

	var $form = $(this);
    var $responseSuccess = $form.find('.ajax-contact-form-response-success');
    var $responseError = $form.find('.ajax-contact-form-response-error');

    $.ajax({
        type: 'POST',
        url: $form.attr('action'),
        data: $form.serialize(),
        success: function(response) {
            response = JSON.parse(response);
            if (response.type && response.type === 'success') {
                $responseError.hide();
                $responseSuccess.html(response.response).show();
                $form[0].reset();
            } else {
                $responseSuccess.hide();
                $responseError.html(response.response).show();
            }
        },
        error: function(response) {
            $responseSuccess.hide();
            $responseError.html(response.responseText).show();
        }
     });
});