<div class="row-fluid">
	<h3>
		<div class="span3"><strong>Collect Responses</strong></div>
		<div class="span3 offset6" style=""><small>status
				<?php if ($s_status == Survey_m::OFFLINE) { ?>
					<img src="<?php echo IMG_DIR ?>/custom/bullet_black.png" alt=""><strong>Offline</strong>
				<?php } else { ?>
					<img src="<?php echo IMG_DIR ?>/custom/bullet_green.png" alt=""><strong>Online</strong>
				<?php } ?>
			</small></div>
	</h3>
</div>
<div class="row-fluid">
	<div class="span7">
		<div class="portlet box grey">
			<div class="portlet-title">
				<div class="caption">Live Link</div>
			</div>
			<div class="portlet-body">
				<div class="row-fluid">
					<div class="offset1">
						<br>Use this link for any purpose. Copy the web link below to your users.
					</div>
				</div>
				<div class="row-fluid">
					<div class="offset1 margin-bottom-20">
						<br><br><input class="m-wrap" style="width: 90%" readonly="" type="text" id="link_url" value="<?php echo $s_url; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="portlet box grey">
			<div class="portlet-title">
				<div class="caption">Survey Status</div>
			</div>
			<div class="portlet-body">
				<div class="row-fluid">
					<div class="offset1">
						<br>To be able to collect responses you must put the survey online.
					</div>
				</div>
				<div class="row-fluid">
					<div class="offset1 margin-bottom-20">
						<br>
						<div class="text-toggle-button"  id="toggleStatus">
							<input type="checkbox" class="toggle" <?php if ($s_status != Survey_m::OFFLINE) echo "checked=\"checked\""; ?>/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box grey">
			<div class="portlet-title">
				<div class="caption">How do you want to Collect Responses?</div>
			</div>
			<div class="portlet-body">
				<div class="offset1 span11">
					<div class="row-fluid">
						<div class="control-group">
							<div class="span12"></div>
							<div class="controls">
								<div class="span2">
									<a class="btn red big" href="https://plus.google.com/share?url=<?php echo $s_url; ?>"><i class="icon-google-plus-sign"></i> Google+</a>
								</div>
								<div class="span2">
									<a class="btn blue big" href="http://www.facebook.com/sharer.php?u=<?php echo $s_url; ?>"><i class="icon-facebook"></i> Facebook</a>
								</div>
								<div class="span2">
									<a class="btn green big" href="http://twitter.com/share?url=<?php echo $s_url; ?>&text=ProfessorSurvey"><i class="icon-twitter"></i> Twitter</a>
								</div>
								<div class="span2">
									<!--<a class="btn yellow big" id="btn_weibo"><i class="icon-weibo"></i> Weibo</a>-->
									<script type="text/javascript">
										document.writeln("<a class=\"btn yellow big\" href=\"javascript:void((function(s,d,e){try{}catch(e){}var f=\'http:\/\/v.t.sina.com.cn\/share\/share.php?\',u=d.location.href,p=[\'url=\',e(u),\'&title=\',e(d.title),\'&appkey=2924220432\'].join(\'\');function a(){if(!window.open([f,p].join(\'\'),\'mb\',[\'toolbar=0,status=0,resizable=1,width=620,height=450,left=\',(s.width-620)\/2,\',top=\',(s.height-450)\/2].join(\'\')))u.href=[f,p].join(\'\');};if(\/Firefox\/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}})(screen,document,encodeURIComponent));\"><i class=\"icon-weibo\"></i> Weibo<\/a>");
									</script>
								</div>
								<div class="span2">
									<a class="btn purple big" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $s_url; ?>&title=ProfessorSurvey"><i class=" icon-renren"></i> RenRen</a>
								</div>
							</div>
							<div class="span12"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>