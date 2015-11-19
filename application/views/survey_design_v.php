
<div class="row-fluid ">
	<div class="portlet box " style="float: right; display: block">
		<div class ="control-group">
			<div class="controls">
				<a href="<?php echo BASEURL; ?>index.php/surveyview/s/<?php if (isset($SID)) echo $SID; ?>/0?preview=true" target="_blank" class="btn green">Preview&nbsp;Survey<i class="m-icon-swapright m-icon-white"></i></a>
			</div>
		</div>
	</div>
</div>
<?php
$page_no = 0;
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><?php echo++$page_no; ?>. Welcome Page</div>
		<div class="actions">
			<?php if (true) { ?>
				<a data-toggle="modal"  href="#welcome_dlg" class="btn green mini"><i class="icon-pencil"></i> Edit</a>
			<?php } ?>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row-fluid">
			<div class="offset1 control-group span10">
				<div class="span12"></div>
				<div>
					<h3 class="offset3"><strong><?php echo $welcome_title; ?></strong> </h3>
				</div>
				<div>
					<label class="offset3"><?php echo $welcome_content; ?></label>
				</div>
				<div class="span12"></div>
			</div>
		</div>
	</div>
</div>

<?php
foreach ($Pages as $page) {
	$page_no++;
	?>
	<div>
		<?php if (true) { ?>
			<a data-toggle="modal"  href="#pageDlg" src="<?php echo BASEURL; ?>index.php/surveyedit/insertpage/<?php if (isset($SID)) echo $SID; ?>/<?php echo $page['pid']; ?>" class="pageDlgRequire btn blue mini" ><i class="icon-plus"></i> Insert Page Here</a>
		<?php } ?>
	</div>
	<div class="span12"></div>
	<div class="portlet box grey">
		<div class="portlet-title">
			<div class="caption"><?php echo $page_no . ". " . $page['title']; ?></div>
			<div class="actions">
				<?php if (true) { ?>
					<a data-toggle="modal"  href="#pageDlg" src="<?php echo BASEURL; ?>index.php/surveyedit/editpage/<?php if (isset($SID)) echo $SID; ?>/<?php echo $page['pid']; ?>" class="pageDlgRequireEdit btn green mini"><i class="icon-pencil"></i> Edit</a>
					<input type="hidden" id="page_title<?php echo $page_no; ?>" value="<?php echo $page['title']; ?>"/>
					<input type="hidden" id="page_desc<?php echo $page_no; ?>" value="<?php echo $page['description']; ?>"/>
					<a data-toggle="modal"  href="#del_confirm_dlg" src="<?php echo BASEURL; ?>index.php/surveyedit/delpage/<?php if (isset($SID)) echo $SID; ?>/<?php echo $page['pid']; ?>" class="del_confirm_dlg_require btn red mini"><i class="icon-remove"></i> Delete</a>
				<?php } ?>
			</div>
		</div>
		<div class="portlet-body">
			<div class="row-fluid">
				<div class="offset1 control-group span10">
					<div class="span12">
						<label class="offset1"><?php echo $page['description']; ?></label>
					</div>
					<div class="span12">
					</div>

					<?php
					if (sizeof($page['questions']) == 0) {
						?>
						<div class="span12">
							<label class="offset4">This page is empty. Why not add a question?</label>
						</div>
						<div class="span12"></div>
						<div>
							<?php if (true) { ?>
								<a class="qDlgRequire offset5 btn blue" src="<?php echo BASEURL; ?>index.php/question/add_question/<?php echo $page['pid']; ?>"><i class="icon-plus"></i> Add Question</a>
							<?php } ?>
						</div>
						<div class="span12"></div>
						<?php
					} else {
						$q_no = 0;
						foreach ($page['questions'] as $question) {
							$q_no++;
							?>
							<div>
								<?php if (true) { ?>
									<a class="qDlgRequire btn blue mini" src="<?php echo BASEURL; ?>index.php/question/insert_question/<?php echo $page['pid']; ?>/<?php echo $question['qid']; ?>"><i class="icon-plus"></i> Insert Here</a>
								<?php } ?>
							</div>
							<div class="span12"></div>
							<div class="portlet box yellow">
								<div class="portlet-title">
									<div class="caption">Question<?php echo $q_no; ?></div>
									<?php if (true) { ?>
										<div class="actions">
											<?php if (sizeof($page['questions']) > 1) { ?>
												<?php if ($q_no != 1) { ?>
													<a href="<?php echo BASEURL; ?>index.php/question/move_question/up/<?php if (isset($SID)) echo $SID; ?>/<?php echo $question['qid']; ?>" class="btn icn-only blue mini"><i class="icon-long-arrow-up m-icon-white"></i></a>
												<?php } ?>
												<?php if ($q_no < sizeof($page['questions'])) { ?>
													<a href="<?php echo BASEURL; ?>index.php/question/move_question/down/<?php if (isset($SID)) echo $SID; ?>/<?php echo $question['qid']; ?>" class="btn icn-only blue mini"><i class="icon-long-arrow-down m-icon-white"></i></a>
												<?php } ?>
											<?php } ?>
											<a class="qDlgRequireEdit btn green mini" src="<?php echo BASEURL; ?>index.php/question/save_question/<?php echo $question['qid']; ?>"><i class="icon-pencil"></i> Edit</a>
											<input type="hidden" value="<?php echo $question['qid']; ?>"/>
											<a href="<?php echo BASEURL; ?>index.php/question/copy_question/<?php if (isset($SID)) echo $SID; ?>/<?php echo $question['qid']; ?>" class="btn purple mini"><i class="icon-plus"></i> Copy</a>
											<a data-toggle="modal"  href="#del_confirm_dlg" src="<?php echo BASEURL; ?>index.php/question/del_question/<?php if (isset($SID)) echo $SID; ?>/<?php echo $question['qid']; ?>" class="del_confirm_dlg_require btn red mini"><i class="icon-remove"></i> Delete</a>
										</div>
									<?php } ?>
								</div>
								<div class="portlet-body">
									<div class="row-fluid">
										<div class="offset1 control-group span10">
											<div class="span12"></div>
											<div class="controls">
												<h4 class="control-label span12" ><?php echo $question['question']; ?></h4>
											</div>
											<div class="controls">
												<?php echo $question['question_html']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php
						}
						?>
						<div>
							<?php if (true) { ?>
								<a data-toggle="modal"  href="#questionDlg" class="qDlgRequire btn blue mini" src="<?php echo BASEURL; ?>index.php/question/add_question/<?php echo $page['pid']; ?>"><i class="icon-plus"></i> Insert Here</a>
							<?php } ?>
						</div>
						<?php
					}
					?>



				</div>
			</div>
		</div>
	</div>

	<?php
}
?>

<div>
	<?php if (true) { ?>
		<a data-toggle="modal"  href="#pageDlg" src="<?php echo BASEURL; ?>index.php/surveyedit/addpage/<?php if (isset($SID)) echo $SID; ?>" class="pageDlgRequire btn blue mini" ><i class="icon-plus"></i> Insert Page Here</a>
	<?php } ?>
</div>
<div class="span12"></div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><?php echo++$page_no; ?>. Thank you Page</div>
		<div class="actions">
			<?php if (true) { ?>
				<a data-toggle="modal"  href="#thank_dlg" class="btn green mini"><i class="icon-pencil"></i> Edit</a>
			<?php } ?>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row-fluid">
			<div class="offset1 control-group span10">
				<div class="span12"></div>
				<div>
					<h3 class="offset3"><strong><?php echo $thankyou_title; ?></strong> </h3>
				</div>
				<div>
					<label class="offset3"><?php echo $thankyou_content; ?></label>
				</div>
				<div class="span12"></div>
			</div>
		</div>
	</div>
</div>

<div id="del_confirm_dlg" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-body">
		<p>Are you sure you want to delete?</p>
		<p>You will not be able to undo this action!</p>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		<button type="button" data-dismiss="modal" class="delAction btn red">Delete</button>
		<input type="hidden" id="del_action_url" value=""/>
	</div>
</div>

<div id="pageDlg" class="modal hide fade" tabindex="-1" data-width="600">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3 id="pageDlgCaption">Add Page</h3>
	</div>
	<form method ="post" id="pageDlgForm" >
		<div class="modal-body">
			<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="alert alert-error hide">
						Please Fill in the following field.
					</div>
					<div class="control-group">
						<label class="control-label span3">Page Title :</label>
						<div class="controls">
							<input type="text" class="span12"  id="pageTitle" name="pageTitle">                       
						</div>
					</div>
					<div class="control-group">
						<label class="control-label span3">Page Description :</label>
						<div class="controls">
							<textarea class="span12" id="pageDescription" rows="10" name="pageDescription"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn"  id="cancelPage" style="display: none">Close</button>
			<button type="submit" class="btn green">Save Page</button>
			<input type="hidden" id="savePage_url"/>
		</div>
	</form>
</div>

<div id="welcome_dlg" class="modal hide fade" tabindex="-1" data-width="600">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3 id="dlg_caption">Start Page Text</h3>
	</div>
	<form method ="post" id="welcome_form" >
		<div class="modal-body">
			<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="alert alert-error hide">
						Please Fill in the following field.
					</div>
					<div class="control-group">
						<label class="control-label span3">HeadingText :</label>
						<div class="controls">
							<input type="text" class="span12"  id="title" name="title" value="<?php echo $welcome_title; ?>">                       
						</div>
					</div>
					<div class="control-group">
						<label class="control-label span3">Welcome Text :</label>
						<div class="controls">
							<textarea class="span12" id="content" rows="7" name="content"><?php echo $welcome_content; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn green">Save</button>
		</div>
	</form>
</div>

<div id="thank_dlg" class="modal hide fade" tabindex="-1" data-width="600">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"  id="closePage"></button>
		<h3 id="dlg_caption">Final Page Text</h3>
	</div>
	<form method ="post" id="thankyou_form" >
		<div class="modal-body">
			<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="alert alert-error hide">
						Please Fill in the following field.
					</div>
					<div class="control-group">
						<label class="control-label span3">HeadingText :</label>
						<div class="controls">
							<input type="text" class="span12"  id="title" name="title" value="<?php echo $thankyou_title; ?>">                       
						</div>
					</div>
					<div class="control-group">
						<label class="control-label span3">Thank you Text :</label>
						<div class="controls">
							<textarea class="span12" id="content" rows="7" name="content"><?php echo $thankyou_content; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn green">Save</button>
		</div>
	</form>
</div>
