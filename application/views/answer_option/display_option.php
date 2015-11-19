<div class="ao_setting row-fluid form-section" id="display_option<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<div class="span6 ">
		<div class="control-group">
			<label class="control-label"><?php echo $ao_name; ?></label>
			<div class="controls">
				<select  class="m-wrap span12">
					<?php foreach ($list as $i => $elem) { ?>
						<option value="<?php echo $i; ?>"><?php echo $elem ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>