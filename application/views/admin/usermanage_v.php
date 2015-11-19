<!-- BEGIN CONTAINER -->
<div class="container">
	<div class="page-container " >
		<!-- BEGIN EMPTY PAGE SIDEBAR -->
		<div class="page-sidebar nav-collapse visible-phone visible-tablet collapse" style="height: 0px;">
			<ul class="page-sidebar-menu">

				<li class="btn_usermanage active">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/usermanage">
                        <strong>User Manage</strong>
					</a>
					<span class="selected"></span>
				</li>
				<li class="btn_surveymanage">
					<a href="<?php echo BASEURL; ?>index.php/admin/manage/surveymanage">
                        <strong>Survey Manage</strong>
					</a>
					<span></span>
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
								<div class="caption"><i class="icon-coffee"></i>Administrator List</div>
								<div class="tools">
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>name</th>
											<th>Create Date</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody id="adminlist">
										<?php foreach ($admins as $admin) { ?>
											<tr>
												<td><?php echo $admin[Users_m::EMAIL]; ?></td>
												<td><?php echo $admin[Users_m::CREATE_DATE]; ?></td>
												<td>
													<?php if ($admin[Users_m::ADMIN_PRIV] == Users_m::TOTALADMIN) { ?>
														Total administrator
													<?php } else if ($admin[Users_m::ADMIN_PRIV] == Users_m::NORMALADMIN) { ?>
														administrator
													<?php } ?>
												</td>
												<td>
													<a data-toggle="modal" href="#admin_user_edit_dlg" class="btn green mini modifyBtn" uname="<?php echo $admin[Users_m::EMAIL]; ?>" uid="<?php echo $admin['uid']; ?>">Modify</a>
													<?php if ($admin[Users_m::ADMIN_PRIV] != Users_m::TOTALADMIN && $total_admin == "1") { ?>
														<a class="btn red mini adminDelBtn" uid="<?php echo $admin['uid']; ?>">Delete</a>
													<?php } ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php if ($total_admin == "1") { ?>
							<div class="portlet box " style="float: right; display: block">
								<div class ="control-group">
									<div class="controls">
										<a data-toggle="modal" href="#admin_user_add_dlg" id="createAdmin" class="btn green mini">Create&nbsp;Administrator</a>
									</div>
								</div>
							</div>
						<?php } ?>


						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-coffee"></i>Users List</div>
								<div class="tools">
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>name</th>
											<th>Email</th>
											<th>Create Date</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody id="userlist">
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


<div id="admin_user_add_dlg" class="modal hide fade" tabindex="-1" data-width="600">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3>Create Administrator</h3>
	</div>
	<form method ="post" action="<?php echo BASEURL ?>index.php/admin/manage/add_admin" class="form-horizontal" id="admin_user_add_form">
		<div class="modal-body">
			<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">

					<div class="alert alert-error hide">
						Please Fill in Following Field.
					</div>
					<div class="control-group">
						<label class="control-label">Name</label>
						<div class="controls">
							<input type="text" name="admin_name" placeholder="Input Administrator Name" class="m-wrap large"  id="admin_name"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls">
							<input type="password" name="newPassword" placeholder="Input Password" class="m-wrap large" id="newPassword"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn"  id="cancel">Cancel</button>
			<button type="submit" class="btn green" id="save">Create</button>
		</div>
	</form>
</div>

<div id="admin_user_edit_dlg" class="modal hide fade" tabindex="-1" data-width="600">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3>Edit Administrator</h3>
	</div>
	<form method ="post" action="<?php echo BASEURL ?>index.php/admin/manage/save_admin" class="form-horizontal" id="admin_user_edit_form">
		<div class="modal-body">
			<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">

					<div class="alert alert-error hide">
						Please Fill in Following Field.
					</div>
					<div class="control-group">
						<label class="control-label">Name</label>
						<div class="controls">
							<input type="text" name="admin_name" readonly placeholder="Input Administrator Name" class="m-wrap large"  id="admin_name"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls">
							<input type="password" name="newPassword" placeholder="Input Password" class="m-wrap large" id="newPassword"/>
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

<!-- END CONTAINER -->