
<div id="design_main_body">
	<ul class="breadcrumb" style="background-color: #27a9e3;">
		<li>
			<a href="<?php echo BASEURL; ?>index.php/surveyedit/index/<?php echo $SID; ?>"><img src="<?php echo INCLUDE_DIR; ?>/img/custom/ico_design_s.png" /> Design</a> 
			<span>&nbsp;|&nbsp;</span>
		</li>
		<!--	<li>
				<a href="<?php echo BASEURL; ?>index.php/surveyedit/theme/<?php echo $SID; ?>"><img src="<?php echo INCLUDE_DIR; ?>/img/custom/ico_theme.png" /> Theme</a>
				<span>&nbsp;|&nbsp;</span>
			</li>-->
		<li><a href="<?php echo BASEURL; ?>index.php/surveyedit/setting/<?php echo $SID; ?>"><img src="<?php echo INCLUDE_DIR; ?>/img/custom/ico_setting.png" /> Setting</a></li>
	</ul>

	<?php
	if ($category === SurveyEdit::CAT_DESIGN)
		include 'survey_design_v.php';
	else if ($category === SurveyEdit::CAT_THEME)
		include 'survey_theme_v.php';
	else if ($category === SurveyEdit::CAT_SETTING)
		include 'survey_setting_v.php';
	?>

</div>

<div id="design_q_body" style="display: none">
	<form name ="q_dialog-form" id="q_dialog-form">
		<input type="hidden" id="q_page_no" />
		<input type="hidden" id="q_question_no" />
		<input type="hidden" id="save_question_url" value=""/>
		<div class="form-actions ">
			<h3 class="questionTitle span12" ></h3>
		</div>
		<div class="form-body">
			<div class="alert alert-error hide">
				There was a problem saving this question. Please review below.
			</div>	
			<div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<?php include 'survey_design_q_content.php'; ?>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<div class="offset4 span4">
				<div class="row-fluid span5">
					<button type="submit" class="btn green">Save&nbsp;Question</button>
				</div>
				<div class="row-fluid span2">
				</div>
				<div class="row-fluid span5">
					<button type="button" class="btn yellow cancel">Cancel</button>
				</div>
			</div>
		</div>
	</form>

</div>

