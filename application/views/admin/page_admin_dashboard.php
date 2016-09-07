<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Dashboard</h3>
						<small>Welcome back <a href="<?php echo site_url('/admin/myprofile/');?>" class="text-info"><?php echo (isset($this->user_profile->fullname)) ? $this->user_profile->fullname : '';?></a>, <i class="fa fa-map-marker fa-lg text-primary"></i> <?php echo country_name($this->user_profile->country);?></small>
					</div>
				</section>
				<div class="row">
					<div class="col-sm-6">
						<div class="panel b-a">
							<div class="row m-n">
								<div class="col-md-6 b-b b-r">
									<a href="#" class="block padder-v hover">
										<span class="i-s i-s-2x pull-left m-r-sm">
											<i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
											<i class="i i-plus2 i-1x text-white"></i>
										</span>
										<span class="clear">
											<span class="h3 block m-t-xs text-danger">2,000</span>
											<small class="text-muted text-u-c">New Visits</small>
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
											<span class="h3 block m-t-xs text-success">75%</span>
											<small class="text-muted text-u-c">Bounce rate</small>
										</span>
									</a>
								</div>
								<div class="col-md-6 b-b b-r">
									<a href="#" class="block padder-v hover">
										<span class="i-s i-s-2x pull-left m-r-sm">
											<i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
											<i class="i i-location i-sm text-white"></i>
										</span>
										<span class="clear">
											<span class="h3 block m-t-xs text-info">25 <span class="text-sm">m</span></span>
											<small class="text-muted text-u-c">location</small>
										</span>
									</a>
								</div>
								<div class="col-md-6 b-b">
									<a href="#" class="block padder-v hover">
										<span class="i-s i-s-2x pull-left m-r-sm">
											<i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
											<i class="i i-alarm i-sm text-white"></i>
										</span>
										<span class="clear">
											<span class="h3 block m-t-xs text-primary">9:30</span>
											<small class="text-muted text-u-c">Meeting</small>
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-primary lt text-center">
								<a href="#">
									<i class="fa fa-facebook fa fa-3x m-t m-b text-white"></i>
								</a>
							</div>
							<div class="padder-v text-center clearfix">                            
								<div class="col-xs-6 b-r">
									<div class="h3 font-bold">42k</div>
									<small class="text-muted">Friends</small>
								</div>
								<div class="col-xs-6">
									<div class="h3 font-bold">90</div>
									<small class="text-muted">Feeds</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-info lter text-center">
								<a href="#">
									<i class="fa fa-twitter fa fa-3x m-t m-b text-white"></i>
								</a>
							</div>
							<div class="padder-v text-center clearfix">                            
								<div class="col-xs-6 b-r">
									<div class="h3 font-bold">27k</div>
									<small class="text-muted">Tweets</small>
								</div>
								<div class="col-xs-6">
									<div class="h3 font-bold">15k</div>
									<small class="text-muted">Followers</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3 hide">
						<section class="panel b-a">
							<header class="panel-heading b-b b-light">
								<ul class="nav nav-pills pull-right">
									<li>
										<a href="ajax.pie.html" class="text-muted" data-bjax="" data-target="#b-c">
											<i class="i i-cycle"></i>
										</a>
									</li>
									<li>
										<a href="#" class="panel-toggle text-muted">
											<i class="i i-plus text-active"></i>
											<i class="i i-minus text"></i>
										</a>
									</li>
								</ul>
								Connection
							</header>
							<div class="panel-body text-center bg-light lter" id="b-c">
								<div class="easypiechart inline m-b m-t easyPieChart" data-percent="60" data-line-width="4" data-bar-color="#23aa8c" data-track-color="#c5d1da" data-color="#2a3844" data-scale-color="false" data-size="120" data-line-cap="butt" data-animate="2000" style="width: 120px; height: 120px; line-height: 120px;">
									<div>
										<span class="h2 m-l-sm step">60</span>%
										<div class="text text-xs">completed</div>
									</div>
									<canvas width="240" height="240" style="width: 120px; height: 120px;"></canvas></div>
								</div>
							</section>                      
						</div>
					</div>           
					<div class="row bg-light dk m-b">
						<div class="col-md-6 dker">
							<section>
								<header class="font-bold padder-v">
									<div class="pull-right">
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-sm btn-rounded btn-default dropdown-toggle">
												<span class="dropdown-label">Week</span> 
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-select">
												<li><a href="#"><input type="radio" name="b">Month</a></li>
												<li><a href="#"><input type="radio" name="b">Week</a></li>
												<li><a href="#"><input type="radio" name="b">Day</a></li>
											</ul>
										</div>
										<a href="#" class="btn btn-default btn-icon btn-rounded btn-sm">Go</a>
									</div>
									Statistics
								</header>
								<div class="panel-body">
									<div id="flot-sp1ine" style="height: 210px; padding: 0px; position: relative;"><canvas class="flot-base" width="1070" height="420" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 535px; height: 210px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 11px; text-align: center;">0.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 90px; text-align: center;">2.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 169px; text-align: center;">5.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 248px; text-align: center;">7.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 324px; text-align: center;">10.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 403px; text-align: center;">12.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 66px; top: 193px; left: 482px; text-align: center;">15.0</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 180px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 150px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 120px; left: 1px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 90px; left: 1px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 60px; left: 1px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 30px; left: 1px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">60</div></div></div><canvas class="flot-overlay" width="1070" height="420" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 535px; height: 210px;"></canvas></div>
								</div>
								<div class="row text-center no-gutter">
									<div class="col-xs-3">
										<span class="h4 font-bold m-t block">5,860</span>
										<small class="text-muted m-b block">Orders</small>
									</div>
									<div class="col-xs-3">
										<span class="h4 font-bold m-t block">10,450</span>
										<small class="text-muted m-b block">Sellings</small>
									</div>
									<div class="col-xs-3">
										<span class="h4 font-bold m-t block">21,230</span>
										<small class="text-muted m-b block">Items</small>
									</div>
									<div class="col-xs-3">
										<span class="h4 font-bold m-t block">7,230</span>
										<small class="text-muted m-b block">Customers</small>                        
									</div>
								</div>
							</section>
						</div>
						<div class="col-md-6">
							<section>
								<header class="font-bold padder-v">
									<div class="btn-group pull-right">
										<button data-toggle="dropdown" class="btn btn-sm btn-rounded btn-default dropdown-toggle">
											<span class="dropdown-label">Last 24 Hours</span> 
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-select">
											<li><a href="#"><input type="radio" name="a">Today</a></li>
											<li><a href="#"><input type="radio" name="a">Yesterday</a></li>
											<li><a href="#"><input type="radio" name="a">Last 24 Hours</a></li>
											<li><a href="#"><input type="radio" name="a">Last 7 Days</a></li>
											<li><a href="#"><input type="radio" name="a">Last 30 days</a></li>
											<li><a href="#"><input type="radio" name="a">Last Month</a></li>
											<li><a href="#"><input type="radio" name="a">All Time</a></li>
										</ul>
									</div>
									Analysis
								</header>
								<div class="panel-body flot-legend">
									<div id="flot-pie-donut" style="height: 240px; padding: 0px; position: relative;"><canvas class="flot-base" width="1070" height="480" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 535px; height: 240px;"></canvas><canvas class="flot-overlay" width="1070" height="480" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 535px; height: 240px;"></canvas><div class="legend"><div style="position: absolute; width: 101px; height: 110px; top: 5px; right: 5px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:5px;right:5px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(101,181,194);overflow:hidden"></div></div></td><td class="legendLabel">iPhone5S</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(77,167,193);overflow:hidden"></div></div></td><td class="legendLabel">iPad Mini</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(57,147,187);overflow:hidden"></div></div></td><td class="legendLabel">iPad Mini Retina</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(46,123,173);overflow:hidden"></div></div></td><td class="legendLabel">iPhone4S</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(35,100,158);overflow:hidden"></div></div></td><td class="legendLabel">iPad Air</td></tr></tbody></table></div><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 70px; left: 296.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(101,181,194);">iPhone5S<br>40%</div></span><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 206px; left: 227px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(77,167,193);">iPad Mini<br>10%</div></span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 191px; left: 114.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(57,147,187);">iPad Mini Retina<br>20%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 96px; left: 85.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(46,123,173);">iPhone4S<br>12%</div></span><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 12px; left: 139.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(35,100,158);">iPad Air<br>18%</div></span></div>
								</div>
							</section></div>
						</div>

					</section>
				</section>
			</section>
			
			<!-- / side content -->
		</section>