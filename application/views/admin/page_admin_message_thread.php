<section class="hbox stretch">
	<aside class="aside-md bg-light dker b-r" id="subNav">
		<div class="wrapper b-b header">Comapnies</div>
		<ul class="nav">
			<?php 
			if($companies){
				foreach ($companies as $company) {
					echo '<li class="b-b "><a href="'.site_url('/admin/messages').'?company='.$company->id.'">
					<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>
					<!--span class="badge bg-danger pull-right">'.$company->total.'</span-->
					'.$company->name.'</a></li>';
				}
			}
			?>
		</ul>
	</aside>
	<aside>
		<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">
						<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						<!--div class="btn-group">
							<button type="button" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
							<button type="button" class="btn btn-sm btn-default" title="Filter" data-toggle="dropdown"><i class="fa fa-filter"></i> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div-->
						<a href="modal.html" data-toggle="ajaxModal" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> New Message</a>
					</div>
					<div class="col-sm-4 m-b-xs">
						<!--div class="input-group">
							<input type="text" class="input-sm form-control" placeholder="Search">
							<span class="input-group-btn">
								<button class="btn btn-sm btn-default" type="button">Go!</button>
							</span>
						</div-->
					</div>
				</div>
			</header>
			<section class="scrollable wrapper w-f">
				<section class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped m-b-none">
							<thead>
								<tr>
									<th data-toggle="class">Message Threads</th>
									<th width="10"><div class="text-center">#</div></th>
									<th width="200">Last Message</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                // var_dump($messages);
                                if($threads){
                                    foreach ($threads as $thread) {
                                        ?>
										<tr>
											<td><a href="<?php echo site_url('/admin/messages'). '?thread=' . $thread->msg_hashid;?>"><?php echo $thread->msg_subject;?></a></td>
											<td><span class="badge pull-center"><?php echo $thread->msg_count;?></span></td>
											<td><i class="fa fa-clock-o"></i> <span class="timeago" title="<?php echo $thread->last_update;?>"><?php echo date("F d, Y", strtotime($thread->last_update));?></span></td>
										</tr>
										<?php
                                    }
                                }
                                ?>
							</tbody>
						</table>
					</div>
				</section>
			</section>
			<footer class="footer bg-white b-t">
				<div class="row text-center-xs">
					<div class="col-md-6 hidden-sm">
						<p class="text-muted m-t"><?php echo (isset($showing)) ? $showing : ''; ?></p>
					</div>
					<div class="col-md-6 col-sm-12 text-right text-center-xs">                
						<ul class="pagination pagination-sm m-t-sm m-b-none">
							<?php echo (isset($pagination)) ? $pagination : ''; ?>
						</ul>
					</div>
				</div>
			</footer>
		</section>
	</aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".timeago").timeago();
	});
</script>