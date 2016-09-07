<div class="modal-dialog">
    <div class="modal-content">
        <form action="" method="post" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info m-l-xs">Message</h4>
            </div>
            <div class="modal-body">
                <p class="ar-text-justify">
                <div class="row">
                    <div class="col-lg-12">
<!--                        <section class="panel panel-default">-->
                        <section class="panel-body comment-list">
                            <!-- comment form -->
                            <article id="comment-form" class="comment-item media m-b-md">
                                <form id="message_form" onsubmit="" action="" method="post" class="m-t-sm" action="">
                                    <input type="hidden" name="company_id" value="<?php echo $user_id; ?>">
                                    <div class="media-body form-group">
                                        <strong class="control-label">Subject</strong>
                                        <input type="text" name="subject" class="form-control subjectField" />
                                        <span class="subjectMsg"></span>
                                    </div>
                                    <section class="media-body">
                                        <div class="form-group">
                                            <strong class="control-label">Message</strong>
                                            <textarea id="message" rows="7" name="message" placeholder="Please write your messages / comments here!" class="form-control messageField"></textarea>
                                            <span class="messageArea"></span>
                                        </div>
                                    </section>
                                </form>
                            </article>
                        </section>
                        <!--                        </section>-->
                    </div>
                </div>
                </p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger pull-left" data-dismiss="modal" value="Close" />
                <span class="msg"></span>
                <button class="btn btn-info sendMessage" data-toggle="class:show inline" data-target="#spin">Send</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
    $(function () {
        $('.subjectField').on('keyup', function () {
            if ($(this).val().length > 0) {
                $('.subjectField').css('border', '1px solid #ccc');
                $('.subjectMsg').removeClass('text-danger').show().html('');
                return true;
            }
        });
        $('.messageField').on('keyup', function () {
            if ($(this).val().length > 0) {
                $('.messageField').css('border', '1px solid #ccc');
                $('.messageArea').removeClass('text-danger').show().html('');
                return true;
            }
        });
        $('.sendMessage').on('click', function () {
            var subject = $('input[name="subject"]').val(),
                    message = $('textarea[name="message"]').val(),
                    company_id = $('input[name="company_id"]').val();
            if (subject === '') {
                $('.subjectField').css('border', '1px solid #e33244');
                $('.subjectMsg').addClass('text-danger').show().html('<i class="fa fa-exclamation-triangle"></i> Fillup subject field.');
                return false;
            }
            if (message === '') {
                $('.messageField').css('border', '1px solid #e33244');
                $('.messageArea').addClass('text-danger').show().html('<i class="fa fa-exclamation-triangle"></i> Fillup message field..');
                return false;
            }
            $.ajax({
                url: '/ajax/send_message_to_user',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    subject: subject,
                    company_id: company_id,
                    message: message,
                },
                beforeSend: function (xhr) {
                    $('#ajaxModal .btn').addClass('disabled');
                    setTimeout(function () {
                        $('#ajaxModal .btn').removeClass('disabled');
                    }, 4000);
                    $('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-spinner fa-spin"></i> Seting permission. Please wait...');
                },
                complete: function (jqXHR, textStatus) {

                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status === 'OK') {
                        setTimeout(function () {
                            $('.msg').html('<i class="fa fa-check-square"></i> Success! Please wait for page refresh...');
                            window.location.reload();
                        }, 5000);
                    } else {
                        $('.msg').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Request failed! ' + data.msg + '</span>');
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    $('.msg').addClass('text-danger').removeClass('text-success').html('<i class="fa fa-warning"></i> Network error! Please try again.');
                    $('#ajaxModal .btn').removeClass('disabled');
                }
            });
        });
    });
</script>
