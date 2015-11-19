<div class="ao_setting row-fluid" id="q_require_answer<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<div class="span12 ">
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input value="" type="checkbox"><strong><?php echo $ao_name; ?></strong>
				</label>
			</div>
		</div>
		<div class="body offset1 control-group">
		</div>
		<div class="background" style="display:none">
			<div class="controls">
				<label >Display this error message when question is not answered:</label>
				<textarea class="span11" rows="5" name="q_require_answer_message">This question requires an answer.</textarea>
			</div>
		</div>
	</div>
</div>

<script>

	$('#q_require_answer<?php echo $aoid; ?> .checkbox input').click(function() {
		var checked = $(this).parent().attr("class");
		if (checked === 'checked') {
			$('#q_require_answer<?php echo $aoid; ?> .body').empty();
		}
		else {
			var str = $('#q_require_answer<?php echo $aoid; ?> .background').html();
			$('#q_require_answer<?php echo $aoid; ?> .body').append(str);
		}
	});

</script>