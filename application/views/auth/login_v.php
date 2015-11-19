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
			<form class="form-vertical login-form" action="<?php echo BASEURL . "index.php/auth/loginDo"; ?>" method="post">
				<h3 class="form-title">Login to your account</h3>
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
					<label class="control-label visible-ie8 visible-ie9">Email</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-user"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" id="inEMail" name="email" value="<?php if (isset($email)) echo $email; ?>"/>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-lock"></i>
							<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="inPasswd" name="password" value="<?php if (isset($passwd)) echo $passwd; ?>"/>
						</div>
					</div>
				</div>
				<div class="control-group" id="div_captcha">
					<?php if ($cap['image']) echo $cap['image'] ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="" id="refreshCaptcha">Refresh Captcha</a>
					<div class="controls" style="margin-top: 5px">
						<div class="input-icon left">
							<i class="icon-font"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Captcha" name="captcha"/>
						</div>
					</div>           
				</div>
				<div class="form-actions">
					<button type="submit" class="btn green pull-right">
						Login <i class="m-icon-swapright m-icon-white"></i>
					</button>            
				</div>
				<div class="forget-password">
					<h4>Forgot your password ?</h4>
					<p>
						no worries, click <a href="javascript:;"  id="forget-password">here</a>
						to reset your password.
					</p>
				</div>
				<div class="create-account">
					<p>
						Don't have an account yet ?&nbsp; 
						<a href="javascript:;" id="register-btn" >Create an account</a>
					</p>
				</div>
			</form>
			<!-- END LOGIN FORM -->        
			<!-- BEGIN FORGOT PASS WORD FORM -->
			<form class="form-vertical forget-form" action="<?php echo BASEURL . 'index.php/auth/reset_password'; ?>" method="post">
				<h3 >Forget Password ?</h3>
				<p>Enter your e-mail address below to reset your password.</p>
				<div class="control-group">
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-envelope"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
						</div>
					</div>
				</div>
				<div class="control-group" id="div_captcha_recover">
					<?php if ($cap['image']) echo $cap['image'] ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="" id="refreshCaptcha_recover">Refresh Captcha</a>
					<div class="controls" style="margin-top: 5px">
						<div class="input-icon left">
							<i class="icon-font"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Captcha" name="captcha"/>
						</div>
					</div>           
				</div>
				<div class="form-actions">
					<button type="button" id="back-btn" class="btn">
						<i class="m-icon-swapleft"></i> Back
					</button>
					<button type="submit" class="btn green pull-right">
						Submit <i class="m-icon-swapright m-icon-white"></i>
					</button>            
				</div>
			</form>
			<!-- END FORGOT PASSWORD FORM -->
			<!-- BEGIN REGISTRATION FORM -->
			<form class="form-vertical register-form" action="<?php echo BASEURL . 'index.php/auth/register'; ?>" method="post">
				<h3 >Sign Up</h3>
				<p>Enter your personal details below:</p>
				<div class="control-group">
					<label class="control-label visible-ie8 visible-ie9">Full Name</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-font"></i>
							<input class="m-wrap placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/>
						</div>
					</div>
				</div>
				<div class="control-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Email</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-envelope"></i>
							<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-lock"></i>
							<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
						</div>
					</div>
					<div class="controls">
						<label id="result" class="label label-info" ></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
					<div class="controls">
						<div class="input-icon left">
							<i class="icon-ok"></i>
							<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
						</div>
					</div>
				</div>
				<div class="control-group" id="div_captcha_register">
					<?php if ($cap['image']) echo $cap['image'] ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="" id="refreshCaptcha_register">Refresh Captcha</a>
					<div class="controls" style="margin-top: 5px">
						<div class="input-icon left">
							<i class="icon-font"></i>
							<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Captcha" name="captcha"/>
						</div>
					</div>           
				</div>
				<div class="form-actions">
					<button id="register-back-btn" type="button" class="btn">
						<i class="m-icon-swapleft"></i>  Back
					</button>
					<button type="submit" id="register-submit-btn" class="btn green pull-right">
						Sign Up <i class="m-icon-swapright m-icon-white"></i>
					</button>            
				</div>
			</form>
			<!-- END REGISTRATION FORM -->
		</div>
		<!-- END LOGIN -->
		<input id="base_url" type="hidden" value="<?php echo BASEURL; ?>">

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
		<script src="<?php echo INCLUDE_DIR ?>/scripts/common.js" type="text/javascript" ></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>	
		<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/select2/select2.min.js"></script>     
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/scripts/login.js" type="text/javascript"></script> 
		<!-- END PAGE LEVEL SCRIPTS --> 
		<script>
                                                      var pass;
			jQuery(document).ready(function() {
				
                                                        App.init();
                                                        Login.init();
                                                        
                                                        $("#inEMail").focusin(function() {
                                                            pass = $("#inPasswd").val();
                                                        });
                                                        $("#inEMail").focusout(function() {
                                                            $("#inPasswd").val(pass);
                                                        });
			});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>