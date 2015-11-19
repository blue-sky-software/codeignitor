                
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="<?php echo INCLUDE_DIR?>/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_DIR?>/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo INCLUDE_DIR?>/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="<?php echo INCLUDE_DIR?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_DIR?>/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="<?php echo INCLUDE_DIR?>/plugins/excanvas.min.js"></script>
	<script src="<?php echo INCLUDE_DIR?>/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo INCLUDE_DIR?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_DIR?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo INCLUDE_DIR?>/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_DIR?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<script src="<?php echo INCLUDE_DIR?>/scripts/common.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
                  <!-- BEGIN CUSTOMIZE  SCRIPT -->
                  <?php // if(isset($name)) include VIEW_ROOT.'/template/custom/'.$name.'_js.php'; ?>
                  <?php if(isset($name)) include 'custom/'.$name.'_js.php'; ?>
                  <!-- END CUSTOMIZE SCRIPT -->
	
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>