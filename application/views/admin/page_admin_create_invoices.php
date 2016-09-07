
<section class="hbox stretch">     
	<section class="vbox" id="dashboard-custom-style">         
		<section class="scrollable padder">             
			<div>
				<section class="row m-b-md">                     
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Create Invoices</h3>
						<small>New Create Invoices</small>                         <!-- <pre><?php
						print_r($orders); ?><pre/> -->                     
					</div>
					<div class="col-sm-6">                         
						<ul class="breadcrumb pull-right-lg" style="background: transparent; border: 0;">
							<li><a href="<?php echo site_url('/admin/');?>"> <i class="fa fa-home"></i> Home</a></li>                             
							<li class="active">create invoices</li>                         
						</ul>                     
					</div>
				</section>                 
				<div id="admin_invoices" class="vbox " style="max-width: 850px; width: 100%; overflow: hidden;">
					<form action="" method="" >                         
						<div class="scrollable wrapper bg-white" >                             
							<div class="row">
								<div class="col-xs-8">                                     
									<img src="<?php echo base_url();?>assets/images/logo-print.png">
								</div>                                 
								<div class="col-xs-4 text-right">
									<div class="form-group m-t">                                         
										<input type="text" name="i_company" class="form-control" placeholder="Order ID" value="">                                      
									</div>
									<div class="form-group m-t">                                         
										<input type="text" name="i_company" class="form-control" placeholder="Date" value="">
									</div>                                 
								</div>
							</div>                                       
							<div class="well m-t">
								<div class="row">                                     
									<div class="col-xs-6">
										<strong>INVOICE TO:</strong>                                         
										<div class="form-group m-t">                                             
											<input type="text" name="i_company" class="form-control" placeholder="Company Name" value="">                                          </div>
										<div class="form-group">                                             
											<input type="text" name="i_address" class="form-control" placeholder="Address" value="">                                          
										</div>
										<div class="form-group">                                             
											<input type="text" name="i_country" class="form-control" placeholder="Country" value="">                                         
										</div>
										<div class="form-group">                                             
											<input type="number" name="i_phone" class="form-control" placeholder="Phone Number" value="">                                         </div>
										<div class="form-group">                                             
										<input type="email" name="i_email" class="form-control" placeholder="Email Address" value="">                                         </div>
									</div>                                     
									<div class="col-xs-6">
										<strong>PAY TO:</strong>                                         
										<div class="form-group m-t">                                             
											<input type="text" name="p_company" class="form-control" placeholder="Company Name" value="">                                          </div>
										<div class="form-group">                                             
											<input type="text" name="p_address" class="form-control" placeholder="Address" value="">                                          
										</div>
										<div class="form-group">                                             
											<input type="text" name="p_country" class="form-control" placeholder="Country" value="">                                         
										</div>
										<div class="form-group">                                             
											<input type="number" name="p_phone" class="form-control" placeholder="Phone Number" value="">                                         </div>
										<div class="form-group">                                             
										<input type="email" name="p_email" class="form-control" placeholder="Email Address" value="">                                         </div>
									</div>                                 
								</div>
							</div>
							
							<div class="line"></div>
							<table class="table">
								<thead>
									<tr>
										<th width="40">#</th>
										<th>DESCRIPTION</th>
										<th>UNIT PRICE</th>
										<th>QTY</th>
										<th>TOTAL</th>
										<th width="30"></th>
									</tr>
								</thead>
								<tbody class="input_fields_wrap">
									<tr>
										<td>1</td> 
										<td>
											<div class="form-group">
												<textarea class="form-control" rows="2" placeholder="Type your message"></textarea>
											</div>
										</td>
										<td>
											<div class="form-group">
											    <input type="number" class="form-control" name="unit_price" placeholder="Unit Pice" value="">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="number" class="form-control" name="img_qty_1" placeholder="Image Qty" value="">
											</div>
										</td>
										<td>	
											<div class="form-group">
												<input type="number" class="form-control" name="total_price_1" placeholder="Tolal Price" value="">
											</div>
										</td>
										<td width="30"></td>
									</tr>
								</tbody>
							</table>
							<div class="addbtn">
								<input class="add_field_button btn btn-default" value="+" type="button">
							</div> 
							           
						</div>
						<div class="form-group m-t-md ">
							<input type="submit" name="submit" class="btn btn-info input-s-lg pull-right m-b-md" value="Submit">
						</div>
					</form>
				</div>
        	</div>
		</section>
	</section>
</section>
<script type="text/javascript">
	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var add_button      = $(".add_field_button"); //Add button ID
	    
	    
	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<tr><td>'+x+'</td><td><div class="form-group"><textarea class="form-control" rows="2" placeholder="Type your message"></textarea></div></td><td><div class="form-group"><input type="number" class="form-control" name="unit_price" placeholder="Unit Pice" value=""></div></td><td><div class="form-group"><input type="number" class="form-control" name="img_qty_1" placeholder="Image Qty" value=""></div></td><td><div class="form-group comment-list"><input type="number" class="form-control" name="total_price_1" placeholder="Tolal Price" value=""></div></td><td width="30"><a href="#" class="remove_field" ><i class="i i-cross2"></i></a></td></tr>'); //add input box
	        }
	    });  
	   
	    
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parents('tr').remove(); x--;
	    })
	});
</script>