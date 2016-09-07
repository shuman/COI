<div class="modal-dialog">
    <div class="modal-content">
        <form action="" method="post" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info m-l-xs">Delete Manager</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="member_id" value="<?php echo $id; ?>">
                <h3>Are you sure want to delete?</h3>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger pull-left clsBtn" data-dismiss="modal" value="Close" /><span class="msg"></span>
                <button class="btn btn-info deleteManager" data-toggle="class:show inline" data-target="#spin">Delete</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.deleteManager').on('click', function () {
            var deleteBtn = $(this),
                    member_id = $('input[name="member_id"]').val();
//                    user_panel_remove = $("'.user_' + member_id");
            $.ajax({
                url: '/ajax/delete_member',
                type: 'POST',
                dataType: 'JSON',
                data: {member_id: member_id},
                beforeSend: function (xhr) {
                    $('#ajaxModal .btn').addClass('disabled');
                    setTimeout(function () {
                        $('#ajaxModal .btn').removeClass('disabled');
                    }, 4000);
                    $('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-spinner fa-spin"></i> Processing. Please wait...');

                },
                complete: function (jqXHR, textStatus) {

                },
//                timeout: 30000,
                success: function (data, textStatus, jqXHR) {
                    if (data.status === 'OK') {
                        setTimeout(function () {
                            $('.msg').html('<i class="fa fa-check-square"></i> Success! Please wait for page refresh...');
                            $(".user_" + member_id + "").remove();
                            window.location.reload();
                        }, 3000);
                    } else {
                        $('.msg').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Request failed! ' + data.msg + '</span>');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.msg').addClass('text-danger').removeClass('text-success').html('<i class="fa fa-warning"></i> Network error! Please try again.');
                    $('#ajaxModal .btn').removeClass('disabled');
                }
            });
        });
    });
</script>