<?php foreach ($surveys as $value) { ?>
	<tr>
		<td>
			<?php if ($value['status'] == Survey_m::ONLINE) { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_green.png" alt="">
			<?php } else { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_black.png" alt="">
			<?php } ?>
		</td>
		<td><?php echo $value['title']; ?></td>
		<td><?php echo $value['create_date']; ?></td>
		<td>
			<a href="<?php echo BASEURL; ?>index.php/surveyedit/index/<?php echo $value['sid']; ?>" class="designBtn" sid="<?php echo $value['sid']; ?>">
				<img src="<?php echo IMG_DIR ?>/custom/ico_design.png" alt="">
			</a>
		</td>
		<td>
			<a href="<?php echo BASEURL; ?>index.php/surveycollect/index/<?php echo $value['sid']; ?>" class="collectBtn" sid="<?php echo $value['sid']; ?>">
				<img src="<?php echo IMG_DIR ?>/custom/ico_collect.png" alt="">
			</a>
		</td>
		<td>
			<a href="<?php echo BASEURL; ?>index.php/results/s/<?php echo $value['sid']; ?>" class="resultBtn" sid="<?php echo $value['sid']; ?>">
				<img src="<?php echo IMG_DIR ?>/custom/ico_results.png" alt="">
			</a>
		</td>
		<td><?php echo $value['point']; ?></td>
		<td>
			<div class="span12">
				<button data-toggle="modal" href="#copy_confirm_dlg" class="span4 btn blue mini copyBtn" type="button" sid="<?php echo $value['sid']; ?>">Copy</button>
				<button data-toggle="modal" href="#clear_confirm_dlg" class="span4 btn green mini clearBtn" type="button" sid="<?php echo $value['sid']; ?>">Clear</button>
				<button data-toggle="modal" href="#del_confirm_dlg" class="span4 btn red mini delBtn" type="button" sid="<?php echo $value['sid']; ?>">Delete</button>
			</div>
		</td>
	</tr>
<?php } ?>
