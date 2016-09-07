<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">
				<section class="panel panel-default" >
                    <div class="panel-body" id="profile-custom-style">
                      	<div class="clearfix text-center" >
	                        <div class="inline">
                      			<div class="profile-box">
		                            <div class="thumb-lg">
		                              <img src="<?php echo base_url();?>assets/images/atik-rahman.jpg" class="">
	                            	</div>
	                          	</div>
	                          	<div class="p-description">
	                          		<div class="b-inline">
	                          			<h4 class="h4 m-b-xs"><strong><?php echo (!empty($user_profile->fullname)) ? $user_profile->fullname : ''; ?></strong></h4>
	                          			<small class="text-muted m-b">Web Developer at <span class="t-bold"><?php echo (!empty($user_profile->company)) ? $user_profile->company : ''; ?></span></small>
	                          		</div>
	                          		<div class="b-inline">
		                          		<small class="text-muted m-b"><span><i class="fa fa-envelope-o"></i></span><?php echo (!empty($user_profile->email)) ? $user_profile->email : ''; ?></small>
		                          		<small class="text-muted m-b"><span><i class="i i-phone"></i></span><?php echo (!empty($user_profile->phone)) ? $user_profile->phone : ''; ?></small>
	                          		</div>                        		
	                          	</div>
	                        </div>
	                        <div class="message-box">
	                        	<!-- <a href="<?php echo site_url('/admin/update_user_details_by_id/'); ?>/<?php echo $user_profile->user_id; ?>" class="btn btn-s-md btn-info inline"><i class="fa fa-edit"></i> Edit Profile</a> -->
	                        	<a data-toggle="ajaxModal" href="<?php echo site_url('/admin/edit_client_profile/'); ?>/<?php echo $user_profile->user_id; ?>" class="btn btn-s-md btn-info inline"><i class="fa fa-edit"></i> Edit Profile</a>
	                        	<a href="#" class="btn btn-s-md btn-info inline m-l-sm"><i class="fa fa-envelope"></i> Send Message</a>
	                        </div>                      
                      	</div>
                    </div>
                    <div class="row" id="profile-custom-style2">
                    	<div class="col-sm-4 m-r-n">
	                        <div class="row m-n">
	                        	<header class="panel-heading b-r b-b"><strong>Quick summary</strong></header>
	                        	<section class="p-l-sm p-r-sm p-t-sm b-r">
				                    <div class="bg-light dk wrapper">
				                      	<div class="text-center m-b-n m-t-sm">
				                          	<div class="sparkline" data-type="line" data-height="65" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" values="280,320,220,385,450,320,345,250,250,250,400,380"></div>
				                          	<div class="sparkline inline" data-type="bar" data-height="45" data-bar-width="6" data-bar-spacing="6" data-bar-color="#1ccc88">10,9,11,10,11,10,12,10,9,10,11,9,8</div>
				                      	</div>
				                    </div>
				                    <div class="panel-body b-a m-b-sm">
				                      	<div class="row">
					                        <div class="col-xs-4">
					                          	<small class="text-muted block">Day</small>
					                          	<span>$150.00</span>
					                          	<small class="text-muted block">Order <span class="badge bg-primary">3</span></small>
					                        </div>
					                        <div class="col-xs-4">
					                          	<small class="text-muted block">week</small>
					                          	<span>$900.00</span>
					                          	<small class="text-muted block">Order <span class="badge bg-primary">19</span></small>
					                        </div>
					                        <div class="col-xs-4">
					                          	<small class="text-muted block">Month</small>
					                          	<span>$2700.00</span>
					                          	<small class="text-muted block">Order <span class="badge bg-primary">65</span></small>
					                        </div>
				                      	</div>
				                    </div>
				                
					                <div class="b-l b-r b-t inline ar-block">
					                	<div class="col-md-6 b-b b-r">
				                            <a href="#" class="block padder-v hover">
				                            	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
					                                <i class="i i-alarm i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-primary">9:30</span>
					                                <small class="text-muted text-u-c">Local Time</small>
				                              	</span>
				                              	
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
					                                <i class="i i-location i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-info">25 <span class="text-sm">m</span></span>
					                                <small class="text-muted text-u-c">location mark</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b b-r">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
					                                <i class="i i-stack i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-info">122</span>
					                                <small class="text-muted text-u-c">All orders</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
					                                <i class="fa fa-ellipsis-h i-1x text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-danger">3</span>
					                                <small class="text-muted text-u-c">Pending Orders</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b b-r">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
					                                <i class="i i-docs i-1x text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-primary">27</span>
					                                <small class="text-muted text-u-c">All Quotes</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
					                                <i class="i i-checkmark i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-success">9</span>
					                                <small class="text-muted text-u-c">Accepted Quote</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b b-r">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
					                                <i class="fa fa-dollar i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-info">1825$</span>
					                                <small class="text-muted text-u-c">Total spent</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
					                                <i class="fa fa-dollar i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-primary">1780$</span>
					                                <small class="text-muted text-u-c">Total Paid</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b b-r">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
					                                <i class="fa fa-dollar i-1x text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-danger">50$</span>
					                                <small class="text-muted text-u-c">Total Due</small>
				                              	</span>
				                            </a>
			                          	</div>
			                          	<div class="col-md-6 b-b">
				                            <a href="#" class="block padder-v hover">
				                              	<span class="i-s i-s-2x pull-left m-r-sm">
					                                <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
					                                <i class="i i-users2 i-sm text-white"></i>
				                              	</span>
				                              	<span class="clear">
					                                <span class="h4 block m-t-xs text-success">31</span>
					                                <small class="text-muted text-u-c">Total Managers</small>
				                              	</span>
				                            </a>
			                          	</div>
					                </div>
				                </section>
	                        </div>
                    	</div>
                    	<div class="col-sm-8 no-padder">
                    		<section>
			                    <header class="panel-heading bg-light b-b">
			                    	<ul class="nav nav-tabs nav-justified">
				                        <li class="active"><a href="#activities" data-toggle="tab">Activities</a></li>
				                        <li class=""><a href="#orders" data-toggle="tab">Orders</a></li>
				                        <li class=""><a href="#quote" data-toggle="tab">Quotes</a></li>
				                        <li class=""><a href="#invoices" data-toggle="tab">Invoices</a></li>
				                        <li class=""><a href="#managers" data-toggle="tab">Managers</a></li>
			                    	</ul>
			                    </header>
			                    <div class="panel-body p-sm">
			                    	<div class="tab-content">
				                        <div class="tab-pane active" id="activities">
				                        	 <!-- .comment-list -->
							                <section class="comment-list block">
							                    <article id="comment-id-1" class="comment-item">
							                      	<a class="pull-left thumb-sm avatar">
								                        <img src="<?php echo base_url(); ?>assets/images/circle-image.png" class="img-circle">
							                      	</a>
							                      	<span class="arrow left"></span>
								                    <section class="comment-body panel panel-default">
								                        <header class="panel-heading bg-white">
									                        <a href="#">John smith</a>
									                        <label class="label bg-info m-l-xs">Editor</label> 
									                        <span class="text-muted m-l-sm pull-right">
									                            <i class="fa fa-clock-o"></i>
									                            Just now
									                        </span>
								                        </header>
								                    </section>
							                    </article>
							                    
							                    <!-- / .comment-reply -->
							                    <article id="comment-id-3" class="comment-item">
							                      	<a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/circle-image.png"></a>
								                    <span class="arrow left"></span>
								                    <section class="comment-body panel panel-default">
								                        <header class="panel-heading">                      
								                          <a href="#">By me</a>
								                          <label class="label bg-success m-l-xs">User</label> 
								                          <span class="text-muted m-l-sm pull-right">
								                            <i class="fa fa-clock-o"></i>
								                            1h ago
								                          </span>
								                        </header>
								                        <div class="panel-body">
								                          <div>This comment was posted by you.</div>
								                          <div class="comment-action m-t-sm">
								                            <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
								                              <i class="fa fa-trash-o text-muted"></i> 
								                              Remove
								                            </a>
								                          </div>
								                        </div>
								                    </section>
							                    </article>
							                    <article id="comment-id-1" class="comment-item">
							                      <a class="pull-left thumb-sm avatar">
							                        <img src="<?php echo base_url(); ?>assets/images/circle-image.png" class="img-circle">
							                      </a>
							                      <span class="arrow left"></span>
							                      <section class="comment-body panel panel-default">
							                        <header class="panel-heading bg-white">
							                          <a href="#">John smith</a>
							                          <label class="label bg-info m-l-xs">Editor</label> 
							                          <span class="text-muted m-l-sm pull-right">
							                            <i class="fa fa-clock-o"></i>
							                            Just now
							                          </span>
							                        </header>
							                      </section>
							                    </article>
							                    <article id="comment-id-1" class="comment-item">
								                    <a class="pull-left thumb-sm avatar">
								                        <img src="<?php echo base_url(); ?>assets/images/circle-image.png" class="img-circle">
								                    </a>
							                      	<span class="arrow left"></span>
								                    <section class="comment-body panel panel-default">
								                        <header class="panel-heading bg-white">
									                        <a href="#">John smith</a>
									                        <label class="label bg-info m-l-xs">Editor</label> 
									                          	<span class="text-muted m-l-sm pull-right">
									                            	<i class="fa fa-clock-o"></i>
									                            	Just now
									                          	</span>
								                        </header>
								                    </section>
							                    </article>
							                    <!-- / .comment-reply -->
							                    <article id="comment-id-3" class="comment-item">
							                      	<a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/circle-image.png"></a>
							                      	<span class="arrow left"></span>
							                      	<section class="comment-body panel panel-default">
							                        <header class="panel-heading">                      
							                          <a href="#">By me</a>
							                          <label class="label bg-success m-l-xs">User</label> 
							                          <span class="text-muted m-l-sm pull-right">
							                            <i class="fa fa-clock-o"></i>
							                            1h ago
							                          </span>
							                        </header>
							                        <div class="panel-body">
							                          <div>This comment was posted by you.</div>
							                          <div class="comment-action m-t-sm">
							                            <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
							                              <i class="fa fa-trash-o text-muted"></i> 
							                              Remove
							                            </a>
							                          </div>
							                        </div>
							                      	</section>
							                    </article>
							                    <!-- / .comment-reply -->
							                    <article id="comment-id-3" class="comment-item">
							                      	<a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/circle-image.png"></a>
							                      	<span class="arrow left"></span>
								                    <section class="comment-body panel panel-default">
								                        <header class="panel-heading">                      
								                          	<a href="#">By me</a>
								                          	<label class="label bg-success m-l-xs">User</label> 
								                          	<span class="text-muted m-l-sm pull-right">
								                            	<i class="fa fa-clock-o"></i>
								                            	1h ago
								                          	</span>
								                        </header>
								                        <div class="panel-body">
								                          	<div>This comment was posted by you.</div>
									                        <div class="comment-action m-t-sm">
									                            <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
									                              <i class="fa fa-trash-o text-muted"></i> 
									                              Remove
									                            </a>
									                        </div>
								                        </div>
								                    </section>
							                    </article>
							                   
							                    <!-- comment form -->
							                    <article class="comment-item media" id="comment-form">
							                      	<a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/circle-image.png"></a>
								                    <section class="media-body">
								                        <form action="" class="m-b-none">
									                        <div class="input-group">
									                            <input type="text" class="form-control" placeholder="Input your comment here">
									                            <span class="input-group-btn">
									                              <button class="btn btn-primary" type="button">POST</button>
									                            </span>
									                        </div>
								                        </form>
								                    </section>
							                    </article>
							                </section>
				                        </div>
				                        <div class="tab-pane" id="orders">
				                        	<section class="panel panel-default">
						                    	<header class="panel-heading">Orders</header>
							                    <table class="table table-striped m-b-none">
							                      	<thead>
								                        <tr>
									                        <th>Order Id</th>
									                        <th>Name</th>
									                        <th>Order status</th>
									                        <th>Total Order</th>
								                        </tr>
								                    </thead>
							                      <tbody>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>

							                      </tbody>
							                    </table>
						                  	</section>
				                        </div>
				                        <div class="tab-pane" id="quote">
				                        	<section class="panel panel-default">
						                    	<header class="panel-heading">Quotes</header>
							                    <table class="table table-striped m-b-none">
							                      	<thead>
								                        <tr>
									                        <th>Quotes Id</th>
									                        <th>Name</th>
									                        <th>Quotes status</th>
									                        <th>Total Quotes</th>
								                        </tr>
								                    </thead>
							                      <tbody>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        
							                      </tbody>
							                    </table>
						                  	</section>
				                        </div>
				                        <div class="tab-pane" id="invoices">
				                        	<section class="panel panel-default">
						                    	<header class="panel-heading">Invoices</header>
							                    <table class="table table-striped m-b-none">
							                      	<thead>
								                        <tr>
									                        <th>Invoices Id</th>
									                        <th>Name</th>
									                        <th>Invoices status</th>
									                        <th>Total Invoices</th>
								                        </tr>
								                    </thead>
							                      <tbody>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        <tr>                    
								                        <td>COI-0000-1111</td>
								                        <td>Atik Rahman</td>
								                        <td>Complete</td>
								                        <td>125</td>
							                        </tr>
							                        
							                      </tbody>
							                    </table>
						                  	</section>
				                        </div>
				                        <div class="tab-pane" id="managers">
				                        	<div class="manager-box">
				                        		<ul>
				                        			<li>
				                        				<div class="manager-thumbnail-box">
				                        					<a href="#">
					                        					<div class="m-add-new">
					                        						<i class="i i-plus2"></i>
					                        						<span>Add New</span>
					                        					</div>
				                        					</a>
				                        				</div>
				                        			</li>
				                        			<li>
				                        				<div class="manager-thumbnail-box">
				                        					<div class="thumb-img"><img src="<?php echo base_url(); ?>assets/images/atik-rahman.jpg"></div>
				                        					<div class="thumbnail-content">
				                        						<span>Atik Rahman</span>
					                        					<span><small>Pending</small></span>
					                        					<span><small>25.10.2015</small></span>
				                        					</div>
				                        					<div class="m-dropwon">
				                        						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
				                        						<ul class="dropdown-menu animated fadeInLeft">
												                    <li><span class="arrow top hidden-nav-xs"></span><a href="#">Action</a></li>
												                    <li><a href="#">Another action</a></li>
												                    <li><a href="#">Something else here</a></li>
												                </ul>
				                        					</div>
				                        				</div>
				                        			</li>
				                        			<li>
				                        				<div class="manager-thumbnail-box">
				                        					<div class="thumb-img"><img src="<?php echo base_url(); ?>assets/images/atik-rahman.jpg"></div>
				                        					<div class="thumbnail-content">
				                        						<span>Atik Rahman</span>
					                        					<span><small>Pending</small></span>
					                        					<span><small>25.10.2015</small></span>
				                        					</div>
				                        					<div class="m-dropwon">
				                        						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
				                        						<ul class="dropdown-menu animated fadeInLeft">
												                    <li><span class="arrow top hidden-nav-xs"></span><a href="#">Action</a></li>
												                    <li><a href="#">Another action</a></li>
												                    <li><a href="#">Something else here</a></li>
												                </ul>
				                        					</div>
				                        				</div>
				                        			</li>
				                        			<li>
				                        				<div class="manager-thumbnail-box">
				                        					<div class="thumb-img"><img src="<?php echo base_url(); ?>assets/images/atik-rahman.jpg"></div>
				                        					<div class="thumbnail-content">
				                        						<span>Atik Rahman</span>
					                        					<span><small>Pending</small></span>
					                        					<span><small>25.10.2015</small></span>
				                        					</div>
				                        					<div class="m-dropwon">
				                        						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
				                        						<ul class="dropdown-menu animated fadeInLeft">
												                    <li><span class="arrow top hidden-nav-xs"></span><a href="#">Action</a></li>
												                    <li><a href="#">Another action</a></li>
												                    <li><a href="#">Something else here</a></li>
												                </ul>
				                        					</div>
				                        				</div>
				                        			</li>
				                        			
				                        		</ul>
				                        	</div>
				                        </div>
			                    	</div>
			                    </div>
			                </section>
                    	</div>
                    </div>
                    
                </section>
			</section>
		</section>
	</section>
</section>