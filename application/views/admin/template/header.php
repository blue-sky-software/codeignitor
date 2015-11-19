<!-- BEGIN BODY -->
<body class="page-header-fixed page-full-width page-boxed">
    <!-- BEGIN HEADER -->   
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="container">
                <!-- BEGIN LOGO -->
                <a class="brand" href="<?php echo BASEURL?>index.php/admin/manage/usermanage">
                    <img src="<?php echo INCLUDE_DIR ?>/img/logo.png" alt="logo" />
                </a>
                <!-- END LOGO -->
                <!-- BEGIN HORIZANTAL MENU -->
                <div class="navbar hor-menu hidden-phone hidden-tablet">
                    <div class="navbar-inner">
                        <ul class="nav">
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
                                <span></span>
                            </li>
                            <li>
                                <a href="<?php echo BASEURL; ?>index.php/admin/manage/logout">
                                    <strong>Logout</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END HORIZANTAL MENU -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                    <img src="<?php echo INCLUDE_DIR ?>/img/menu-toggler.png" alt="" />
                </a>          
                <!-- END RESPONSIVE MENU TOGGLER -->                                      
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->