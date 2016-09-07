<section class="hbox stretch">
	<section>
		<section class="vbox" id="dashboard-custom-style">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black"><?php echo lang('order_1');?></h3>
						<small><?php echo lang('order_2');?></small>
						<!-- <pre><?php print_r($orders); ?><pre/> -->
					</div>
					<div class="col-sm-6">
						<ul class="breadcrumb">
		                    <li><a href="<?php echo site_url('/admin/');?>"><i class="fa fa-home"></i> Home</a></li>
		                    <li class="active">Order List</li>
	                  	</ul>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-12">
						<form action="" method="get" id="order_filter_form">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="label bg-danger dker pull-right p-xs m-r-xs">1 Over Due</span>
									<span class="label bg-warning dker pull-right p-xs m-r-xs">2 Pending</span>
									<span class="h5 font-bold"><?php echo lang('order_1');?></span>
								</header>
								<div class="col-md-4 m-t-sm">
									<div class="m-t-xs m-b-n-sm">
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_pending" type="checkbox" name="order_status[]" value="<?php echo ORDER_PENDING; ?>"> <i></i> <span class="text-left"> Pending</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_due" type="checkbox" name="due" value="1"> <i></i> <span class="text-left"> Over Due</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input class="order_filter" id="f_completed" type="checkbox" name="order_status[]" value="<?php echo ORDER_COMPLETED; ?>"> <i></i> <span class="text-left"> Completed</span> </label>
										</div>
									</div>
								</div>
								<div class="col-sm-5 m-b-sm m-t-sm">
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
								<div class="col-sm-12 b-t"></div>
								<table id="orders_list" class="table table-striped m-b-none">
									<thead>
										<tr>
											<th>Order ID</th>
											<th class="hidden-xs">Date</th>
											<th class="hidden-xs">Title</th>
											<th class="hidden-xs">Name</th>
											<th class="nowrap text-center hidden-xs">Quantity</th>
											<th class="nowrap text-center hidden-xs">Unit Price</th>
											<th class="nowrap text-center hidden-xs">Total Price</th>
											<!-- <th class="nowrap text-center hidden-xs">TAT</th> -->
											<th class="nowrap text-center hidden-xs">Time Left</th>
											<th class="nowrap text-center">Status</th>
											<th class="text-right">&nbsp;Action&nbsp;&nbsp;</th>
										</tr>
									</thead>
									<tbody id="orderslist_box">
										<?php
										if($orders):
											foreach ($orders as $order) {
												?>
												
												<tr>                    
													<td>
														<a class="orderid_ellipse" data-toggle="ajaxModal" href="<?php echo site_url('/admin_ajax/popup_order_details');?>/?order_id=<?php echo $order['order_id']; ?>">
															<span class="normal"><?php echo $order['order_id']; ?></span>
															<span class="fullid text-success"><?php echo $order['order_id']; ?></span>
															<!-- <span class="shortid"><?php echo orderid_short($order['order_id']); ?></span> -->
														</a>
													</td>
													<td>
														<span class="text-ellipsis"><?php echo $order['order_date']; ?></span>
													</td>
													<td class="hidden-xs"><?php echo truncate($order['title'], 100, 30); ?></td>
													<td><?php echo (!empty($order['user_profile']->fullname)) ? $order['user_profile']->fullname : "Guest"; ?></td>
													<!-- <td class="hidden-xs" nowrap=""><?php echo $order['order_date']; ?></td> -->
													<td class="text-center"><?php echo $order['quantity']; ?></td>
													<td class="text-center hidden-xs">$<?php echo $order['unit_price']; ?></td>
													<td class="text-center">$<?php echo $order['total_value']; ?></td>

													<?php /*if(isset($order['countup'])): ?>
														<td class="text-center hidden-xs">Flexible</td>
													<?php else: ?>
														<td class="text-center hidden-xs"><?php echo $order['tat']; ?>H</td>
													<?php endif;*/ ?>

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
														<td class="text-center sts"><span class="label <?php echo (isset($order['success'])) ? 'bg-info' : '';?> <?php echo (isset($order['cancelled'])) ? 'bg-light dker':'';?> m-t-xs"><?php echo $order['order_status']; ?></span></td>
													<?php endif; ?>

													<td class="text-right nowrap">
														<?php if(isset($order['success'])): //Check if order is already marked as completed ?>
															<?php if(!is_downloadable($order['order_id'])): ?>
																<span data-toggle="tooltip" title="File Missing!" data-placement="left" class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>&nbsp;
															<?php endif; ?>
															<a data-toggle="ajaxModal" href="site_url(admin/edit_popup_order);?>/<?php echo $order['order_id']; ?>" class="btn btn-xs btn-icon btn-default disabled"><i class="fa fa-pencil"></i></a>
															<a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default disabled"><i class="fa fa-check text-info"></i></a>
														<?php else: ?>
															<?php if(!is_downloadable($order['order_id'])): ?>
																<span data-toggle="tooltip" title="File Missing!" data-placement="left" class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>&nbsp;
																<!-- <a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="You can Edit!"><i class="fa fa-pencil"></i></a> -->
																<a data-toggle="ajaxModal" href="<?php echo site_url('admin/edit_popup_order');?>/?order_id=<?php echo $order['order_id']; ?>" class="btn btn-xs btn-icon btn-default"><i class="fa fa-pencil"></i></a>
																<a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default disabled" data-toggle="tooltip" data-placement="top" title="Done? Please put downloadable file to download folder."><i class="fa fa-check"></i></a>
															<?php else: ?>
																<a href="javascript:void(0)" onclick="Admin.jobEditPopup('<?php echo $order['order_id']; ?>');" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="You can Edit!"><i class="fa fa-pencil"></i></a>
																<!-- <a data-toggle="ajaxModal" href="<?php echo site_url('admin/order_popup_complete'); ?>" onclick="Admin.jobComplete('<?php echo $order['order_id']; ?>');" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="Done?"><i class="fa fa-check"></i></a> -->
																<a href="javascript:void(0)" onclick="Admin.jobComplete('<?php echo $order['order_id']; ?>');" class="btn btn-xs btn-icon btn-default"><i class="fa fa-check"></i></a>
															<?php endif; ?>
														<?php endif; ?>
														<a href="javascript:void(0);" onclick="expandOrderDetails('<?php echo $order['order_id']; ?>', $(this))"><span class="btn btn-xs btn-icon btn-default"><i class="fa fa-eye"></i></span></a>
													</td>
												</tr>
												<tr id="order-<?php echo $order['order_id']; ?>" class="order-details hide">
													<td colspan="11">
														<div class="row">
															 <div class="col-sm-12">
											                	<a class="btn b-s-n"  href="javascript:void(0)" onclick="closeCollapsible('<?php echo $order['order_id']; ?>')" ><i class="fa fa-times-circle"></i></a>
											                </div>
															<div class="col-sm-4">
																<div class="table-responsive">
																	<div class="order-id-box">
																		<div class="i-title">
																			<h5>Order ID:</h5>
																		</div>
																		<span class="nowrap text-ellipsis"><?php echo $order['order_id']; ?></span>
																		<span class="nowrap d-none"><?php echo $order['order_id']; ?></span>
																	</div>
																	<table class="table table-striped m-b-none collapsible-style t1-table-style">
													                    <!-- <thead>
													                        <tr>
													                          <th colspan="2">Job Title</th>
													                        </tr>
													                    </thead> -->
												                      	<tbody>
												                        	<tr>
												                        		<td>
												                        			<div class="t-style">
												                        				<span>Job Title</span>
												                        			</div>
												                        			<p><?php echo $order['title']; ?></p>
												                        		</td>
												                        	</tr>
												                        	<tr>
												                        		<td>
												                        			<div class="t-style">
												                        				<span>Options:</span>
												                        			</div>
																					<p>⇛ Clipping Path Only ($2.00)</p>
																					<p>⇛ Image Complexity: Medium </p>
																					<p>⇛ Background: White BG</p>
																				</td>
												                        	</tr>

												                        	<tr>
												                        		<td>
												                        			<div class="t-style">
												                        				<span>Return File Format:</span>
												                        			</div>
																						<p>JPEG | PNG | TIFF</p>
																				</td>
												                        	</tr>

												                        	<tr>
												                        		<td>
												                        			<div class="t-style">
												                        				<span>Order Note/ Job Instructions</span>
												                        			</div>
																					<p class="t-style-d">Lorem Ipsum is simply dummy text of the printing and 
																					typesetting industry. Lorem Ipsum has been the industry's 
																					standard dummy text ever since the 1500s, when an unknown 
																					printer took a galley of type and scrambled it to make a 
																					type specimen book.</p>
																				</td>
												                        	</tr>
												                        	
												                      	</tbody>
												                    </table>
								                        		</div>
											                </div>
											                <div class="col-sm-5">
											                	<div class="table-responsive">
												                	<div class="colck-box i-block">
												                		<div class="i-title">
																			<h5>Time Left:</h5>
																		</div>
												                		<span>
													                		<?php 
													                		
													                			if (!empty($order['done_before'])) {
												                        			echo $order['done_before']; 
												                        		} 
										                        			?>
												                        </span>
												                	</div>
												                	<div class="status-box i-block">
												                		<div class="i-title">
																			<h5>Status:</h5>
																		</div>
												                		<span><?php echo $order['order_status']; ?></span>
												                	</div>
												                	<table class="table table-striped m-b-none collapsible-style t2-table-style">
													                    <!-- <thead>
													                        <tr>
													                          <th colspan="2">Job Title</th>
													                        </tr>
													                    </thead> -->
												                      	<tbody>
												                      		<tr>
												                        		<td>
											                        				<span>Order Date<span/>
											                        			</td>
											                        			<td>
										                        					<?php echo $order['order_date']; ?>
												                        		</td>
												                        	</tr>
												                        	<tr>
												                        		<td>
											                        				<span>Completed Date<span/>
											                        			</td>
											                        			<td>
										                        					N/A
												                        		</td>
												                        	</tr>
												                        	<tr>
												                        		<td>
											                        				<span>Image Quantity<span/>
												                        		</td>
												                        		<td>
												                        			<?php echo $order['quantity']; ?>
												                        		</td>
												                        	</tr>
												                        	<tr>
												                        		<td>
											                        				<span>Unit Price<span/>
											                        			</td>
											                        			<td>
										                        					<?php echo "$". $order['unit_price']; ?>
										                        				</td>
												                        	</tr>
												                        	<tr>
												                        		<td>
											                        				<span>Total Price<span/>
											                        			</td>
											                        			<td>
										                        					<?php echo "$". $order['total_value']; ?>
										                        				</td>
												                        	</tr>
												                      	</tbody>
												                    </table>
												                    <div class="form-group m-t-md"> 
												                    	<textarea class="form-control parsley-validated bg-ar-d" rows="3" data-minwords="6" placeholder="Admin note for this order..."></textarea> 
											                    	</div>
												                    <div class="a-b-box">
												                    	<div class="btn-group block">
												                    		<a href="#" class="btn btn-s-md  btn-info btn-block">Mark as done!</a>
														                </div>
												                    </div>
											                    </div>
											                </div>
											                <div class="col-sm-3">
											                	<div class="turnaround-time-box">
												                	<div class="turnaround-time">
												                		<div class="i-title">
												                			<h5>TAT</h5>
																		</div>
												                		<span><i class="i i-clock2"></i>&nbsp;<?php echo $order['tat']; ?>&nbsp;Hours</span>
												                	</div>
												                	<div class="p-info">
												                		<h4>User Information</h4>
												                		<p><strong>Name:</strong> <?php echo (!empty($order['user_profile']->fullname)) ? $order['user_profile']->fullname : "Guest" ; ?></p>
												                		<p><strong>Company:</strong> <?php echo (!empty($order['user_profile']->company)) ? $order['user_profile']->company : "Example Company"; ?></p>
												                		<p><strong>Email:</strong> <?php echo (!empty($order['user_profile']->email)) ? $order['user_profile']->email : "hello@example.com"; ?></p>
												                		<p><strong>Phone:</strong> <?php echo (!empty($order['user_profile']->phone)) ? $order['user_profile']->phone : "Not Provided" ; ?></p>
												                		<p><strong>Country:</strong> <?php echo country_name( (!empty($order['user_profile']->country)) ? $order['user_profile']->country : "Not Provided"); ?></p>
												                	</div>
												                	<div class="b-t inline ar-block bg-white">
													                	<div class="col-md-6 b-r">
												                            <a href="#" class="block padder-v hover">
												                            	
												                              	<span class="clear">
													                                <span class="h4 block m-t-xs text-info">09:30</span>
													                                <small class="text-muted text-u-c">Local Time</small>
												                              	</span>
												                              	
												                            </a>
											                          	</div>
											                          	<div class="col-md-6">
												                            <a href="#" class="block padder-v hover">
												                              	
												                              	<span class="clear">
													                                <span class="h4 block m-t-xs text-warning">06</span>
													                                <small class="text-muted text-u-c">Pending</small>
												                              	</span>
												                            </a>
											                          	</div>
													                </div>

												                	<a href="<?php echo site_url('/admin/clientProfile/'); ?>/<?php echo (!empty($order['user_id'])) ? $order['user_id'] : '';?>" class="btn btn-s-md m-t btn-primary">View Profile</a>
											                	</div>
											                </div>
														</div>
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

<script type="text/javascript">
	function expandOrderDetails(id, e){
		$(".order-details").addClass("hide");
		if( $(e).hasClass('expandedOrderDetails') ){
			$(e).removeClass('expandedOrderDetails');
			$(e).children('span').removeClass('active');
			$(e).removeClass('expandedOrderDetails');
		}
		else{
			$(e).addClass('expandedOrderDetails');
			$(e).children('span').addClass('active');
			$("#order-"+id).removeClass("hide");
		}
	}
	function closeCollapsible(id){
		$('.expandedOrderDetails').children('span').removeClass('active');
		$('.expandedOrderDetails').removeClass('expandedOrderDetails');
		$(".order-details").addClass("hide");
	}
	
	$(document).ready(function(){
		Portal.PageInit.OrderList();
	});
</script>
