<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Invoice List</h3>
						<small>List of Invoices - Paid, Unpaid!</small>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-12">
						<form action="" method="get" id="invoice_filter_form">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h5 font-bold">Invoice List</span>
								</header>
								<div class="col-md-4 m-t-sm">
									<div class="m-t-xs m-b-n-sm">
										<div class="i-checks checkbox-inline p-l-xs">
					                        <label>
					                            <input type="radio" name="invoices" value="unpaid_invoices" checked="">
					                            <i></i>
					                            Unpaid Invoices
					                        </label>
				                        </div>
				                        <div class="i-checks checkbox-inline">
					                        <label>
					                            <input type="radio" name="invoices" value="paid_invoices" checked="">
					                            <i></i>
					                            Paid Invoices
					                        </label>
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
								<table class="table table-striped m-b-none">
									<thead>
										<tr>
											<th class="hidden-xs" width="20"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
											<th>Invoice ID</th>
											<th class="hidden-xs">Date</th>
											<th class="text-left nowrap">Due Date</th>
											<th class="hidden-xs">Name</th>
											<!-- <th class="hidden-xs">Job Title</th> -->
											<th class="text-center hidden-xs nowrap">Image Qty</th>
											<th class="text-center hidden-xs nowrap">Unit Price</th>
											<th class="text-center nowrap">Total Price</th>
											<th class="text-center">Status</th>
											<th class="text-center">Action</th>
											<!-- <th class="text-right">Action</th> -->
										</tr>
									</thead>
									<tbody id="invoiceslist_box">
										<?php
										if($invoices):
											foreach ($invoices as $invoice) {
												?>
												<tr>
													<td class="hidden-xs">
														<label class="checkbox m-n i-checks"><input type="checkbox" name="ids[]"><i></i></label>
													</td>
													<td >
														<a class="orderid_ellipse" data-toggle="ajaxModal" href="<?php echo site_url('/admin_ajax/popup_order_details?order_id=').$invoice['order_id'];?>">
															<span class="normal inv"><?php echo $invoice['invoice_id'];?></span>
															<span class="fullid p-l-none text-success"><?php echo $invoice['invoice_id'];?></span>
														</a>
													</td>
													<td class="hidden-xs nowrap"><?php echo $invoice['order_date'];?></td>
													<td class="hidden-xs nowrap"><?php echo $invoice['due_date'];?></td>
													<td class="hidden-xs nowrap"><?php echo (!empty($invoice['user_profile']->fullname)) ? $invoice['user_profile']->fullname : "---";?></td>
													<!-- <td class="hidden-xs"><?php echo truncate($invoice['title'], 100, 30);?></td> -->
													<td class="text-center hidden-xs"><?php echo $invoice['quantity'];?></td>
													<td class="text-center hidden-xs">$<?php echo $invoice['unit_price'];?></td>
													<td class="text-center hidden-xs">$<?php echo $invoice['total_value'];?></td>
													<?php if(isset($invoice['paid'])): ?>
														<td class="text-center"><span class="label bg-success m-t-xs">Paid</span></td>
													<?php else: ?>
														<td class="text-center"><span class="label bg-warning m-t-xs">Unpaid</span></td>
													<?php endif;?>
													<!-- <td class="text-right"><a onclick="Portal.wait();" href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="left" title="Invoice Details">Details</a></td> -->
													<td class="text-right nowrap"><a data-toggle="ajaxModal" class="btn btn-xs btn-default" href="<?php echo site_url(); ?>/admin/popup_edit_invoices"><i class="fa fa-pencil"></i>&nbsp;Edit</a>&nbsp;<a data-toggle="ajaxModal" class="btn btn-xs btn-default" href="<?php echo site_url('admin/popup_invoices?invoice=').$invoice['invoice_id']; ?>"><i class="fa fa-eye"></i>&nbsp;View</a>&nbsp;<a class="btn btn-xs btn-default" href="#">Remind</a></td>
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
											<form id="quote_action" name="quote_action_form" method="post" action="">
												<select name="action" class="input-sm form-control input-s inline v-middle">
													<option value="0">Remind Selected</option>
												</select>
												<button type="submit" class="btn btn-sm btn-default">Apply</button>
											</form>
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
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
