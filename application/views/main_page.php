<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.html">

        <title>OPEX GROUP LTD.</title>
        <!-- Bootstrap core CSS -->
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/owl.carousel.css" type="text/css">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-datepicker/css/datepicker.css"/>
        
        <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/bootstrap-timepicker.min.css" rel="stylesheet" />

         
        
        <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>        
        <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>  
          <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url(); ?>js/html5shiv.js"></script>
          <script src="<?php echo base_url(); ?>js/respond.min.js"></script>
        <![endif]-->
        <script>
            $(document).ready(function() {
                $('.sidebar-menu a').each(function(index) {
                    if (this.href.trim() == window.location) {
                        var classSelected = 'active';
                        $("#dash").removeClass('active');
                        $(this).parent('li').addClass(classSelected).parents('li').addClass('active');;
                    }
                });

            });
        </script>
    </head>
    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
                </div>
                <!--logo start-->
                <a href="<?php echo site_url('con_proc_daily_dashoard_report/view_dashboard_report'); ?>" class="logo">Opex Group</a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- notification dropdown start-->
                        <li id="header_notification_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="icon-bell-alt"></i>
                                <span class="badge bg-important">4</span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-yellow"></div>
                                <li>
                                    <p class="yellow">You have 4 new notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon-bolt"></i></span>
                                        Employee Access Error
                                        <span class="small italic">34 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-warning"><i class="icon-bell"></i></span>
                                        New Employee Inserted
                                        <span class="small italic">1 Hours</span>
                                    </a>
                                </li>                                
                                <li>
                                    <a href="#">
                                        <span class="label label-success"><i class="icon-plus"></i></span>
                                        New user registered.
                                        <span class="small italic">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                        Application error.
                                        <span class="small italic">10 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">See all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- notification dropdown end -->
                    </ul>
                    <!--  notification end -->
                </div>
                <div class="top-nav ">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="photo" style="border-radius: 5px">
                                    <?php
                                    if ($this->session->userdata('Email')) {
                                        echo img('img/' . $this->session->userdata('Image'));
                                    } else {
                                        echo 'unregistered';
                                    }
                                    ?>
                                </span>
                                <span class="username">
                                    <?php
                                    if ($this->session->userdata('Email')) {
                                        echo $this->session->userdata('FirstName') . " " . $this->session->userdata('MiddleName');
                                    } else {
                                        echo 'unregistered';
                                    }
                                    ?>
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <li></li>
                                <li><a href="<?php echo base_url() . "con_set_user_login_info/logout" ?>"><i class="icon-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <?php
            if ($this->session->userdata('Role') == 'Admin') {
                $this->load->view('admin_manu_bar');
            }
            if ($this->session->userdata('Role') == 'Manager') {
                $this->load->view('manager_manu_bar');
            }
            if ($this->session->userdata('Role') == 'Public') {
                $this->load->view('operator_manu_bar');
            }
            ?>
            <!--sidebar end-->
            <!--main content start-->   
            <section id="main-content">
                <section class="wrapper">
                    <!--state overview start-->
                    <?php $this->load->view($container); ?>
                </section>
            </section>
            <!--main content end-->
        </section>


        <!--script for this page--> 
        <script src="<?php echo base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>       
        <script src="<?php echo base_url(); ?>js/owl.carousel.js" ></script>
        <script src="<?php echo base_url(); ?>js/jquery.customSelect.min.js" ></script>
        <script src="<?php echo base_url(); ?>js/common-scripts.js"></script>
      


    </body>
</html>