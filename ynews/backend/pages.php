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
                        <!-- Optionally, you can add icons to the links -->
                        <li>
                            <a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="feeds.php"><i class="fa fa-link"></i> <span>Feeds</span></a>
                        </li>
                        <li class="active">
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
                    <h1>Manage Pages</h1>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">
                    <div class="row"> 
                        <!-- /.col -->                         
                        <div style="padding: 0px 16px;">
                            <!-- /.box -->
                            <div class="box"> 
                                <div class="box-header">
                                    <h3 class="box-title">List of pages</h3>
                                </div>                                 

                                <!-- /.box-header -->                                 

                                <div class="box-body"> 
                                    <div id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div>
                                            <div class="box-header">
                                                <h4 class="box-title"> <a data-toggle="collapse" data-parent="#accordion" href="#1234567890" aria-expanded="false" class="collapsed">
                	About us  </a> </h4>
                                            </div>
                                            <div id="1234567890" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="box-body">
                                                    About us content goes here...
</div>
                                            </div>
                                        </div>
                                    </div>
                                    <form role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="control-label">Add page</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label">Name:</label>
                                                <input class="form-control" id="name" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="content" class="control-label">Content:</label>
                                                <textarea class="form-control" id="content" placeholder="Enter content" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>                                     

                                    <div class="box-body">
                                        <div class="alert alert-danger alert-dismissible">
                                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                            Do you really want to delete page 
                                            <span class="label label-default">About us</span> ?
                                        </div>
                                        <button type="button" class="btn btn-primary">Yes, delete page</button>
                                        <a href="pages.php">
                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                        </a>
                                    </div>
                                </div>                                 

                                <!-- /.box-body -->                                 
                            </div>
                            <!-- /.box -->
                        </div>                         
                        <!-- /.col -->                         
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
        <script>
    $(function() {
    $('[data-toggle="tooltip"]').tooltip();
})
</script>
    </body>
</html>