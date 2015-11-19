<script>

	$('.ranking_selector_container_<?php echo $qid; ?> select').focus(function() {
		
		$('.ranking_selector_container_<?php echo $qid; ?> select').each(function(index) {
			$(this).prop("selectedIndex", index+1);
		});
		
		prevVal = $(this).val();
		
	}).change(function() {
		
		newVal = $(this).val();
		
		if(!newVal) {
			$(this).prop("selectedIndex", prevVal);
			return;
		}
		if (newVal < prevVal) {
			$('#Question<?php echo $qid; ?> .ranking_selector_container_<?php echo $qid; ?>').eq(newVal - 1).before($(this).parent());
		} else {
			$('#Question<?php echo $qid; ?> .ranking_selector_container_<?php echo $qid; ?>').eq(newVal - 1).after($(this).parent());
		}

		$('.ranking_selector_container_<?php echo $qid; ?> select').each(function(index) {
			$(this).prop("selectedIndex", index + 1);
		});
	});
	
</script>
