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
									<span class="label bg-danger pull-right p-xs">You Owe: $<?php echo $this->notifications->total_due;?></span>
									<span class="label bg-warning pull-right p-xs m-r-xs"><?php echo $this->notifications->count_unpaid_invoices;?> Unpaid</span>
									<span class="label bg-success pull-right p-xs m-r-xs"><?php echo $this->notifications->count_paid_invoices;?> Paid</span>
									<span class="h5 font-bold">Invoice List</span>
								</header>
								<div class="col-lg-5 m-t-sm">
									<div class="m-t-xs m-b-n-sm">
										<div class="checkbox-inline i-checks">
											<label><input id="f_paid" class="invoice_filter" type="checkbox" name="paid" value="1"> <i></i> <span class="text-left"> Paid</span> </label>
										</div>
										<div class="checkbox-inline i-checks">
											<label><input id="f_unpaid" class="invoice_filter" type="checkbox" name="unpaid" value="1"> <i></i> <span class="text-left"> Unpaid</span> </label>
										</div>

									</div>
								</div>
								<div class="col-lg-4 m-b-sm m-t-sm">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-sm btn-default active">
											<input class="invoice_filter" type="radio" name="period" id="period_all" value="all"> All
										</label>
										<label class="btn btn-sm btn-default">
											<input class="invoice_filter" type="radio" name="period" id="period_today" value="today"> Today
										</label>
										<label class="btn btn-sm btn-default">
											<input class="invoice_filter" type="radio" name="period" id="period_week" value="week"> Last Week
										</label>
										<label class="btn btn-sm btn-default">
											<input class="invoice_filter" type="radio" name="period" id="period_month" value="month"> Last Month
										</label>
									</div>
								</div>
								<div class="col-lg-3 m-b-sm m-t-sm">
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
											<th class="hidden-xs">Job Title</th>
											<th class="text-left nowrap">Date</th>
											<th class="text-center hidden-xs nowrap">Image Qty</th>
											<th class="text-center hidden-xs nowrap">Unit Price</th>
											<th class="text-center nowrap">Total Price</th>
											<th class="text-center">Status</th>
											<th class="text-center hidden-xs">PDF</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody id="invoiceslist_box">
										<!-- Invoces here -->
									</tbody>
								</table>
								<footer class="panel-footer">
									<div class="row">
										<!--div class="col-sm-4 hidden-xs">
											<button class="btn btn-sm btn-default">Pay Selected</button>                  
										</div-->
										<div class="col-sm-4 hidden-xs">
											<select name="action" class="input-sm form-control input-s-sm inline v-middle">
												<option value="0">Bulk Action</option>
												<option value="0">Pay Selected</option>
												<option value="1">Pay All Dues</option>
											</select>
											<button type="submit" class="btn btn-sm btn-default">Apply</button>
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

<script type="text/javascript">
	$(document).ready(function(){
		Portal.PageInit.Invoice();
	});
</script>

<script id="tpl_invoices" type="text/html">
	{{#data}}
	<tr>
		<td class="hidden-xs"><label class="checkbox m-n i-checks"><input type="checkbox" {{#if paid}}disabled{{/if}} name="post[]"><i></i></label></td>           
		<td class="nowrap"><a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/popup_invoice?id=');?>{{invoice_id}}">{{key_id}}</a></td>
		<td class="hidden-xs"><div class="title_limit_200px text-ellipsis">{{title}}</div></td>
		<td class="hidden-xs nowrap">{{order_date}}</td>
		<td class="text-center hidden-xs">{{quantity}}</td>
		<td class="text-center hidden-xs">${{unit_price}}</td>
		<td class="text-center hidden-xs">${{total_value}}</td>
		{{#if paid}}
			<td class="text-center"><span class="label bg-success m-t-xs">Paid</span></td>
			<td class="text-center hidden-xs"><a href="<?php echo site_url('invoices');?>/{{invoice_id}}" target="_blank"><i class="i i-file-pdf"></i></a></td>
			<td class="text-right">&nbsp;</td>
		{{else}}
			<td class="text-center"><span class="label bg-warning m-t-xs">Unpaid</span></td>
			<td class="text-center hidden-xs"><a href="<?php echo site_url('invoices');?>/{{invoice_id}}" target="_blank"><i class="i i-file-pdf"></i></a></td>
			<td class="text-right">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">Pay Now <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a onclick="Portal.wait();" href="<?php echo site_url('paypal_payment');?>/{{order_id}}"><img src="<?php echo base_url();?>assets/images/pay-with-pp.png"/ alt="PayPal"></a></li>
						<li><a onclick="Portal.wait();" href="<?php echo site_url('payza_payment');?>/{{order_id}}"><img src="<?php echo base_url();?>assets/images/pay-with-2co.png" alt="2CheckOut"/></a></li>
					</ul>
				</div>
			</td>
		{{/if}}
	</tr>
	{{/data}}
</script>