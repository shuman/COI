
<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Contact Us</h3>
						<small>We are excited to assist you gladly for any help you need!</small>
						</div>
				</section>
				<div class="row">
					<div class="col-sm-6">
						<form name="contact_form" id="contact_form" action="" method="post" data-validate="parsley">
							<input type="hidden" name="nonce" value="<?php echo create_nonce('contact_form');?>">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h4">Contact Form</span>
								</header>
								<div class="panel-body">
									<?php if(isset($sent)) : ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<i class="fa fa-ok-sign"></i> <?php echo lang('contact_thank_msg');?>
									</div>
									<?php endif; ?>

									<p class="text-muted">Please fill in the fields below, we will contact you via email.</p>                        
									<div class="form-group pull-in clearfix">
										<div class="col-sm-6">
											<label>Your name</label>
											<input type="text" class="form-control" name="fullname" data-required="true" required>
										</div>
										<div class="col-sm-6">
											<label>Email</label>
											<input type="email" class="form-control" name="email" data-required="true" required>
										</div>
									</div>
									<div class="form-group">
										<label>Subject</label>
										<input type="text" class="form-control" name="subject" data-required="true" required>
									</div>
									<div class="form-group">
										<label>Message</label>
										<textarea class="form-control" name="message" rows="6" data-minwords="6" data-required="true" required></textarea>
									</div>
								</div>
								<footer class="panel-footer text-right bg-light lter">
									<button type="submit" class="btn btn-success btn-s-xs">SEND</button>
								</footer>
							</section>
						</form>
					</div>
					<div class="col-sm-6">
						<form data-validate="parsley">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h4">Contact Address:</span>
								</header>
								<div class="panel-body">
									<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
									<div id="gmap_canvas" style="height:300px;width:100%;"></div>
									<style>#gmap_canvas img{max-width:none!important;background:none!important}#maps{width:100%;font-size:10px;font-family:arial;text-align:right;}</style>
									<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
									<script type="text/javascript">jQuery(document).ready(function(){jQuery('.gmap').hide();jQuery("#maps span").click(function() {var $this = $(this);$this.next("div").fadeToggle();$('.gmap').not($this.next("div")).fadeOut();});});</script>
									<div id="maps"><span>Google Maps © 2014</span></div>
									<script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(23.88311, 90.38921),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(23.881941,90.390716)});infowindow = new google.maps.InfoWindow({content:"<b><strong>Cut Out Image</strong></b>Plot # 05, Suite # A5, Road # 06<br>Sector # 10, Uttara Model Town<br/>Dhaka-1230, Bangladesh" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

								</div>
								<footer class="panel-footer text-right bg-light lter">
									<h4 class="text-info"><strong>Cut Out Image</strong></h4>
									<p>Plot # 05, Suite # A5, Road # 06<br>Sector # 10, Uttara Model Town<br>Dhaka-1230, Bangladesh<br>Phone: +880 1977 288.688<br>Email: <a href="mailto:hello@cutoutimage.com">hello@cutoutimage.com</a></p>
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