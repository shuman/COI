<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black"><?php echo lang('order_1');?></h3>
						<small><?php echo lang('order_2');?></small>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-12">
						<form action="" method="get" id="order_filter_form">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h5 font-bold"><?php echo lang('order_1');?></span>
								<div class="col-md-6 m-t-sm">
								</header>
									<div class="m-t-xs m-b-n-sm">
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_pending" type="checkbox" name="order_status[]" value="<?php echo ORDER_PENDING; ?>"> <i></i> <span class="text-left"> Pending</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_due" type="checkbox" name="due" value="1"> <i></i> <span class="text-left"> Due</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_completed" type="checkbox" name="order_status[]" value="<?php echo ORDER_COMPLETED; ?>"> <i></i> <span class="text-left"> Completed</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_cancelled" type="checkbox" name="order_status[]" value="<?php echo ORDER_CANCELLED; ?>"> <i></i> <span class="text-left"> Cancelled</span> </label>
										</div>
									</div>
								</div>
								<div class="col-sm-3 m-b-sm m-t-sm">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-sm btn-default active">
											<input class="order_filter" type="radio" name="period" id="period_all" value="all"> All
										</label>
										<label class="btn btn-sm btn-default">
											<input class="order_filter" type="radio" name="period" id="period_today" value="today"> Today
										</label>
										<label class="btn btn-sm btn-default">
											<input class="order_filter" type="radio" name="period" id="period_week" value="week"> Last Week
										</label>
										<label class="btn btn-sm btn-default">
											<input class="order_filter" type="radio" name="period" id="period_month" value="month"> Last Month
										</label>
									</div>
								</div>
								<div class="col-sm-3 m-b-sm m-t-sm">
									<div class="input-group">
										<input type="search" class="input-sm form-control" name="keyword" placeholder="Search">
										<span class="input-group-btn">
											<input class="btn btn-sm btn-default" name="search" type="submit" value="Go!">
										</span>
									</div>
								</div>

								<table id="orders_list" class="table table-striped m-b-none">
									<thead>
										<tr>
											<th>Order ID</th>
											<th class="hidden-xs">Title</th>
											<th class="hidden-xs">Order Date</th>
											<th class="text-center hidden-xs">Quantity</th>
											<th class="text-center hidden-xs">Unit Price</th>
											<th class="text-center hidden-xs">Total Price</th>
											<th class="text-center hidden-xs">TAT</th>
											<th class="text-center hidden-xs">Time Left</th>
											<th class="text-center">Status</th>
											<th class="text-right">&nbsp;Action&nbsp;&nbsp;</th>
										</tr>
									</thead>
									<tbody id="orderslist_box">
										<?php
										if(isset($orders)):
											foreach ($orders as $order) {
												?>
												<tr>                    
													<td><a data-toggle="ajaxModal" href="<?php echo site_url('/admin_ajax/popup_order_details');?>/?order_id=<?php echo $order['order_id']; ?>"><?php echo $order['order_id']; ?></a></a></td>
													<td class="hidden-xs"><?php echo $order['title']; ?></td>
													<td class="hidden-xs" nowrap=""><?php echo $order['order_date']; ?></td>
													<td class="text-center"><?php echo $order['quantity']; ?></td>
													<td class="text-center hidden-xs">$<?php echo $order['unit_price']; ?></td>
													<td class="text-center">$<?php echo $order['total_value']; ?></td>

													<?php if(isset($order['countup'])): ?>
														<td class="text-center hidden-xs">Flexible</td>
													<?php else: ?>
														<td class="text-center hidden-xs"><?php echo $order['tat']; ?> Hrs</td>
													<?php endif; ?>

													<?php if(isset($order['timer'])): ?>
														<?php if(isset($order['countup'])): ?>
															<td class="text-center hidden-xs text-warning lter">N/A</td>
														<?php else: ?>
															<td class="text-center hidden-xs text-warning lter"><span data-countdown="<?php echo $order['timer']; ?>">00:00:00</span></td>
														<?php endif; ?>
														<td class="text-center sts"><span class="label bg-warning m-t-xs"><?php echo $order['order_status']; ?></span></td>
													<?php else: ?>
														<?php if(isset($order['expired'])): ?>
															<td class="text-center hidden-xs <?php echo (isset($order['success'])) ? 'text-danger' : '';?> <?php echo (isset($order['cancelled'])) ? 'text-muted':'';?> lter">-<?php echo $order['done_before']; ?></td>
														<?php else: ?>
															<td class="text-center hidden-xs <?php echo (isset($order['success'])) ? 'text-success' : '';?> <?php echo (isset($order['cancelled'])) ? 'text-muted':'';?> lter"><?php echo $order['done_before']; ?></td>
														<?php endif; ?>
														<td class="text-center sts"><span class="label <?php echo (isset($order['success'])) ? 'bg-success' : '';?> <?php echo (isset($order['cancelled'])) ? 'bg-light dker':'';?> m-t-xs"><?php echo $order['order_status']; ?></span></td>
													<?php endif; ?>

													<td class="text-right nowrap">
														<?php if(isset($order['success'])): ?>
															<?php if(!is_downloadable($order['order_id'])): ?>
																<span data-toggle="tooltip" title="Downloadable file not available!" class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>&nbsp;
															<?php endif; ?>
															<a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default disabled">
																<i class="fa fa-check"></i>
															</a>
														<?php else: ?>
															<?php if(!is_downloadable($order['order_id'])): ?>
																<span data-toggle="tooltip" title="Downloadable file not available!" class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>&nbsp;
															<?php endif; ?>
															<a href="javascript:void(0)" onclick="Admin.jobComplete('<?php echo $order['order_id']; ?>');" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="Mark as Job Completed">
																<i class="fa fa-check"></i>
															</a>
														<?php endif; ?>
													</td>
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