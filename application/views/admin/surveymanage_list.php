<?php foreach ($surveys as $survey) { ?>
	<tr>
		<td><?php echo $survey[Survey_m::TITLE]; ?></td>
		<td><?php echo $survey[Users_m::EMAIL]; ?></td>
		<td><?php echo $survey[Survey_m::CREATE_DATE]; ?></td>
		<td><?php echo $survey[Survey_m::UPDATE_DATE]; ?></td>
		<td>
			<?php if ($survey[Survey_m::STATUS] == Survey_m::ONLINE) { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_green.png" alt="">
			<?php } else { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_black.png" alt="">
			<?php } ?>
				<?php echo $survey[Survey_m::STATUS]; ?>
		</td>
		<td>
			<button class="btn red mini delBtn" type="button" sid="<?php echo $survey['sid']; ?>">Delete</button>
			<?php if ($survey[Survey_m::STATUS] == Survey_m::ONLINE) { ?>
				<button class="btn blue mini suspendBtn" type="button" sid="<?php echo $survey['sid']; ?>">Suspend</button>
			<?php } else if ($survey[Survey_m::STATUS] == Survey_m::SUSPENDED ) { ?>
				<button class="btn green mini allowBtn" type="button" sid="<?php echo $survey['sid']; ?>">Online</button>
			<?php } ?>
		</td>
	</tr>
<?php } ?>
