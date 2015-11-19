<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8" />
		<title>Proofessor Survey</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="<?php echo INCLUDE_DIR ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo INCLUDE_DIR ?>/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo INCLUDE_DIR ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo CSS_DIR ?>/style-metro.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo CSS_DIR ?>/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo CSS_DIR ?>/style-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo CSS_DIR ?>/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
		<link href="<?php echo INCLUDE_DIR ?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_DIR ?>/plugins/select2/select2_metro.css" />
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="<?php echo CSS_DIR ?>/pages/login.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL STYLES -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="login">
		<!-- BEGIN LOGO -->
		<div class="logo">
			<!--<img src="<?php echo INCLUDE_DIR ?>/img/logo-big.png" alt="" />--> 
		</div>
		<!-- END LOGO -->
		<!-- BEGIN LOGIN -->
		<div class="content">
			<!-- BEGIN LOGIN FORM -->
			<form class="form-vertical login-form" action="<?php echo BASEURL.'index.php/admin/manage/login'; ?>" method="post">
				<h3 class="form-title">Login to your admin account</h3>
				<?php if (isset($error_msg)) { ?>
					<div class="alert alert-error hide" style="display: block;">
						<button class="close" data-dismiss="alert"></button>
						<span><?php echo $error_msg; ?></span>
					</div>
				<?php } else { ?>
					<div class="alert alert-error hide">
						<button class="close" data-dismiss="alert"></button>
						<span>Enter any username and password.</span>
					</div>
				<?php } ?>
				<div class="control-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Username</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-user"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="email" value="<?php if (isset($email)) echo $email; ?>"/>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-lock"></i>
							<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if (isset($passwd)) echo $passwd; ?>"/>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn green pull-right">
						Login <i class="m-icon-swapright m-icon-white"></i>
					</button>            
				</div>
			</form>
			<!-- END LOGIN FORM -->        
		</div>
		<!-- END LOGIN -->
		<!-- BEGIN COPYRIGHT -->
		<div class="copyright">
			2014 &copy; International Student Services.
		</div>
		<!-- END COPYRIGHT -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->   <script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
		<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
		<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
		<!--[if lt IE 9]>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/excanvas.min.js"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/respond.min.js"></script>  
		<![endif]-->   
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery.cookie.min.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>	
		<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/select2/select2.min.js"></script>     
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/scripts/adminlogin.js" type="text/javascript"></script> 
		<!-- END PAGE LEVEL SCRIPTS --> 
		<script>
			jQuery(document).ready(function() {
				App.init();
				Login.init();



			});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>