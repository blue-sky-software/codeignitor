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
					<th></th>
					<?php
					foreach ($dropdown_values as $dropdown_value) {
						echo '<th style="width: 100px">' . $dropdown_value . '</th>';
					}
					?>
					<th style="width: 100px">Response Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($report as $col_key => $col) {
					?>
					<tr><td><strong><?php echo $col_key; ?></strong></td></tr>
					<?php
					$i = 0;
					foreach ($report[$col_key] as $row_key => $row) {
						$i++;
						?>
						<tr>
							<td><?php echo $row_key; ?></td>
							<?php
							foreach ($row as $dropdown_key => $dropdown) {
								if ($dropdown_key == 'resp_total')
									continue;
								?>
								<td><span class="label label-info"><?php echo $dropdown['resp_percent']; ?>%<br><?php if(!$forexport) echo '('; ?><?php echo $dropdown['resp_cnt']; ?><?php if(!$forexport) echo ')'; ?></span></td>
							<?php } ?>
							<td><span class="label label-success"><?php echo $row['resp_total']; ?></span></td>
						</tr>
						<?php
					}
					?>
					<?php
				}
				?>

			</tbody>
		</table>
	</div>
</div>
