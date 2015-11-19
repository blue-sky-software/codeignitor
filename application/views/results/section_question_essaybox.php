<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption"><?php if(isset($seqno)) echo $seqno; ?>. <?php if(isset($question)) echo $question['question']; ?></div>
		<div class="actions">
			<button class="btn green mini create_chart" qid="<?php echo $question['qid']; ?>"><?php if(!$forexport) echo 'Create Chart'; ?></button>
		</div>
	</div>
	<div class="portlet-body">
		<table <?php if($forexport) echo 'border="1"'; ?> class="table table-hover">
			<thead>
				<tr>
					<th style="width: 10%">No</th>
					<th style="width: 40%">Answer</th>
					<th></th>
					<th class="hidden-480" style="width: 100px">Response Percent</th>
					<th style="width: 100px">Responsse Total</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>