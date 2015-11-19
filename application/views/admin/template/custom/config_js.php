<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script>

<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/scripts/admin/config.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		App.init();
		MyConfig.init();
	});
</script>
