<div class="ao_setting row-fluid" id="answer_choice<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<div class="span12 ">
		<div class="control-group">
			<div class="controls">
				<label class="control-label span3" ><?php echo $ao_name; ?></label>
			</div>
			<div class="controls">
				<label >Enter each choice on a seperate line.</label>
				<textarea class="span11" rows="5" name="answer_choice_text<?php echo $ao_index; ?>"></textarea>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid form-section" >
	<div class="span12 ">
		<div class="control-group">
			<div class="controls">
				<div class="span6"></div>
				<label class="control-label span2">Pre-made:</label>
				<select class="answer_choice_pre_made m-wrap span4" src="answer_choice<?php echo $aoid; ?>">
					<option value="">Select a pre-made list</option>
					<optgroup label="Basics">
						<option value="1">Yes / No</option>
						<option value="2">Numbers (1-10)</option>
						<option value="3">Numbers (1-100)</option>
						<option value="4">Days (7)</option>
						<option value="5">Months (12)</option>
						<option class="years" value="6">Years (1940-<?php echo $year; ?>)</option>
					</optgroup>
					<optgroup label="Demographics">
						<option value="7">Age</option>
						<option value="8">Gender</option>
						<option value="9">Race</option>
						<option value="10">Marital Status</option>
						<option value="11">Household Income (HHI)</option>
						<option value="12">UK Cities</option>
						<option value="13">Countries</option>
					</optgroup>
					<optgroup label="Ratings">
						<option value="14">Rating Satisfied</option>
						<option value="15">Rating Agree</option>
						<option value="16">Rating Smilies</option>
					</optgroup>
				</select>
			</div>
		</div>
	</div>
</div>
