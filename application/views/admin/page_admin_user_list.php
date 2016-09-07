<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">All User List</h3>
                        <small>All user View, Edit, Ban.</small>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <!--span class="label bg-danger pull-right m-t-xs">3 Rejected</span>
                                <span class="label bg-success pull-right m-t-xs m-r-xs">10 Accepted</span>
                                <span class="label bg-warning pull-right m-t-xs m-r-xs">16 Awaiting Review</span-->
                                <span class="h5 font-bold">User List</span>
                            </header>
                            <table class="table table-striped m-b-none" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="20"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
                                        <th class="text-center" width="20">#</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Company</th>
                                        <th class="text-center">Website</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center" width="100">User Type</th>
                                        <th class="text-center" width="80">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="quoteslist_box">
                                    <?php if (count($user_data) > 0) : foreach ($user_data as $value): ?>
                                            <tr>
                                                <td><label class="checkbox m-n i-checks"><input type="checkbox" name="post[]"><i></i></label></td>
                                                <td><?php echo $value->user_id; ?></td>
                                                <td><a data-toggle="ajaxModal" href="<?php echo site_url('/admin/edit_client_profile/' . $value->user_id); ?>" class="text-success" ><?php echo $value->fullname; ?></a></td>
                                                <td><?php echo $value->email; ?></td>
                                                <td><?php echo $value->phone; ?></td>
                                                <td><?php echo (!empty($value->company)) ? $value->company : 'N/A'; ?></td>
                                                <td><?php echo (!empty($value->website)) ? $value->website : 'N/A'; ?></td>
                                                <td><?php echo (!empty($value->country)) ? country_name($value->country) : 'N/A'; ?></td>
                                                <td><?php echo ($value->role_id == 1 ? "Administrator" : ($value->role_id == 2 ? "User" : "Unknown")); ?></td>
                                                <td class="nowrap">

                                                    <!-- <a data-toggle="ajaxModal" href="
                                                    <?php echo site_url('/admin/edit_client_profile/' . $value->user_id); ?>" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>&nbsp;Edit</a>&nbsp;  -->
                                                    <a href="<?php echo site_url('/admin/clientProfile/'); ?>/<?php echo (!empty($value->user_id)) ? $value->user_id : ''; ?>" class="btn btn-xs btn-default">View</a>
                                                    <!-- <a data-toggle="ajaxModal" href="<?php echo site_url('/admin/edit_client_profile/' . $value->user_id); ?>" class="btn btn-xs btn-default" ><i class="fa fa-eye"></i>&nbsp;Profile</a>&nbsp; -->
                                                    <?php if ($value->banned == 0): ?>
                                                        <a data-toggle="ajaxModal" href="<?php echo site_url('/admin/admin_ban_user/' . $value->user_id); ?>" class="btn btn-xs btn-default" ><i class="fa fa-minus-circle text-danger"></i></a>
                                                    <?php else: ?>
                                                        <a href="<?php echo site_url('/admin/admin_unban_user/' . $value->user_id); ?>" class="btn btn-xs btn-default active" ><i class="fa fa-minus-circle"></i></a>
                                                    <?php endif ?>
                                                    <?php if ($value->whitelisted == 0): ?>
                                                        <!--<a data-toggle="ajaxModal" href="javascript:void(0)" class="btn btn-xs btn-default userListed" data-index="blacklisted" data-id="<?php echo $value->user_id; ?>"><i class="fa fa-minus-circle text-danger"></i></a>-->
                                                    <?php else: ?>
                                                        <!--<a href="javascript:void(0)" class="btn btn-xs btn-default active userListed" data-index="whitelisted" data-id="<?php echo $value->user_id; ?>"><i class="fa fa-minus-circle"></i></a>-->
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-4 hidden-xs">

                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <small class="text-muted inline m-t-sm m-b-sm"><?php echo (isset($showing)) ? $showing : ''; ?></small>
                                    </div>
                                    <div class="col-sm-4 text-right text-center-xs">                
                                        <ul class="pagination pagination-sm m-t-none m-b-none">
                                            <?php echo (isset($pagination)) ? $pagination : ''; ?>
                                        </ul>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

