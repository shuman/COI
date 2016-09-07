<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Message Board</h3>
                        <small>Logged as <?php echo (isset($this->user_profile->fullname)) ? $this->user_profile->fullname : '';?></small>
                        <br><br>
                        <a href="<?php echo site_url('/admin/messages/');?>" class="btn text-muted"><i class="fa fa-angle-double-left"></i> Back to Messages</a>
                    </div>
                </section>
                <div class="row messages_wrapper">
        			<div class="col-lg-8">
          				<section class="panel panel-default">
            				<header class="panel-heading">                    
            					<span class="h5 font-bold"><?php
			                        if($messages): foreach ($messages as $message):
			                          if($message->msg_subject != null) {
			                            echo $message->msg_subject;
			                          }
			                        endforeach; endif;
			                    ?></span> 
            				</header>
            				<section class="panel-body comment-list">
              					<div id="message_content">
      								<?php
      								if($messages){
      								    foreach ($messages as $message) {
      								        ?>
      								        <article class="comment-item" id="comment-id-3">
      								            <a class="pull-left thumb-sm avatar"><img src="<?php echo get_avatar($message->msg_sender_id);?>"></a>
      								            <span class="arrow left"></span>
      								            <section class="comment-body panel panel-default">
      								                <header class="panel-heading">
      								                    <a href="#"><?php echo $message->sender_name;?></a>
      								                    <label class="label bg-info m-l-xs"><?php echo $message->sender_designation;?></label>
      								                    <span class="text-muted m-l-sm pull-right"><i class="fa fa-clock-o"></i> <span class="timeago" title="<?php echo $message->msg_time;?>"><?php echo $message->msg_time;?></span></span>
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
								    <!-- comment form -->
              					<article id="comment-form" class="comment-item media m-b-md">
              						<a class="pull-left thumb-sm avatar m-t-sm"><img src="<?php echo avatar();?>"></a>
              						<section class="media-body">
              							<form id="message_form" onsubmit="return Admin.Message.send('refresh');" action="" method="post" class="m-t-sm" action="">
              								<input type="hidden" name="parent_id" value="<?php echo $thread;?>">
              								<div class="form-group">
              									<textarea id="message" rows="5" name="message" placeholder="Please write your messages / comments here!" class="form-control"></textarea>
              								</div>
      										<button type="submit" class="btn btn-primary pull-right">Send</button>
              							</form>
              						</section>
              					</article>
				            </section>
      					</section>
    				</div>
    				<div class="col-lg-4">
    					<section class="panel panel-default">
            				<header class="panel-heading">                    
            					<span class="h5 font-bold">Company Information</span> 
            				</header>
            				<section class="panel-body comment-list">
            					<?php
            					if($company){
            						?>
            						<h2><?php echo $company->name;?></h2>
            						<p>Website: <?php echo $company->website;?><br>
            						Email: <?php echo $company->email;?><br>
            						Address1: <?php echo $company->address1;?><br>
            						Address2: <?php echo $company->address2;?><br>
            						Postal Code: <?php echo $company->postal_code;?><br>
            						City: <?php echo $company->city;?><br>
            						Country: <?php echo $company->country;?><br>
            						Phone: <?php echo $company->phone;?></p>
									


            						<?php
            					}
            					?>

            					<?php
            					if($company_owner){
            						?>
            						<section class="panel panel-info">
            							<div class="panel-body">
            								<span class="thumb pull-right m-l m-t-xs avatar">
            									<img src="<?php echo get_avatar($company_owner->id);?>">
        									</span>
            								<div class="clear">
            									<strong><?php echo $company_owner->fullname;?></strong>
            									<div class="text-info"><?php echo $company_owner->email;?></div>
            									<small class="block text-muted">Owner</small>
            								</div>
            							</div>
            						</section>
            						<?php
            					}

            					if($company_members){
            						echo '<section class="panel panel-info">';
            						foreach ($company_members as $member) {
            							?>
	            							<div class="panel-body" style="border-bottom:1px solid #bce8f1;">
	            								<span class="thumb pull-right m-l m-t-xs avatar">
	            									<img src="<?php echo get_avatar($member->id);?>">
	            								</span>
	            								<div class="clear">
	            									<strong><?php echo $member->fullname;?></strong>
	            									<div class="text-info"><?php echo $member->email;?></div>
	            									<small class="block text-muted">Member</small>
	            								</div>
	            							</div>
            							<?php
            						}
	            					echo '</section>';

            					}
            					?>
            				</section>
            			</section>
    				</div>
  				</div>
			</section>
		</section>
	</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script src="<?php echo base_url();?>assets/js/linkify.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('div.messages_wrapper').linkify();

		$(".timeago").timeago();

		tinymce.init({
			plugins : "paste",
			paste_as_text: true,
			paste_auto_cleanup_on_paste : true,
			paste_remove_styles: true,
			paste_remove_styles_if_webkit: true,
			paste_strip_class_attributes: true,
			selector: "textarea",
			theme: "modern",
			skin: 'light',
			menubar:false,
			statusbar: false,
			toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent", 
			setup: function (editor) {
				editor.on('change', function () {
					tinymce.triggerSave();
				});
			}
		});
	});
</script>