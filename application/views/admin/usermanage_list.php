<?php foreach ($users as $user) { ?>
	<tr>
		<td><?php echo $user[Users_m::USERNAME]; ?></td>
		<td><?php echo $user[Users_m::EMAIL]; ?></td>
		<td><?php echo $user[Users_m::CREATE_DATE]; ?></td>
		<td>
			<?php if ($user[Users_m::STATUS] == Users_m::ALLOWED) { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_green.png" alt="">
			<?php } else if($user[Users_m::STATUS] == Users_m::SUSPENDED) { ?>
				<img src="<?php echo IMG_DIR ?>/custom/bullet_black.png" alt="">
			<?php } ?>
		</td>
		<td>
			<button class="btn red mini delBtn" type="button" uid="<?php echo $user['uid']; ?>">Delete</button>
			<?php if ($user[Users_m::STATUS] == Users_m::ALLOWED) { ?>
				<button class="btn blue mini suspendBtn" type="button" uid="<?php echo $user['uid']; ?>">Suspend</button>
			<?php } else if($user[Users_m::STATUS] == Users_m::SUSPENDED) { ?>
				<button class="btn green mini allowBtn" type="button" uid="<?php echo $user['uid']; ?>">Allow</button>
			<?php } ?>
		</td>
	</tr>
<?php } ?>
