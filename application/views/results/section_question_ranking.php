<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption"><?php echo $seqno; ?>. <?php echo $question['question']; ?></div>
		<div class="actions">
			<button class="btn green mini create_chart" qid="<?php echo $question['qid']; ?>"><?php if(!$forexport) echo 'Create Chart'; ?></button>
		</div>
	</div>
	<div class="portlet-body">
		<table <?php if($forexport) echo 'border="1"'; ?> class="table table-hover">
			<thead>
				<tr>
					<th style="width: 10%">No</th>
					<th style="width: 40%">Item</th>
					<th></th>
					<th class="hidden-480" style="width: 100px">Total Score</th>
					<th style="width: 100px">Overall Rank</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($answer as $key => $value) {
					$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $key; ?></td>
						<td></td>
						<td class="hidden-480"><span class="label label-info"><?php echo $value['score']; ?></span></td>
						<td><span class="label label-success"><?php echo $value['rank']; ?></span></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>