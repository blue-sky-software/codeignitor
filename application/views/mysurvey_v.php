<!-- BEGIN CONTAINER -->
<div class="container">
	<div class="page-container " >
		<!-- BEGIN EMPTY PAGE SIDEBAR -->
		<div class="page-sidebar nav-collapse visible-phone visible-tablet collapse" style="height: 0px;">
			<ul class="page-sidebar-menu">

				<li class="btn_dash active">
					<a href="<?php echo BASEURL ?>index.php/dashboard/index">
                        <strong>Dashboard</strong>
					</a>
					<span class="selected"></span>
				</li>
				<li class="btn_survey">
					<a href="<?php echo BASEURL ?>index.php/mysurvey/index">
                        <strong>My Surveys</strong>
					</a>
					<span></span>
				</li>
				<li>
					<a href="<?php echo BASEURL ?>index.php/index.php/auth/logout">
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
					<div class="span6" >
						<div class="portlet box margin-top-20" style="float:right;display: block;">
							<a href="<?php echo BASEURL ?>index.php/create_survey/index" class="btn green">Create New Survey</a>
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid margin-bottom-20">
					<div class="span3">
						<div class="row-fluid">
<!--							<select class="m-wrap">
								<option value="--Listing All Surveys--">--Listing All Surveys--</option>
								<option value="My Surveys">My Surveys</option>
							</select>-->
						</div>
					</div>
					<div class="span3">
						<div class="portlet box">
							<!--<a href="<?php echo BASEURL ?>index.php/mysurvey/index" class="btn yellow ">Manage</a>-->
						</div>
					</div>
					<div class="input-append" style="float:right;">
						<input class="m-wrap" type="text" placeholder="Search Surveys" id="searchkey"><button class="btn yellow" type="button" id="search">Search</button>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN BORDERED TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-coffee"></i>My Surveys Table</div>
								<div class="tools">
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead>
										<tr>
											<th>Status</th>
											<th>Survey Title<button class="btn purple mini" type="button" style="float: right" id="sortbytitle">Sort</button></th>
											<th>Created<button class="btn purple mini" type="button" style="float: right" id="sortbycreated">Sort</button></th>
											<th>Design</th>
											<th>Collect</th>
											<th>Result</th>
											<th>Point</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody id="surveylist">
									</tbody>
								</table>
							</div>
						</div>
						<!-- END BORDERED TABLE PORTLET-->
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<label class="control-label span3">List Size : </label>
						<div class="controls">
							<select id="listsize_sel" class="span3">
								<option value="3">3</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
							</select>
						</div>
					</div>
					<div class="span4">
						<!--<label id="pageinfo">Showing 1-10 of 11</label>-->
					</div>
					<div class="span4 pagination float-right" style="margin-top: 0px; float: right">
						<ul id="pagination_ul">
						</ul>
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

<div id="copy_confirm_dlg" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<form method ="post" id="copy_confirm_form" >
		<div class="modal-body">
			<div class="alert alert-error hide">
				Please Fill in the following field.
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<label class="control-label span12">Survey Title :</label>
					<input type="text" class="span11 "  placeholder="Enter your survey title here." id="createSurveyTitle" name="createSurveyTitle">                       
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Cancel</button>
			<button type="submit" class="action btn red">Copy</button>
			<input type="hidden" class="copy_sid" value=""/>
		</div>
	</form>
</div>

<div id="clear_confirm_dlg" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-body">
		<p>Are you sure you want to clear?</p>
		<p>You will not be able to undo this action!</p>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		<button type="button" data-dismiss="modal" class="action btn red">Clear</button>
		<input type="hidden" class="clear_sid" value=""/>
	</div>
</div>

<div id="del_confirm_dlg" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-body">
		<p>Are you sure you want to delete?</p>
		<p>You will not be able to undo this action!</p>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		<button type="button" data-dismiss="modal" class="action btn red">Delete</button>
		<input type="hidden" class="del_sid" value=""/>
	</div>
</div>
