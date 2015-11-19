<div class="ao_setting row-fluid form-section" id="box_size<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<div class="span12 ">
		<div class="control-group">
			<label class="control-label"><?php echo $ao_name; ?></label>
		</div>
		<div class="offset1 control-group">
			<div class="controls">
				<?php if ($simplebox == "false") { ?>
					<select id="q_answer_box_size1" class="m-wrap span2">
						<?php foreach ($line as $i => $elem) { ?>
							<option <?php if ($i == $line_select) echo 'selected=""'; ?> value="<?php echo $i; ?>"><?php echo $elem ?></option>
						<?php } ?>
					</select>
				<?php } ?>
				<select id="q_answer_box_size2" class="m-wrap span4">
					<?php foreach ($charwide as $i => $elem) { ?>
						<option <?php if ($i == $charwide_select) echo 'selected=""'; ?> value="<?php echo $i; ?>"><?php echo $elem ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>