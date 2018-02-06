<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Y-news - Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
    <body class="hold-transition skin-blue layout-boxed">
        <div class="wrapper"> 
            <!-- Main Header -->             
            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Y</b>-News</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Y</b>-news</span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <!-- /.messages-menu -->
                            <!-- Notifications Menu -->
                            <!-- Tasks Menu -->
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu"> 
                                <!-- Menu Toggle Button -->                                 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <i class="fa fa-user fa-lg"></i>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>                                 
                                <ul class="dropdown-menu">
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>             
            <!-- Left side column. contains the logo and sidebar -->             
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!-- search form (Optional) -->
                    <!-- /.search form -->
                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header text-center">SELECT OPTION</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active">
                            <a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="feeds.php"><i class="fa fa-link"></i> <span>Feeds</span></a>
                        </li>
                        <li>
                            <a href="pages.php"><i class="fa fa-link"></i> <span>Static pages</span></a>
                        </li>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>             
            <!-- Content Wrapper. Contains page content -->             
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Admin dashboard</h1>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">
                    <!--------------------------
        | Your Page Content Here |
        -------------------------->                     
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-3"> 
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-refresh"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Last update</span>
                                    <span class="info-box-number"><small>10:47 pm</small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>                             
                            <!-- /.info-box -->                             
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-feed"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total feeds</span>
                                    <span class="info-box-number">7</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">134</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-share-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Shares</span>
                                    <span class="info-box-number">50</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Update news</h3>
                                </div>
                                <div class="box-body">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-default btn-lrg" onclick="javascript:update_news()">
                                            <i class="fa fa-refresh" id="btn_fetch"></i>&nbsp; Fetch data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>             
            <!-- /.content-wrapper -->             
            <!-- Main Footer -->             
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    Your news always up-to-date
</div>
                <!-- Default to the left -->
                <strong>Copyright © 2018 Y-news.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
        < <script>
            function update_news() {
            $("#btn_fetch").toggleClass("fa-spin")
            // create AJAX request here
            }
</script>
    </body>
</html>