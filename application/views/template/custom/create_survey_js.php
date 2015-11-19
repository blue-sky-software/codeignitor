
<!-- BEGIN PAGE LEVEL PLUGINS -->   
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/select2/select2.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-switch/static/js/bootstrap-switch.js" type="text/javascript" ></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/scripts/create_survey.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		App.init();
		Create_Survey.init();
	});
</script>
