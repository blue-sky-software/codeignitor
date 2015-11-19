<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption"><?php echo $seqno; ?>. <?php echo $question['question']; ?></div>
		<div class="actions">
			<button class="btn green mini create_chart" qid="<?php echo $question['qid']; ?>"><?php if (!$forexport) echo 'Create Chart'; ?></button>
		</div>
	</div>
	<div class="portlet-body">
		<table <?php if ($forexport) echo 'border="1"'; ?> class="table table-hover">
			<thead>
				<tr>
					<th style="width: 40%"></th>
					<?php {
						foreach ($col_values as $col_value) {
							echo "<th>$col_value</th>";
						}
					}
					?>
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
						<td><?php echo $row_key; ?></td>
						<?php
						foreach ($row as $col_key => $col) {
							if ($col_key == 'resp_total')
								continue;
							?>
							<td><span class="label label-info"><?php echo $col['resp_percent']; ?>%<br><?php if (!$forexport) echo '('; ?><?php echo $col['resp_cnt']; ?><?php if (!$forexport) echo ')'; ?></span></td>
						<?php } ?>
						<td><span class="label label-success"><?php echo $row['resp_total']; ?></span></td>
					</tr>
					<?php
				}
				?>
				<?php
				if ($first_value = reset($report) && (!$forexport)) {
					?>
					<tr><td><button class="btn green" id="view_matrix_chart_<?php echo $question['qid']; ?>">Hide Matrix Charts</button></td>
						<?php
						$td_cnt = count($first_value);
						for ($i = 0; $i < $td_cnt; $i++) {
							echo '<td></td>';
						}
						echo '</tr>';
					}
					?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	var func = function() {
		var btnid = 'view_matrix_chart_<?php echo $question['qid'] ?>';
		var matrix_chart_div_id = 'matrix-chart-<?php echo $question['qid'] ?>';
		$('#' + btnid).click(function() {
			if ($('#' + matrix_chart_div_id).is(':visible')) {
				$('#' + matrix_chart_div_id).hide();
				$('#' + btnid).text('Show Matrix Charts');
			} else {
				$('#' + matrix_chart_div_id).show();
				$('#' + btnid).text('Hide Matrix Charts');
			}
		});
	}
	func();
</script>

<div class="row-fluid" id="matrix-chart-<?php echo $question['qid'] ?>">
	<div class="offset5"><h3>Matrix Charts</h3></div>
	<?php
	$row_no = 0;
	foreach ($report as $row_key => $row) {
		$row_no++;
		?>
		<div class="portlet box grey">
			<div class="portlet-title">
				<div class="caption"><?php echo "$seqno . $row_no . $row_key"; ?></div>
				<div class="actions">
				</div>
			</div>
			<div class="portlet-body">
				<table <?php if ($forexport) echo 'border="1"'; ?> class="table table-hover">
					<thead>
						<tr>
							<th style="width: 10%"></th>
							<th style="width: 40%"></th>
							<?php  if (!$forexport) { ?>
							<th></th>
							<?php } ?>
							<th class="hidden-480" style="width: 100px">Percent</th>
							<th style="width: 100px">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($row as $col_key => $col) {
							if ($col_key == 'resp_total')
								continue;
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $col_key; ?></td>
								<?php
								$r = rand(0, 255);
								$g = rand(0, 255);
								$b = rand(0, 255);
								?>
								<?php  if (!$forexport) { ?>
								<td>
									<?php if ($col['resp_cnt'] > 0) { ?>
										<span class="label label-info" style="width: <?php echo $col['resp_percent']; ?>%; background: rgb(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>)">.</span>
									<?php } ?>
								</td>
								<?php } ?>
								<td class="hidden-480"><span class="label label-info"><?php echo $col['resp_percent']; ?>%</span></td>
								<td><span class="label label-success"><?php echo $col['resp_cnt']; ?></span></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>
</div>
