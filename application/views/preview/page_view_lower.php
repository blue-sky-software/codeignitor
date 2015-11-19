</div>
</div>
</div>

<?php if (isset($is_enable_progressbar)) { ?>
	<div id="bar" class="progress progress-success progress-striped">
		<div class="bar"></div>
	</div>
<?php } ?>


<div class="row-fluid margin-bottom-20">
	<div class="row-fluid ">
		<div class="span1 offset4">
			<button type="button" id="nextBtn" class="btn blue SurveySubmitButton"><i class="icon-ok"></i> <?php echo $this->lang->line('next'); ?></button>
		</div>
		<div class="span1 offset1">
			<?php if (isset($save)) { ?>
						<!--<button type="button" id="saveBtn" class="btn blue SurveySubmitButton"><i class="icon-ok"></i> <?php echo $this->lang->line('save'); ?></button>-->
				<a class="btn blue SurveySubmitButton" data-toggle="modal" href="#inputEmailDlg"><i class="icon-ok"></i>Save</a>
			<?php } ?>
		</div>
	</div>
</div>
</form>
</div>
</div>
</div>
<input id="base_url" type="hidden" value="<?php echo BASEURL; ?>">
<!--/end row-fluid-->
<div class="row-fluid">
	<div class="span12 coming-soon-footer">
		2014 &copy; International Student Services
	</div>
</div>
</div>
<div id="inputEmailDlg" class="modal hide fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3>Input Email Address</h3>
	</div>
	<form method ="post" action="<?php echo BASEURL ?>index.php/surveyview/save" id="save_continue_form" class="form-horizontal">
		<input type="hidden" name="rid" value="<?php if (isset($rid)) echo $rid; ?>"/>
		<input type="hidden" name="sid" value="<?php if (isset($sid)) echo $sid; ?>"/>
		<input type="hidden" name="seqno" value="<?php if (isset($seqno)) echo $seqno; ?>"/>
		<div class="modal-body">
			<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">

					<div class="alert alert-error hide">
						Please Fill in Following Field.
					</div>	
					<div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls">
							<input type="text" placeholder="Input Your Email Address" class="m-wrap medium" id="email" name="email"/>
							<!--<span class="help-inline">Some hint here</span>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn"  id="cancel">Cancel</button>
			<button type="submit" class="btn green" id="save">Save</button>
		</div>
	</form>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->   

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
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="<?php echo INCLUDE_DIR ?>/plugins/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_DIR ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script>


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

		var imageUrl = 'url(' + baseUrl + "include/img/custom/template/back0<?php
			if (isset($theme_no))
				echo $theme_no;
			else
				echo '1';
			?>.jpg)";
		$('.SurveyBody').css('background-image', imageUrl);

		GetAnswer.init();
	});

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>