<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption"><?php echo $seqno; ?>. <?php echo $question['question']; ?></div>
		<div class="actions">
			<button class="btn green mini create_chart" qid="<?php echo $question['qid']; ?>"><?php if(!$forexport) echo 'Create Chart'; ?></button>
		</div>
	</div>
	<div class="portlet-body">
		<table <?php if ($forexport) echo 'border="1"'; ?> class="table table-hover">
			<thead>
				<tr>
					<th style="width: 40%">No</th>
					<th></th>
					<th style="width: 100px">Response Percent</th>
					<th style="width: 100px">Response Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($report as $row_key => $row) {
					$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_key; ?></td>
						<td><span class="label label-info"><?php echo $row['resp_percent']; ?>%<br><?php if(!$forexport) echo '('; ?><?php echo $row['resp_cnt']; ?><?php if(!$forexport) echo ')'; ?></span></td>
						<td><span class="label label-success"><?php echo $row['resp_cnt']; ?></span></td>
					</tr>
					<?php
					if (isset($row['resp'])) {
						foreach ($row['resp'] as $value) {
							echo '<tr>';
							echo '<td>Contents : </td>';
							echo '<td>' . $value . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '</tr>';
						}
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
