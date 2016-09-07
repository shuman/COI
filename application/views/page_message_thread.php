<section class="hbox stretch">
	<aside class="aside-md bg-light dker b-r hide" id="subNav">
		<div class="wrapper b-b header">&nbsp;</div>
		<ul class="nav">
			<li class="b-b "><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Inbox</a></li>
			<li class="b-b "><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Archive</a></li>
		</ul>
	</aside>
	<aside>
		<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">
						<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						<div class="btn-group">
							<button type="button" onclick="window.location.reload();" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
						</div>
						<a href="<?php echo site_url('/message/compose');?>" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Compose New</a>
					</div>
					<div class="col-sm-4 m-b-xs">
						<form name="message_search" action="" method="get">
							<div class="input-group">
								<input type="text" class="input-sm form-control" name="search" placeholder="Search" value="<?php echo $this->input->get('search');?>">
								<span class="input-group-btn">
									<button class="btn btn-sm btn-default" type="submit">Go!</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</header>
			<section class="scrollable wrapper w-f">
				<section class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped m-b-none">
							<thead>
								<tr>
									<th width="50">&nbsp;</th>
									<th width="250">Subject</th>
									<th>Messages</th>
									<th width="200">Date</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                if($messages){
                                    foreach ($messages as $message) {
                                        ?>
										<tr>
											<td><img class="thumb-xs avatar" src="<?php echo get_avatar($message->last_sender_id);?>"></td>
											<td><a href="<?php echo site_url('/message/thread'). '/' . $message->msg_hashid;?>"><?php echo word_limiter($message->msg_subject, 6);?></a></td>
											<td ><a href="<?php echo site_url('/message/thread'). '/' . $message->msg_hashid;?>"><?php echo word_limiter(strip_tags($message->msg_content), 25);?></a></td>
											<td><i class="fa fa-clock-o"></i> <span class="timeago" title="<?php echo $message->msg_time;?>"><?php echo date("F d, Y", strtotime($message->last_update));?></span></td>
										</tr>
										<?php
                                    }
                                }
                                ?>
							</tbody>
						</table>
					</div>
				</section>
			</section>
			<footer class="footer bg-white b-t">
				<div class="row text-center-xs">
					<div class="col-md-6 hidden-sm">
						<p class="text-muted m-t">Showing 20-30 of 50</p>
					</div>
					<div class="col-md-6 col-sm-12 text-right text-center-xs">                
						<ul class="pagination pagination-sm m-t-sm m-b-none">
							<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
						</ul>
					</div>
				</div>
			</footer>
		</section>
	</aside>
</section>