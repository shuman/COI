<script src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>

<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Message Threads</h3>
                        <small>Logged as <?php echo (isset($this->user_profile->fullname)) ? $this->user_profile->fullname : '';?></small>
                    </div>
                </section>
                <div class="row">
        			<div class="col-lg-3">
                        <div class="list-group auto dk">
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">15</span>
                                diehardcoder
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">30</span>
                                ARCreative
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">9</span>
                                CutOutImage
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">4</span>
                                PhoneGap
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">15</span>
                                diehardcoder
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">30</span>
                                ARCreative
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">9</span>
                                CutOutImage
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge pull-right">4</span>
                                PhoneGap
                            </a>
                        </div>
						
        			</div>
        			<div class="col-lg-9">
          				<section class="panel panel-default">
            				<header class="panel-heading">                    
            					<span class="h5 font-bold">Inbox</span> 
            				</header>
            				<section class="panel-body comment-list">
                                <ul class="list-group list-group-lg no-bg auto">
                                    <?php 
                                    // var_dump($messages);
                                    if($messages){
                                        foreach ($messages as $message) {
                                            ?>
                                            <a href="<?php echo site_url('/admin/messages'). '?thread=' . $message->msg_hashid;?>" class="list-group-item clearfix">
                                                <span class="pull-left thumb-sm avatar m-r">
                                                    <img src="<?php echo avatar();?>" alt="...">
                                                </span>
                                                <span class="clear">
                                                    <span><?php echo $message->sender_name;?></span>
                                                    <small class="text-muted clear text-ellipsis"><?php echo $message->msg_subject;?></small>
                                                </span>
                                            </a>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
				            </section>
      					</section>
    				</div>
  				</div>
			</section>
		</section>
	</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
