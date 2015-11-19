<!-- BEGIN CONTAINER -->
<div class="container">
    <div class="page-container " >
        <!-- BEGIN EMPTY PAGE SIDEBAR -->
        <div class="page-sidebar nav-collapse visible-phone visible-tablet collapse" style="height: 0px;">
            <ul class="page-sidebar-menu">
                <!--				<li class="visible-phone visible-tablet">
                                     BEGIN RESPONSIVE QUICK SEARCH FORM 
                                    <form class="sidebar-search">
                                        <div class="input-box">
                                            <a href="javascript:;" class="remove"></a>
                                            <input type="text" placeholder="Search...">            
                                            <input type="button" class="submit" value=" ">
                                        </div>
                                    </form>
                                     END RESPONSIVE QUICK SEARCH FORM 
                                </li>-->

                <li class="btn_dash active">
                    <a href="<?php echo BASEURL ?>index.php/dashboard/index">
                        <strong>Dashboard</strong>
                    </a>
                    <span class="selected"></span>
                </li>
                <li class ="btn_survey">
                    <a href="<?php echo BASEURL ?>index.php/mysurvey/index">
                        <strong>My Surveys</strong>
                    </a>
                    <span></span>
                </li>
                <li>
                    <a href="<?php echo BASEURL ?>index.php/auth/logout">
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
                        <h3 class="page-title">
							<?php if (isset($Title)) echo $Title; ?> 
                        </h3>
                    </div>
					<!--                    <div class="span6">
											<div class="portlet box margin-top-20" style="float:right;display: block;">
												<a href="<?php echo BASEURL ?>index.php/surveyedit/index" class="btn green">Create New Survey</a>
											</div>
										</div>-->
                </div>

                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid margin-bottom-20">
                    <div class="well well-large span8 ">
                        <div class="span6">
                            <div class="portlet box">
                                <a class="btn yellow big" href="<?php echo BASEURL ?>index.php/mysurvey/index" ><strong>My Surveys</strong><i class="m-icon-big-swapright m-icon-white"></i></a>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="portlet box">
                                <a class="btn yellow big" href="<?php echo BASEURL ?>index.php/create_survey/index" ><strong>Create a Survey</strong><i class="m-icon-big-swapright m-icon-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class =" span4">
                        <div class="pricing hover-effect">
                            <div class="pricing-head">
                                <h3>My Account </h3>
                            </div>
                            <ul class="pricing-content unstyled">
                                <li><label>User:</label><label><strong><?php echo $userName; ?></strong></label></li>
                                <li><label>Account Number:</label><label><strong><?php echo $Number; ?></strong></label></li>
                                <li><label>Account E-mail:</label><label><strong><?php echo $eMail; ?></strong></label></li>
								<!--                                <li><label>Monthly Responses:</label>
																	<div><a class="btn green">100</a><a class="btn grey">100</a></div>
																</li>-->
                                <li><i class="icon-asterisk"></i><a data-toggle="modal" href="#accountInfoDlg">Account Detail</a></li>
                                <li><i class="icon-tags"></i><a data-toggle="modal" href="#changePasswordDlg">Change Password</a></li>
                            </ul>
                        </div>
                        </span>    

                    </div>

                    <!-- END PAGE CONTENT-->
                </div>
                <!-- END PAGE CONTAINER--> 
            </div>
            <!-- END PAGE -->    
        </div>
    </div>
    <!-- END CONTAINER -->
	
	<div id="accountInfoDlg" class="modal hide fade" tabindex="-1" data-width="760">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
			<h3>Account Info</h3>
		</div>
		<form method ="post" class="form-horizontal" id="accountInfoForm">
			<div class="modal-body">
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
					<div class="row-fluid">

						<div class="alert alert-error hide">
							Please Fill in following filed.
						</div>	

						<div class="control-group">
							<label class="control-label">Full Name</label>
							<div class="controls">
								<input type="text" name="fullName" class="m-wrap large" id="fullName" value="<?php echo $fullName; ?>"/>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="email" class="m-wrap large" id="email" value="<?php echo $email; ?>"/>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Survey Response</label>
							<div class="controls">
								<input type="text" name="surveyResponse" readonly class="m-wrap large" id="surveyResponse" value="<?php echo $response; ?>"/>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Survey Taken</label>
							<div class="controls">
								<input type="text" name="surveyTaken" readonly class="m-wrap large" id="surveyTaken" value="<?php echo $taken; ?>"/>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn green"  id="cancel">Close</button>
				<!--<button type="submit" class="btn green">Save</button>-->
			</div>
		</form>
	</div>
	
	
	<div id="changePasswordDlg" class="modal hide fade" tabindex="-1" data-width="760">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
			<h3>Change Password</h3>
		</div>
		<form method ="post" action="<?php echo BASEURL ?>index.php/auth/change_password" class="form-horizontal" id="changePasswordForm">
			<div class="modal-body">
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
					<div class="row-fluid">

						<div class="alert alert-error hide">
							Old Password is incorrected.
						</div>	
						<div class="alert alert-success hide">
							<button class="close" data-dismiss="alert"></button>
							Change Password is successful!
						</div>
						<div class="control-group">
							<label class="control-label">Old Password</label>
							<div class="controls">
								<input type="password" name="oldPassword" placeholder="Input Old Password" class="m-wrap medium" id="oldPassword"/>
								<!--<span class="help-inline">Some hint here</span>-->
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">New Password</label>
							<div class="controls">
								<input type="password" name="newPassword" placeholder="Input New Password" class="m-wrap medium" id="newPassword"/>
								<!--<span class="help-inline">Some hint here</span>-->
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Confirm Password</label>
							<div class="controls">
								<input type="password" name="confirmPassword" placeholder="Input Confirm Password" class="m-wrap medium" id=confirmPassword"/>
								<!--<span class="help-inline">Some hint here</span>-->
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn"  id="cancel">Cancel</button>
				<button type="submit" class="btn green" id="save">Save</button>
			</div>
		</form>
	</div>