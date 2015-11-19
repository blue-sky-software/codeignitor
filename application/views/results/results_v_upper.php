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

                        <div class="span12">
                            <!-- BEGIN TAB PORTLET-->   
                            <div class="portlet box green tabbable">
                                <div class="portlet-title">
                                    <div class="caption"><i class="icon-reorder"></i></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable portlet-tabs">
                                        <ul class="nav nav-tabs">
                                            <li class="active" ><a href="#result" data-toggle="tab"><strong>Results</strong></a></li>
                                            <li id="tab_collect" sid="<?php echo $SID; ?>"><a href="#collect" data-toggle="tab"><strong>Collect</strong></a></li>
                                            <li id="tab_design" sid="<?php echo $SID; ?>"><a href="#design" data-toggle="tab"><strong>Design</strong></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane " id="design">
												afasdfasdfadsf
                                            </div>
                                            <div class="tab-pane" id="collect">
                                            </div>
                                            <div class="tab-pane active" id="result">