(function ($) {
    "use strict";



    if (page_data.jobModalOpen) {
        $('#applyJobModal').modal('show');
    }
    if (page_data.flag_job_validation_fails) {
        $('#jobFlagModal').modal('show');
    }
    if (page_data.share_job_validation_fails) {
        $('#shareByEMail').modal('show');
    }


    $(document).on('click', '.employer-follow-button', function (e) {
        e.preventDefault();

        var $that = $(this);
        var employer_id = $that.attr('data-employer-id');

        $.ajax({
            type: 'POST',
            url: page_data.routes.follow_unfollow,
            data: { employer_id: employer_id, _token: page_data.csrf_token },
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