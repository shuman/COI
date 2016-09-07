<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black"><?php echo lang('audit_log');?></h3>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-12">
						<form action="" method="get" id="order_filter_form">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h5 font-bold"><?php echo lang('audit_log_list');?></span>
								</header>
								<table id="orders_list" class="table table-striped m-b-none">
									<thead>
										<tr>
											<th>#</th>
											<th>User</th>
											<th>Action</th>
											<th class="hidden-xs">Info</th>
											<th class="text-right">Timestamp</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if($logs):
											foreach ($logs as $log) {
												?>
												<tr>
													<td width="10" nowrap=""><?php echo $log->id;?></td>
													<td width="150" nowrap=""><?php echo $log->user_name;?> :: <?php echo $log->user_id;?></td>
													<td width="300"><?php echo $log->action;?></td>
													<td><?php echo $log->info;?></td>
													<td width="200" nowrap="" class="text-right"><?php echo date("F d, Y H:i:s", strtotime($log->insert_at));?></td>
												</tr>
												<?php 
											}
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
						</form>
					</div>

				</div>
			</section>
		</section>
	</section>
</section>