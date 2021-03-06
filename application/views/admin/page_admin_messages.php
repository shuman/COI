<script src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>

<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Message Board</h3>
                        <small>Logged as <?php echo (isset($this->user_profile->fullname)) ? $this->user_profile->fullname : '';?></small>
                    </div>
                </section>
                <div class="row">
        			<div class="col-lg-8">
          				<section class="panel panel-default">
            				<header class="panel-heading">                    
            					<span class="h5 font-bold">Drop A Message</span> 
            				</header>
            				<section class="panel-body comment-list">
              					<!-- comment form -->
              					<article id="comment-form" class="comment-item media m-b-md">
              						<a class="pull-left thumb-sm avatar m-t-sm"><img src="<?php echo $this->avatar;?>"></a>
              						<section class="media-body">
              							<form id="message_form" onsubmit="return Portal.Message.send('refresh');" action="" method="post" class="m-t-sm" action="">
              								<div class="form-group">
              									<textarea id="message" rows="5" name="message" placeholder="Please write your messages / comments here!" class="form-control"></textarea>
              								</div>
      										<button type="submit" class="btn btn-primary pull-right">Send</button>
              							</form>
              						</section>
              					</article>
              					<div id="message_content">
								<?php
								if($messages){
								    foreach ($messages as $message) {
								        ?>
								        <article class="comment-item" id="comment-id-3">
								            <a class="pull-left thumb-sm avatar"><img src="<?php echo $this->avatar;?>"></a>
								            <span class="arrow left"></span>
								            <section class="comment-body panel panel-default">
								                <header class="panel-heading">
								                    <a href="#"><?php echo $message->sender_name;?></a>
								                    <label class="label bg-info m-l-xs"><?php echo $message->sender_designation;?></label> 
								                    <span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i> <span class="timeago" title="<?php echo $message->msg_time;?>"><?php echo $message->msg_time;?> </span>
								                </header>
								                <div class="panel-body">
								                    <div><?php echo $message->msg_content;?></div>
								                    <!--div class="comment-action m-t-sm">
								                        <a class="btn btn-default btn-xs" data-dismiss="alert" href="#comment-id-3"><i class="fa fa-trash-o text-muted"></i> Remove </a>
								                    </div-->
								                </div>
								            </section>
								        </article>
								        <?php
								    }
								}
								?>
								</div>
				            </section>
      					</section>
    				</div>
    				<div class="col-lg-4">
    					<section class="panel panel-default">
            				<header class="panel-heading">                    
            					<span class="h5 font-bold">Create New</span> 
            				</header>
            				<section class="panel-body comment-list">
            					<ul>
            				</section>
            			</section>
    				</div>
  				</div>
			</section>
		</section>
	</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
