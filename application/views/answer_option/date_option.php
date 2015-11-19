<div class="ao_setting row-fluid form-section" id="date_option<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<div class="span6 ">
		<div class="control-group">
			<label class="control-label"><?php echo $ao_name; ?></label>
			<div class=" controls">
				<select  id="date_option_select1" class="m-wrap span12">
					<option selected="selected" value="1">Date Only</option>
					<option value="2">Time Only</option>
					<option value="3">Both Date and Time</option>
				</select>
				<select  id="date_option_select2" class="m-wrap span12">
					<option selected="selected" value="1">DD/MM/YYYY format</option>
					<option value="2">MM/DD/YYYY format</option>
				</select>
			</div>
		</div>
	</div>
</div>
