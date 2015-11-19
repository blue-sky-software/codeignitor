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
					<th style="width: 10%">No</th>
					<th style="width: 40%">Answer</th>
					<th></th>
					<th class="hidden-480" style="width: 100px">Response Percent</th>
					<th style="width: 100px">Responsse Total</th>
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
						<?php
						$r = rand(0, 255);
						$g = rand(0, 255);
						$b = rand(0, 255);
						?>
						<td>
							<?php if (($value['resp_cnt'] > 0) && (!$forexport)) { ?>
								<span class="label label-info" style="width: <?php echo $value['resp_percent']; ?>%; background: rgb(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>)">.</span>
							<?php } ?>
						</td>
						<td class="hidden-480"><span class="label label-info"><?php echo $value['resp_percent']; ?>%</span></td>
						<td><span class="label label-success"><?php echo $value['resp_cnt']; ?></span></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>