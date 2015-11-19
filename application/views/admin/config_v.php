<!-- BEGIN CONTAINER -->
<div class="container">
	<div class="page-container " >
		<!-- BEGIN EMPTY PAGE SIDEBAR -->
		<div class="page-sidebar nav-collapse visible-phone visible-tablet collapse" style="height: 0px;">
			<ul class="page-sidebar-menu">

				<li class="btn_usermanage">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/usermanage">
                        <strong>User Manage</strong>
					</a>
					<span></span>
				</li>
				<li class="btn_surveymanage">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/surveymanage">
                        <strong>Survey Manage</strong>
					</a>
				</li>
				<li class="btn_config active">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/config">
                        <strong>Setting</strong>
					</a>
					<span class="selected"></span>
				</li>
				<li>
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/logout">
                        <strong>Logout</strong>
					</a>
				</li>
			</ul>
		</div>
		<!-- END EMPTY PAGE SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span6">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							<?php if (isset($Title)) echo $Title; ?> 
						</h3>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN BORDERED TABLE PORTLET-->
						<form method ="post" id="config_form" action="<?php echo BASEURL."index.php/admin/manage/save_config"?>">
							<div class="alert alert-error hide">
								Please Fill in the following field.
							</div>
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption"><i class="icon-coffee"></i>eMail Setting</div>
									<div class="tools">
									</div>
								</div>
								<div class="portlet-body">
									<div class="row-fluid">
										<div class="offset2 span10">
											<div class ="control-group">
												<div class="controls">
													<label class="span2 controls-label">Subject:</label>
													<div class="text-toggle-button row-fluid">
														<input class="span8 m-wrap" type="text" value="<?php echo $mail->subject; ?>" id="config_subject" name="subject"/>
													</div>
												</div>
											</div>
											<div class ="control-group">
												<div class="controls">
													<label class="span2 controls-label">Message:</label>
													<div class="text-toggle-button row-fluid">
														<textarea class="span8 m-wrap" type="text" id="config_message" name="message" rows ="10"><?php echo $mail->message; ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption"><i class="icon-coffee"></i>Point Count Formula</div>
									<div class="tools">
									</div>
								</div>
								<div class="portlet-body">
									<div class="row-fluid">
										<div class="offset2 span10">
											<div class ="control-group">
												<div class="controls">
													<label class="span5 controls-label">for completing a survey :</label>
													<div class="text-toggle-button row-fluid">
														<input class="span1 m-wrap" type="text" value="<?php echo $point->p1; ?>" id="config_p1" name="p1"/>
													</div>
												</div>
											</div>
											<div class ="control-group">
												<div class="controls">
													<label class="span5 controls-label">point for every 2 results returned from respondents :</label>
													<div class="text-toggle-button row-fluid">
														<input class="span1 m-wrap" type="text" value="<?php echo $point->p2; ?>" id="config_p2" name="p2"/>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class ="form-actions control-group">
								<div class="controls ">
									<div class="span2 offset4">
										<button type="submit" class="btn green">Save&nbsp;Changes</button>
									</div>
								</div>
							</div>
						</form>
						<!-- END BORDERED TABLE PORTLET-->
					</div>
				</div>

				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER--> 
		</div>
		<!-- END PAGE -->    
	</div>
</div>
<!-- END CONTAINER -->