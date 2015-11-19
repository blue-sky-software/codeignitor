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
                        Dashboard
                    </a>
                    <span class="selected"></span>
                </li>
                <li class ="btn_survey">
                    <a href="<?php echo BASEURL ?>index.php/mysurvey/index">
                        My Surveys
                    </a>
                    <span></span>
                </li>
                <li>
                    <a href="<?php echo BASEURL ?>index.php/auth/logout">
                        Logout
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
                </div>

                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid margin-bottom-20">
                    <div class="row-fluid ">
                        <div class="row-fluid ">

							<div class ="portlet box span3"></div>
							<form method ="post" id="createSurveyForm" >
								<div class="offset3 portlet box span6 blue">
									<div class="portlet-title">
										<div class="caption"><i class="icon-cogs"></i>Create a new survey...</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
										</div>
									</div>
									<div class="portlet-body" >
										<div class="well well-large  ">
											<div class="alert alert-error hide">
												Please Fill in the folowing field.
											</div>
											<div class="control-group">
												<div class="controls">
													<label class="control-label span3">Survey Title :</label>
													<input type="text" class="span8 "  placeholder="Enter your survey title here." id="createSurveyTitle" name="createSurveyTitle">                       
												</div>
											</div>
											<div class="control-group">
												<div class="controls">
													<label class="control-label span3">Language :</label>
													<select id="languages_select" class=" span3">
														<option value="1">English</option>
														<option value="2">Chinese</option>
														<option value="3">Korean</option>
														<option value="4">Japanese</option>
														<option value="5">Arabic</option>
													</select>
													<div class="controls span9"></div>
													<div class="controls">
														<button type="submit" class="btn green">Create</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>

							<div class ="portlet box span3"></div>
							<form method ="post" id="copySurveyForm" >
								<div class="offset3 portlet box span6 yellow">
									<div class="portlet-title">
										<div class="caption"><i class="icon-cogs"></i>Copy an existing survey...</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
										</div>
									</div>
									<div class="portlet-body" >

										<div class="well well-large  ">
											<div class="alert alert-error hide">
												Please Fill in the folowing field.
											</div>
											<div class="control-group">
												<label class="control-label span3">Survey :</label>
												<div class="controls">
													<select id="survey_select" class=" span8" name="survey_select">
														<?php foreach ($SurveyList as $survey) { ?>
															<option value="<?php echo $survey['sid']; ?>"><?php echo $survey['title']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label span3">Title :</label>
												<div class="controls">
													<input id="copySurveyTitle" type="text" class="span8 "  placeholder="Enter your survey title here." name="copySurveyTitle">
												</div>
												<div class="controls span9"></div>
												<div class="controls">
													<button type="submit" class="btn green">Copy</button>
												</div>
											</div>
										</div>
									</div>							
							</form>

						</div>
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