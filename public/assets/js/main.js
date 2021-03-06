(function ($) {
    "use strict";
    $(document).on('click', '.employer-follow-button', function (e) {
        e.preventDefault();

        let $that = $(this);
        let employer_id = $that.attr('data-employer-id');

        $.ajax({
            type: 'POST',
            url: page_data.routes.follow_unfollow,
            data: {employer_id: employer_id, _token: page_data.csrf_token},
            beforeSend: function () {
                $that.addClass('updating-btn');
            },
            success: function (data) {
                if (data.success) {
                    if (typeof data.btn_text !== 'undefined') {
                        $that.html(data.btn_text);
                    }
                } else {
                    if (typeof data.login_url !== 'undefined') {
                        location.href = data.login_url;
                    }
                }
            },
            complete: function () {
                $that.removeClass('updating-btn');
            }
        });
    });

    //updating-btn

})(jQuery);
