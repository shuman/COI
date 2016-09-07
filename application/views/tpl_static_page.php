<?php

/*
 * Template for static page auth/not
 *
 */
?>
<?php echo $header; ?>
    
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
	    <div class="navbar-header bg-light aside-md">
	        <a href="<?php echo site_url();?>" class="navbar-brand">
	            <img src="<?php echo base_url();?>assets/images/logo.svg" class="m-r-sm" alt="Cut Out Image">
	            <!-- <span class="hidden-nav-xs">Cut Out Image</span> -->
	        </a>
	    </div>
	</header>
	<?php echo $content;?>
<?php echo $footer; ?>