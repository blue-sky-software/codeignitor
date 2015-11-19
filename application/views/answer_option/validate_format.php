<style type="text/css">

	#q_validate_format<?php echo $aoid; ?> .body label {
		padding-top: 6px;
	}

	#q_validate_format<?php echo $aoid; ?> .body span {
		padding-top: 6px;
		text-align: center;
	}

</style>

<div class="ao_setting row-fluid" id="q_validate_format<?php echo $aoid; ?>">
	<input type="hidden" class="aoid" value="<?php echo $aoid; ?>">
	<input type="hidden" class="aotype" value="<?php echo $aotype; ?>">
	<input type="hidden" class="kind" value="<?php echo $formatKind; ?>">
	<div class="span12 ">
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input value="" type="checkbox"><strong><?php echo $ao_name; ?></strong>
				</label>
			</div>
		</div>
		<div class="body offset1" style="display: none">
			<div class="control-group">
				<div class="controls">
					<?php if ($formatKind == "1") { ?>
						<div class="controls span5">
							<label class="span8">Respondent must answer:</label>
							<select class="q_validate_type m-wrap span4">
								<option value="1">at least</option>
								<option value="2">at most</option>
								<option value="3">exactly</option>
								<option value="4">range</option>
							</select>
						</div>
					<?php } else { ?>
						<label class="span2">Format:</label>
						<select class="q_validate_type m-wrap span3" style="float:left">
							<option value="6">Email Address</option>
							<option value="7">Number</option>
							<option value="8">Text Length Limit</option>
							<option value="9">Word Count Limit</option>
						</select>
					<?php } ?>
				</div>
			</div>
			<div class="span7">
				<div class="choiceValues span12">
				</div>	
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="span11">Display this error message when question is not in the correct format:</label>
					<textarea class="span11" rows="3" name="q_validate_format_msg">The answer is in an invalid format.</textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="oneChoiceTpl" style="display:none">
		<div class="control-group">
			<div class="controls">
				<input id="q_validate_value" style="float:left" class="span2" value ="1" type="text" >
				<span class="span2">choices</span>
			</div>
		</div>
	</div>
	<div class="twoChoiceTpl" style="display:none">
		<div class="span3">
			<div class="control-group">
				<span class="span6">from</span>
				<div class="controls">
					<input id="q_validate_value1" class="span6" type="text" >
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="control-group">
				<span class="span6">to</span>
				<div class="controls">
					<input id="q_validate_value2"  class="span6" type="text" >
				</div>
			</div>
		</div>
		<span class="span2">choices</span>
	</div>
</div>


<script>

	$('#q_validate_format<?php echo $aoid; ?> .checkbox input').click(function() {
		var checked = $(this).parent().attr("class");
		if (checked === 'checked')
			$('#q_validate_format<?php echo $aoid; ?> .body').hide();
		else
			$('#q_validate_format<?php echo $aoid; ?> .body').show();
	});

	var choice_tpl_elem1 = $('#q_validate_format<?php echo $aoid; ?> .oneChoiceTpl').html();
	var choice_tpl_elem2 = $('#q_validate_format<?php echo $aoid; ?> .twoChoiceTpl').html();
	var selector = '#q_validate_format<?php echo $aoid; ?> .choiceValues';

	if ($('#q_validate_format<?php echo $aoid; ?> .kind').val() === "1") {
		$(selector).append(choice_tpl_elem1);
		$('#q_validate_format<?php echo $aoid; ?> .choiceValues #q_validate_value').attr("name", "q_validate_format_value");
	}

	function select_validate_type(sel) {
		$(selector).empty();
		switch (sel) {
			case '1':
			case '2':
			case '3':
				$(selector).append(choice_tpl_elem1);
				$('#q_validate_format<?php echo $aoid; ?> .choiceValues #q_validate_value').attr("name", "q_validate_format_value");
				break;
			case '4':
			case '7':
			case '8':
			case '9':
				$(selector).append(choice_tpl_elem2);
				$('#q_validate_format<?php echo $aoid; ?> .choiceValues #q_validate_value1').attr("name", "q_validate_format_value1");
				$('#q_validate_format<?php echo $aoid; ?> .choiceValues #q_validate_value2').attr("name", "q_validate_format_value2");
				break;
		}
	}

	$('#q_validate_format<?php echo $aoid; ?> .q_validate_type').change(function() {
		select_validate_type($(this).val());
	});



</script>