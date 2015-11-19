<div id="response-div">
</div>

<input type="hidden" id="survey_id" value="<?php if (isset($SID)) echo $SID; ?>"/>

<div class="row-fluid ">
	You can select one of our ready made theme templates for your survey. You can change this at any time
</div>

<div class="row-fluid margin-top-20">
	<div class="span1"></div>
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
					<input type="radio" name="theme_radio" value="<?php echo $i+1; ?>" <?php if($i==0) echo 'checked'; ?>>Select Theme <?php echo $i + 1; ?>
				</label>
			</div>
		</div>
	<?php } ?>
	<div class="span2 offset5">
		<button id="select_theme_btn" class="btn red">Select Theme</button>
	</div>
</div>

