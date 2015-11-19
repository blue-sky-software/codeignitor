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
		<link href="<?php echo INCLUDE_DIR ?>/css/style-metro.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo INCLUDE_DIR ?>/css/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo INCLUDE_DIR ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo INCLUDE_DIR ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
		<link href="<?php echo INCLUDE_DIR ?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="<?php echo INCLUDE_DIR ?>/css/pages/coming-soon.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL STYLES -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12 coming-soon-header">
					<a class="brand" href="<?php echo BASEURL . "index.php" ?>">
						<img src="<?php echo INCLUDE_DIR ?>/img/logo.png" alt="logo" />
					</a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12 coming-soon-content">
					<h1><?php echo $survey[Survey_m::THANKYOU_TITLE]; ?></h1>
					<p><h3><strong><?php if (isset($page_title)) echo "Page Title : " . $page_title; ?></strong></h3></p>
					<br>
				</div>
				<!-- BEGIN PAGE CONTENT-->
				<form name="answer_form" id="answer_form" action="<?php echo BASEURL; ?>index.php/answer/receive_answer" method="post">
					<input type="hidden" name="sid" value="<?php if (isset($sid)) echo $sid; ?>">
					<input type="hidden" name="pid" value="<?php if (isset($pid)) echo $pid; ?>">
					<div class="row-fluid margin-bottom-20">
						<div class="offset1 row-fluid ">
							<div class="span10">
								<h4><?php echo $survey[Survey_m::THANKYOU_CONTENT]; ?></h4>
							</div>
						</div>
					</div>
					<div class="row-fluid margin-bottom-20">
						<div class="row-fluid ">
							<div class="span12 offset5">
								<!--<button type="submit" class="btn blue"><i class="icon-ok"></i> Next</button>-->
							</div>
						</div>
					</div>
				</form>
			</div>
			<!--/end row-fluid-->
			<input id="base_url" type="hidden" value="<?php echo BASEURL; ?>">
			<div class="row-fluid">
				<div class="span12 coming-soon-footer">
					2014 &copy; International Student Services
				</div>
			</div>
		</div>
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
		<script src="<?php echo INCLUDE_DIR ?>/plugins/countdown/jquery.countdown.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js" type="text/javascript"></script>
		<script src="<?php echo INCLUDE_DIR ?>/scripts/common.js" type="text/javascript"></script>      
		<script src="<?php echo INCLUDE_DIR ?>/scripts/coming-soon.js" type="text/javascript"></script>      
		<script src="<?php echo INCLUDE_DIR ?>/scripts/get-answer.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS --> 
		<script>
			jQuery(document).ready(function() {
				App.init();
				ComingSoon.init();
				GetAnswer.init();

				var imageUrl = 'url(' + $('#base_url').val() + "include/img/custom/template/back01.jpg)";
				$('body').css('background-image', imageUrl);



			});

		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>