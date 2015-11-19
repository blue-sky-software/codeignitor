
<input type="hidden" id="survey_id" value="<?php if (isset($SID)) echo $SID; ?>"/>



<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">Theme</div>
		<div class="actions">
		</div>
	</div>
	<div class="portlet-body">
		<div class="row-fluid">
			<div class="offset2 span10">
				<div class =" control-group">
					<div class="span12"></div>
					<label class="controls-label">You can select one of our ready made theme templates for your survey. You can change this at any time</label>
					<div class="controls ">
					</div>
					<div class="span12"></div>
					<div class="controls ">
						<?php for ($i = 0; $i < $theme_cnt; $i++) { ?>
							<div class="span2">
								<div class="item">
									<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="<?php echo INCLUDE_DIR; ?>/img/custom/present/0<?php echo $i + 1; ?>.png" target="_blank">
										<div class="zoom">
											<img src="<?php echo INCLUDE_DIR; ?>/img/custom/present/0<?php echo $i + 1; ?>.png" alt="Photo" />                    
											<div class="zoom-icon"></div>
										</div>
									</a><br>
									<label class="radio">
										<input type="radio" name="theme_radio" value="<?php echo $i + 1; ?>" <?php if ($i == 0) echo 'checked'; ?>>Theme<?php echo $i + 1; ?>
									</label>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="controls ">
						<div class="span2 offset4">
							<button id="select_theme_btn" class="btn green">Select&nbsp;Theme</button>
						</div>
						<div class="span12"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">Setting</div>
		<div class="actions">
		</div>
	</div>
	<div class="portlet-body">
		<div class="row-fluid">
			<form method ="post" id="settingForm" action="<?php echo BASEURL; ?>index.php/surveyedit/save_setting/<?php if (isset($SID)) echo $SID; ?>">
				<div class="offset2 span10">
					<div class="alert alert-error hide">
						Please Fill in the following field.
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls">
							<label class="span6 controls-label ">Allow more than one responses from one computer :</label>
							<div class="text-toggle-button"  id="response_one_computer">
								<input type="checkbox" class="toggle"  <?php if ($is_response_one_computer == 'on') echo "checked=\"checked\""; ?>  name="response_one_computer"/>
							</div>
						</div>
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls ">
							<label class="span6 controls-label">Enable progress bar :</label>
							<div class="text-toggle-button"  id="enable_progressbar">
								<input type="checkbox" class="toggle" <?php if ($is_enable_progressbar == 'on') echo "checked=\"checked\""; ?> name="enable_progressbar"/>
							</div>
						</div>
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls">
							<label class="span6 controls-label">Save and Continue :</label>
							<div class="text-toggle-button"  id="save_continue">
								<input type="checkbox" class="toggle" <?php if ($is_save_continue == 'on') echo "checked=\"checked\""; ?>  name="save_continue"/>
							</div>
						</div>
					</div>
					<div class =" offset1 control-group" id="sc_body" <?php if ($is_save_continue != 'on') echo "style=\"display: none;\""; ?>>
						<div class="controls">
							<label class="span2 controls-label">From Email:</label>
							<div class="text-toggle-button row-fluid"  id="set_max_response">
								<input class="span6 m-wrap" type="text" value="<?php echo $sc_from_email; ?>" id="sc_from_email" name="sc_from_email1">
							</div>
						</div>
						<div class="controls">
							<label class="span2 controls-label">Subject:</label>
							<div class="text-toggle-button row-fluid">
								<input class="span6 m-wrap" type="text" value="<?php echo $sc_subject; ?>" id="sc_subject" name="sc_subject1"/>
							</div>
						</div>
						<div class="controls">
							<label class="span2 controls-label">Message:</label>
							<div class="text-toggle-button row-fluid">
								<textarea class="span6 m-wrap" type="text" id="sc_message" name="sc_message1" rows ="10"><?php echo $sc_message; ?></textarea>
							</div>
						</div>
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls ">
							<label class="span6 controls-label">Set cut-off date  :</label>
							<div class="text-toggle-button"  id="set_cut_off_date">
								<input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo $cut_off_date; ?>" name="set_cut_off_date" />
							</div>
						</div>
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls ">
							<label class="span6 controls-label">Set max response :</label>
							<div class="text-toggle-button"  id="set_max_response">
								<input class="span3 m-wrap" type="text" value="<?php echo $max_response; ?>" name="set_max_response"/></input>
							</div>
						</div>
					</div>
					<div class =" control-group">
						<div class="span12"></div>
						<div class="controls ">
							<div class="span2 offset4">
								<button type="submit" class="btn green">Save&nbsp;Changes</button>
							</div>
							<div class="span12"></div>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

