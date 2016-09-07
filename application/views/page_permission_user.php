<div class="modal-dialog">
    <div class="modal-content">
        <form action="" method="post" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info m-l-xs">Permission User</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>
                            <?php $access = $this->portal_lib->get_company_permission($company_members['user_id'], $company_members['company_id']); ?>
                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['create_order']) && $access['create_order'] == 1 ? 'btn-success active' : ''; ?>" 
                                    id="acl_create_order" 
                                    href="#" 
                                    data-user="<?php echo $company_members['id']; ?>" 
                                    data-action="create_order" 
                                    data-status="<?php echo isset($access['create_order']) && $access['create_order'] == 1 ? 1 : 0; ?>" 
                                    data-toggle="class:btn-success">
                                <i class="fa fa-square-o text"></i>
                                <i class="fa fa-check-square-o text-active"></i>
                                <span>Create Order</span>
                            </button>
                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['quote_approve']) && $access['quote_approve'] == 1 ? 'btn-success active' : ''; ?>"  
                                    id="acl_quote_approve" 
                                    href="#" 
                                    data-user="<?php echo $company_members['id']; ?>" 
                                    data-action="quote_approve" 
                                    data-status="<?php echo isset($access['quote_approve']) && $access['quote_approve'] == 1 ? 1 : 0; ?>" 
                                    data-toggle="class:btn-success">
                                <i class="fa fa-square-o text"></i>
                                <i class="fa fa-check-square-o text-active"></i>
                                <span>Quote Approve</span>
                            </button>
                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['billing']) && $access['billing'] == 1 ? 'btn-success active' : ''; ?>"  
                                    id="acl_billing" 
                                    href="#" 
                                    data-user="<?php echo $company_members['id']; ?>" 
                                    data-action="billing" 
                                    data-status="<?php echo isset($access['billing']) && $access['billing'] == 1 ? 1 : 0; ?>" 
                                    data-toggle="class:btn-success">
                                <i class="fa fa-square-o text"></i>
                                <i class="fa fa-check-square-o text-active"></i>
                                <span>Billing</span>
                            </button>
                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['manage_user']) && $access['manage_user'] == 1 ? 'btn-success active' : ''; ?>" 
                                    id="acl_manage_user" 
                                    href="#" 
                                    data-user="<?php echo $company_members['id']; ?>" 
                                    data-action="manage_user" 
                                    data-status="<?php echo isset($access['manage_user']) && $access['manage_user'] == 1 ? 1 : 0; ?>"
                                    data-toggle="class:btn-success">
                                <i class="fa fa-square-o text"></i>
                                <i class="fa fa-check-square-o text-active"></i>
                                <span>Manage User</span>
                            </button>
                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['message_board']) && $access['message_board'] == 1 ? 'btn-success active' : ''; ?>" 
                                    id="acl_message_board" 
                                    href="#" 
                                    data-user="<?php echo $company_members['id']; ?>" 
                                    data-action="message_board" 
                                    data-status="<?php echo isset($access['message_board']) && $access['message_board'] == 1 ? 1 : 0; ?>" 
                                    data-toggle="class:btn-success">
                                <i class="fa fa-square-o text"></i>
                                <i class="fa fa-check-square-o text-active"></i>
                                <span>Message Board</span>
                            </button>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger pull-left" data-dismiss="modal" value="Close" />
                <span class="msg"></span>
                <button class="btn btn-info setPermission" data-toggle="class:show inline" data-target="#spin">Save Permission</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.setPermission').on('click', function () {
            var members_id = $('#acl_create_order').data('user'),
                    order_status = $('#acl_create_order').hasClass('active') ? '1' : '0',
                    quote_status = $('#acl_quote_approve').hasClass('active') ? '1' : '0',
                    billing_status = $('#acl_billing').hasClass('active') ? '1' : '0',
                    manage_status = $('#acl_manage_user').hasClass('active') ? '1' : '0',
                    mesaage_status = $('#acl_message_board').hasClass('active') ? '1' : '0';
            $.ajax({
                url: '/ajax/permission_set_edit',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    member_id: members_id,
                    order_status: order_status,
                    quote_status: quote_status,
                    billing_status: billing_status,
                    manage_status: manage_status,
                    message_status: mesaage_status,
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
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.msg').addClass('text-danger').removeClass('text-success').html('<i class="fa fa-warning"></i> Network error! Please try again.');
                    $('#ajaxModal .btn').removeClass('disabled');
                }
            });
        });
    });
</script>