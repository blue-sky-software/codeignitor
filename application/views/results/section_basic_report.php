<div class="row-fluid">
	<h3>
		<div class="span3"><strong>Results Summary</strong></div>
	</h3>
</div>
<div class="row-fluid">
	<div class="span7">
		<div class="row-fluid">
			<div class="span2">
				<h4>Statistics : </h4>
			</div>
			<div class="span4">
				Survey Created<br>
				<input class="m-wrap" style="width: 80px" readonly="" type="text" value="<?php if (isset($s_created)) echo $s_created; ?>">
			</div>
			<div class="span2">
				Respondents<br>
				<input class="m-wrap" style="width: 50px" readonly="" type="text" value="<?php if (isset($s_respondents)) echo $s_respondents; ?>">
			</div>
			<div class="span2">
				Partial<br>
				<input class="m-wrap" style="width: 50px" readonly="" type="text" value="<?php if (isset($s_partial)) echo $s_partial; ?>">
			</div>
			<div class="span2">
				Completed<br>
				<input class="m-wrap" style="width: 50px" readonly="" type="text" value="<?php if (isset($s_completed)) echo $s_completed; ?>">
			</div>
		</div>
	</div>
	<div class="span4 offset1">
		<a href="<?php echo BASEURL."index.php/results/toWord/$sid" ?>" class="btn purple">Send to Word<i class="m-icon-swapright m-icon-white"></i></a>
		<a href="<?php echo BASEURL."index.php/results/toExcel/$sid" ?>" class="btn purple">Send to Excel<i class="m-icon-swapright m-icon-white"></i></a>
	</div>
</div>
<div class="row-fluid">
	<div class="span4 offset8">
		<select class="m-wrap" id="page_selecter">
			<option value="--Listing All Pages--">--Listing All Pages--</option>
			<?php foreach ($pages as $i => $page) { ?>
				<option value="<?php echo $page['pid']; ?>"><?php echo $i+1; ?></option>
			<?php } ?>
		</select>
	</div>
</div>	
