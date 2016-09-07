<div class="modal-dialog">
  <div class="modal-content">
	  <form action="" method="post" role="form">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title text-success">User Profile</h4>
	    </div>
	    
	    <div class="modal-body">
	        <div class="panel-body" id="profile-edit-page">
      			<div class="profile-box inline text-center">
                    <div class="thumb-lg pos-rlt list-group">
                    	<!-- <span class="p_img_box">
                    		<i class="fa fa-camera text-white backdrop"></i>
                    	</span> -->
                      	<img src="<?php echo base_url();?>assets/images/atik-rahman.jpg" class="">
                	</div>
              	</div>
              	<div class="p-description">
              		<div class="b-inline">
              			<h4 class="h4 m-b-xs"><strong>Atik Rahman</strong></h4>
              			<small class="text-muted m-b">Web Developer at <span class="t-bold">Adept Graphics</span></small>
              		</div>
              		<div class="b-inline">
                  		<small class="text-muted m-b"><span><i class="fa fa-envelope-o"></i></span>hironraj@gmail.com</small>
                  		<small class="text-muted m-b"><span><i class="i i-phone"></i></span>+8801717463645</small>
              		</div>                        		
              	</div>
            </div>
			<section class="panel panel-default">
				<header class="panel-heading text-right bg-light ar-bg-gray">
					<ul class="nav nav-tabs pull-right">
					    <li class="active"><a href="#p-details" data-toggle="tab">Details</a></li>
					    <li><a href="#p-email-setting" data-toggle="tab">Email Setting</a></li>
					    <li><a href="#p-signature" data-toggle="tab">Signature</a></li>
					    
					</ul>
				</header>
				<div class="panel-body">
				  	<div class="tab-content">              
					    <div class="tab-pane fade active in form-horizontal" id="p-details">
	                        <div class="form-group">
	                          	<div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="Full Name">
		                        </div>
		                        <div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="Position">
		                        </div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-12">
	                          		<input type="text" class="form-control" placeholder="Company Name">
	                          	</div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-6">
	                          		<input type="email" class="form-control" placeholder="Enter email">
	                          	</div>
	                          	<div class="col-lg-6">
	                          		<input type="number" class="form-control" placeholder="Phone">
	                          	</div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="Website">
	                          	</div>
	                          	<div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="Vat Id">
	                          	</div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-12">
	                          		<input type="text" class="form-control" placeholder="Address 1">
	                          	</div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-12">
	                          		<input type="text" class="form-control" placeholder="Address 2">
	                          	</div>
	                        </div>
	                        <div class="form-group">
	                          	<div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="Postal Code">
	                          	</div>
	                          	<div class="col-lg-6">
	                          		<input type="text" class="form-control" placeholder="City">
	                          	</div>
	                        </div>
	                        <div class="form-group">
								<div class="col-lg-12">
									<select id="select_country_add" class="form-control">
										<option value="">Country</option>
									</select>	
								</div>							
							</div>
					    </div>
					    <div class="tab-pane fade in" id="p-email-setting">
					    	<P><strong>Email Notification:</strong> You will receive the every notificaiton via email as checked below. Please un-check if you do not wish to receive notification via email. You will still be able to see all the notifications on your dashboard.</P>
					    	<div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                            Order Submit - Customer 
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                            Quote Submit - Customer 
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                             Quotation Reviewed
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                             Quote Accept - Customer 
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                            Order Received 
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" disabled="" value="">
		                            <i></i>
		                            Order Ready 
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" disabled="" value="">
		                            <i></i>
		                             Billing & Payment  
	                          	</label>
	                        </div>
	                        <div class="checkbox i-checks">
	                          	<label>
		                            <input type="checkbox" checked="" value="">
		                            <i></i>
		                           	New Massage 
	                          	</label>
	                        </div>
					    </div>
					    <div class="tab-pane fade in" id="p-signature">
					    	

					    </div>
					   
				  	</div>
				</div>
			</section>
	    </div>
	    <div class="modal-footer">
	      	<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" />
	    	<button class="btn btn-success" data-toggle="class:show inline" data-target="#spin" data-loading-text="Saving...">Save</button>
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->