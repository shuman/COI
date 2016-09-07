<div class="modal-dialog">
  	<div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title"><?php echo lang('invoice');?></h4>
	    </div>
	    <div class="modal-body">
			<div id="invoice" class="vbox bg-white">
				<div class="scrollable wrapper">
					<div class="row">
						<div class="col-xs-6">
							<img src="<?php echo base_url();?>assets/images/logo-print.png">
						</div>
						<div class="col-xs-6 text-right">
							<p class="h4"><input type="text" name="order_id" value="#000103-48"></p>
							<h5><input type="text" name="date" value="06th September, 2015"></h5>           
						</div>
					</div>          
					<div class="well m-t">
						<div class="row">                                     
							<div class="col-xs-6">
								<strong>INVOICE TO:</strong>                                         
								<div class="form-group m-t">                                             
									<input type="text" name="i_company" class="form-control" placeholder="Company Name" value="">  
								</div>
								<div class="form-group">                                             
									<input type="text" name="i_address" class="form-control" placeholder="Address" value="">                                          
								</div>
								<div class="form-group">                                             
									<input type="text" name="i_country" class="form-control" placeholder="Country" value="">                                         
								</div>
								<div class="form-group">                                             
									<input type="number" name="i_phone" class="form-control" placeholder="Phone Number" value="">                                         
								</div>
								<div class="form-group">                                             
									<input type="email" name="i_email" class="form-control" placeholder="Email Address" value="">                                         
								</div>
							</div>                                     
							<div class="col-xs-6">
								<strong>PAY TO:</strong>                                         
								<div class="form-group m-t">                                             
									<input type="text" name="p_company" class="form-control" placeholder="Company Name" value="">                                          
								</div>
								<div class="form-group">                                             
									<input type="text" name="p_address" class="form-control" placeholder="Address" value="">                                          
								</div>
								<div class="form-group">                                             
									<input type="text" name="p_country" class="form-control" placeholder="Country" value="">                                         
								</div>
								<div class="form-group">                                             
									<input type="number" name="p_phone" class="form-control" placeholder="Phone Number" value="">                                         
								</div>
								<div class="form-group">                                             
									<input type="email" name="p_email" class="form-control" placeholder="Email Address" value="">                                         
								</div>
							</div>                                 
						</div>
					</div>
					<p class="m-t m-b">Order Date: <strong>08th November, 2015</strong><br>
						Order ID: <strong>#000109-48</strong><br>
						Order Status: Complete
					</p>
					<div class="line"></div>
					<table class="table">
						<thead>
							<tr>
								<th width="40">#</th>
								<th>DESCRIPTION</th>
								<th width="140">UNIT PRICE</th>
								<th width="60">QTY</th>
								<th width="90">TOTAL</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>
									
								</td>
								<td>
									<input type="number" class="input-s-sm form-control" name="unit_price" value="2">
								</td>
								<td>
									<input type="number" class="input-s-sm form-control" name="unit_price" value="7">
								</td>
								<td>
									<input type="number" class="input-s-sm form-control" name="total_price" value="120">
								</td>
							</tr>
							
						</tbody>
					</table>   
					<div class="form-group m-t-md ">
						<input type="submit" name="submit" class="btn btn-info input-s-lg pull-right m-b-md" value="Submit">
					</div>           
				</div>
			</div>
		</div>
	</div>
</div>