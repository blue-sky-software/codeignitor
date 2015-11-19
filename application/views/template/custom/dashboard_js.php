<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/scripts/dashboard.js"></script>
<script>
	jQuery(document).ready(function() {
		App.init();
		Dashboard.init();
	});
</script>