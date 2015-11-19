
<!-- BEGIN PAGE LEVEL PLUGINS -->   
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-switch/static/js/bootstrap-switch.js" type="text/javascript" ></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/ckeditor/ckeditor.js"></script>  
<script src="<?php echo INCLUDE_DIR ?>/plugins/select2/select2.min.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-daterangepicker/date.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo INCLUDE_DIR ?>/scripts/app.js"></script>
<!--<script src="<?php echo INCLUDE_DIR ?>/scripts/ui-modals.js"></script>-->
<script src="<?php echo INCLUDE_DIR ?>/scripts/survey_design.js"></script>     
<script src="<?php echo INCLUDE_DIR ?>/scripts/survey_collect.js"></script>     

<!-- END PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		App.init();
//		UIModals.init();
		SurveyDesign.init();
		SurveyCollect.init();
	});
</script>
