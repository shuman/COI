<!DOCTYPE html>
<html lang="en" class="app" ng-app="cutoutApp">
<head>  
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/icon.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css" type="text/css" />  
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/calendar/bootstrap_calendar.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/chosen/chosen.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css?<?php echo time();?>" type="text/css" />  
	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>assets/js/ie/html5shiv.js"></script>
		<script src="<?php echo base_url();?>assets/js/ie/respond.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ie/excanvas.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/js/angular.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/localstoragedb.min.js"></script>
	
	<script type="text/javascript">
		var site_url = '<?php echo site_url("/");?>';
		var base_url = '<?php echo base_url();?>';
		var ajax_url = '<?php echo site_url("/ajax/");?>';
		<?php if($this->tank_auth->get_role() == 'admin'): ?>
		var admin_ajax_url = '<?php echo site_url("/admin_ajax/");?>';
		<?php endif; ?>
		$MASKING_VALUE = <?php echo MASKING_VALUE;?>;
		$RETOUCH_VALUE = 1.0;
		// define('CROP_RESIZE', 		0.25);
		// define('DROP_SHADOW', 		0.25);
		// define('NATURAL_SHADOW', 	0.50);
		// define('MIRROR_EFFECT', 	0.50);
		// define('FILE_TYPE', 		0.05);
		$mannequinCost = 0.75;

	</script>
	<?php if(ENVIRONMENT == 'production'): ?>
	<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-57213366-1','auto');ga('require','displayfeatures');ga('send','pageview');</script>
	<?php endif; ?>
	<!-- Hotjar Tracking Code for https://portal.cutoutimage.com -->
	<script>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:256590,hjsv:5};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
	</script>

</head>
<body class="<?php echo $this->router->fetch_method();?>">
<script>
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/gxwdxei2';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>

<script>
	(function (d, s, id){
	var js, params, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	params = "c2c_token=97f5a5cb-43fb-44a5-945e-8e7767efb22f";
	js = d.createElement(s);
	js.id = id;
	js.src = "https://cdn.aircall.io/c2c/v1/c2c.min.js#"+params;
	fjs.parentNode.insertBefore(js,fjs);
	}(document, "script", "aircall-ajs"))
</script>
<!--div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '849894081723360',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script-->