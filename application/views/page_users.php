<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black"><?php echo lang('am_title'); ?></h3>
                        <small><?php echo lang('am_subtitle'); ?></small>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="get" id="order_filter_form">
                            <section class="panel panel-default">
                                <?php if ($this->company->user_id == $this->user_id): ?>

                                    <header class="panel-heading">
                                        <span class="h5 font-bold"><?php echo lang('am_userlist'); ?></span>
                                    </header>
                                    <table id="orders_list" class="table table-striped m-b-none">
                                        <thead>
                                            <tr>
                                                <th class="hidden-xs">Name</th>
                                                <th class="hidden-xs">Email</th>
                                                <th class="text-center">Role/Status</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">Avatar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="team_manager">
                                            <?php
                                            if ($invited_members) {
                                                foreach ($invited_members as $invited) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $invited->invite_to_name; ?></td>
                                                        <td><?php echo $invited->invite_to; ?></td>
                                                        <td class="text-center">Invited (Pending)</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-center"><img style="max-width: 30px;" src="<?php echo avatar($invited->invite_to, array(30, 30)); ?>" class="img-circle b-a b-1x b-success"></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                            if ($company_members) {
                         
                                                foreach ($company_members as $member) {
                                                    $access = $this->portal_lib->get_company_permission($member->id, $this->company->id);
                                                    ?>
                                                    <tr> 
                                                        <td><?php echo $member->fullname; ?></td>
                                                        <td><?php echo $member->email; ?></td>
                                                        <td class="text-center"><?php echo $member->designation; ?></td>
                                                        <td>
                                                            <button class="btn btn-default btn-xs change_ac <?php echo isset($access['create_order']) && $access['create_order'] == 1 ? 'btn-success active' : ''; ?>" 
                                                                    id="acl_create_order" 
                                                                    href="#" 
                                                                    data-user="<?php echo $member->id; ?>" 
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
                                                                    data-user="<?php echo $member->id; ?>" 
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
                                                                    data-user="<?php echo $member->id; ?>" 
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
                                                                    data-user="<?php echo $member->id; ?>" 
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
                                                                    data-user="<?php echo $member->id; ?>" 
                                                                    data-action="message_board" 
                                                                    data-status="<?php echo isset($access['message_board']) && $access['message_board'] == 1 ? 1 : 0; ?>" 
                                                                    data-toggle="class:btn-success">
                                                                <i class="fa fa-square-o text"></i>
                                                                <i class="fa fa-check-square-o text-active"></i>
                                                                <span>Message Board</span>
                                                            </button>
                                                        </td>
                                                        <td class="text-center"><img src="<?php echo avatar($member->email, array(30, 30)); ?>" class="img-circle b-a b-1x b-success"></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-4 hidden-xs">
                                                <a href="<?php echo site_url('ajax/invite_user'); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-success"><i class="i i-user2"></i> Invite User</a>
                                            </div>
                                        </div>
                                    </footer>

                                <?php else: ?>
                                    <header class="panel-heading">
                                        <span class="h5 font-bold text-danger">You don't have permission to manage this section for <span class="text-warning"><?php echo $this->company->name; ?></span></span>
                                    </header>
                                <?php endif; ?>

                            </section>
                        </form>
                    </div>

                </div>
            </section>
        </section>
    </section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>