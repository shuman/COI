<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Quotation List</h3>
						<small>List of Quotes - Awaiting Review, Accepted, Rejected!</small>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading">
								<!--span class="label bg-danger pull-right m-t-xs">3 Rejected</span>
								<span class="label bg-success pull-right m-t-xs m-r-xs">10 Accepted</span>
								<span class="label bg-warning pull-right m-t-xs m-r-xs">16 Awaiting Review</span-->
								<span class="h5 font-bold">Quotation List</span>
							</header>
							<form id="quote_filter_form" name="quote_filter_form" method="post" action="">
								<div class="col-lg-5 m-t-sm">
									<div class="m-t-xs m-b-n-sm">
										<div class="checkbox-inline i-checks">
											<label>
												<input id="f_reviewed" class="quote_filter" name="quote_status[]" type="checkbox" value="<?php echo QUOTE_REVIEWED;?>">
												<i></i>
												<span class="text-left"> Reviewed</span>
											</label>
										</div>
										<div class="checkbox-inline i-checks">
											<label>
												<input id="f_waiting" class="quote_filter" name="quote_status[]" type="checkbox" value="<?php echo QUOTE_AWAITING;?>">
												<i></i>
												<span class="text-left"> Awaiting Review</span>
											</label>
										</div>
										<div class="checkbox-inline i-checks">
											<label>
												<input id="f_accepted" class="quote_filter" name="quote_status[]" type="checkbox" value="<?php echo QUOTE_ACCEPTED;?>">
												<i></i>
												<span class="text-left"> Accepted</span>
											</label>
										</div>
										<div class="checkbox-inline i-checks">
											<label>
												<input id="f_rejected" class="quote_filter" name="quote_status[]" type="checkbox" value="<?php echo QUOTE_REJECTED;?>">
												<i></i>
												<span class="text-left"> Rejected</span>
											</label>
										</div>
									</div>
								</div>

								<div class="col-lg-4 m-b-sm m-t-sm">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-sm btn-default active">
											<input class="quote_filter" type="radio" name="period" value="all"> All
										</label>
										<label class="btn btn-sm btn-default">
											<input class="quote_filter" type="radio" name="period" value="today"> Today
										</label>
										<label class="btn btn-sm btn-default">
											<input class="quote_filter" type="radio" name="period" value="week"> Last Week
										</label>
										<label class="btn btn-sm btn-default">
											<input class="quote_filter" type="radio" name="period" value="month"> Last Month
										</label>
									</div>
								</div>
								<div class="col-lg-3 m-b-sm m-t-sm">
									<div class="input-group">
										<input type="search" name="keyword" class="quote_filter input-sm form-control" placeholder="Search">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-default" type="button">Go!</button>
										</span>
									</div>
								</div>
							</form>
							<table class="table table-striped m-b-none">
								<thead>
									<tr>
										<th class="hidden-xs" width="10"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
										<th>Quote ID</th>
										<th class="hidden-xs">Title</th>
										<th class="hidden-xs">Date</th>
										<th class="text-center hidden-xs">Quantity</th>
										<th class="text-center">Unit Price</th>
										<th class="text-center">Total Price</th>
										<!-- <th class="text-center hidden-xs">TAT</th> -->
										<th class="text-center">Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="quoteslist_box">
									<!-- Loading -->
								</tbody>
							</table>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-sm-4 hidden-xs">
										<form id="quote_action" name="quote_action_form" method="post" action="">
											<select name="action" class="input-sm form-control input-s-sm inline v-middle">
												<option value="0">Accept Selected</option>
												<option value="1">Reject Selected</option>
											</select>
											<button type="submit" class="btn btn-sm btn-default">Apply</button>
										</form>
									</div>
									<!--div class="col-sm-4 text-center">
										<small class="text-muted inline m-t-sm m-b-sm">Showing 01-10 of 57 items</small>
									</div>
									<div class="col-sm-4 text-right text-center-xs">                
										<ul class="pagination pagination-sm m-t-none m-b-none">
											<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
										</ul>
									</div-->
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


<script type="text/javascript">
	$(document).ready(function(){
		Portal.PageInit.Quotations();
	});
</script>

<script id="quotations" type="text/html">
	{{#data}}
	<tr>
		<td class="hidden-xs"><label class="checkbox m-n i-checks"><input type="checkbox" name="ids[]"><i></i></label></td>
		<td><a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/popup_quote_details');?>/?quote_id={{quote_id}}">{{key_id}}</a></td>
		<td class="hidden-xs"><div class="title_limit_200px text-ellipsis">{{title}}</div></td>
		<td class="hidden-xs">{{quote_date}}</td>
		<td class="text-center hidden-xs">{{quantity}}</td>
		{{#if reviewed}}
			<td class="text-center">${{unit_price}}</td>
			<td class="text-center">${{total_price}}</td>
			<td class="text-center hidden-xs">{{tat}}H</td>
		{{/if}}
		{{#if waiting}}
			<td class="text-center">${{unit_price}}</td>
			<td class="text-center">${{total_price}}</td>
			<!-- <td class="text-center hidden-xs"><?php echo ('{{tat}} == 0') ? 'FX' : '{{tat}} H' ?></td> -->
		{{/if}}
		{{#if accepted}}
			<td class="text-center">${{unit_price}}</td>
			<td class="text-center">${{total_price}}</td>
			<!-- <td class="text-center hidden-xs">{{tat}}H</td> -->
			<td class="text-center"><span class="label bg-success m-t-xs">Accepted</span></td>
			<td class="text-right">
		    <a href="<?php echo site_url('/place_order_from_quote');?>/{{quote_id}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Submit"><i class="fa fa-mail-forward"></i> Place Order</a>
		    </td>
		{{/if}}
		{{#if rejected}}
			<td class="text-center">${{unit_price}}</td>
			<td class="text-center">${{total_price}}</td>
			<!-- <td class="text-center hidden-xs">{{tat}}H</td> -->
			<td class="text-center"><span class="label bg-danger m-t-xs">Rejected</span></td>
			<td class="text-right">&nbsp;</td>
		{{/if}}
		{{#if reviewed}}
		<td class="text-center"><span class="label bg-warning m-t-xs">Reviewed</span></td>
		<?php if($is_owner || (isset($permission['quote_approve']) && $permission['quote_approve'] ==1)): ?>
			<td class="text-right">
				<a href="javascript:void(0)" onclick="Portal.Quotation.accept('{{quote_id}}', '{{service_id}}');" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="Accept Quote">
					<i class="fa fa-check"></i>
				</a>
				<a href="javascript:void(0)" onclick="Portal.Quotation.reject('{{quote_id}}');" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Reject Quote">
					<i class="i i-cross2"></i>
				</a>
			</td>
		<?php else: ?>
			<td class="text-right">&nbsp;</td>
		<?php endif; ?>
		{{/if}}
		{{#if waiting}}
			<td class="text-center"><span class="label bg-light dker m-t-xs">Review Waiting</span></td>
			<td class="text-right">&nbsp;</td>
		{{/if}}
		
		
	</tr>
	{{/data}}
</script>