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
				<li class="btn_surveymanage active">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/surveymanage">
                        <strong>Survey Manage</strong>
					</a>
					<span class="selected"></span>
				</li>
				<li class="btn_config">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/config">
                        <strong>Setting</strong>
					</a>
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
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-coffee"></i>Surveys Table</div>
								<div class="tools">
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Title</th>
											<th>User</th>
											<th>Create Date</th>
											<th>Update Date</th>
											<th>Status</th>
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
						<label id="pageinfo"></label>
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