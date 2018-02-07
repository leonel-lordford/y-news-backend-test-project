<?php
include 'database.php';

$mysql = database_open();
if (mysqli_connect_errno($mysql)) {
    die("Failed to connect to Database Server, please try again later.");
}

?>
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
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue layout-boxed">
        <div class="wrapper"> 
            <header class="main-header">
                <a href="index2.html" class="logo">
                    <span class="logo-mini"><b>Y</b>-News</span>
                    <span class="logo-lg"><b>Y</b>-news</span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu"> 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user fa-lg"></i>
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>                                 
                                <ul class="dropdown-menu">
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>             
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="active">
                            <a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="feeds.php"><i class="fa fa-link"></i> <span>Feeds</span></a>
                        </li>
                        <li>
                            <a href="pages.php"><i class="fa fa-link"></i> <span>Static pages</span></a>
                        </li>
                        <li>
                            <a href="categories.php"><i class="fa fa-link"></i> <span>Categories</span></a>
                        </li>
                        <li>
                            <a href="users.php"><i class="fa fa-link"></i> <span>Users</span></a>
                        </li>
                    </ul>
                </section>
            </aside>             
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>General status</h1>
                </section>
                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-3"> 
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-refresh"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Last update</span>
                                    <span class="info-box-number"><small>10:47 pm</small></span>
                                </div>
                            </div>                             
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-feed"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total feeds</span>
                                    <span class="info-box-number">7</span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">134</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-share-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Shares</span>
                                    <span class="info-box-number">50</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center col-md-4 col-md-offset-4">
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
            </div>             
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    Your news always up-to-date
                </div>
                <strong>Copyright &copy; 2018 Y-news.</strong> All rights reserved.
            </footer>
        </div>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="dist/js/adminlte.min.js"></script>
        <script>
            function update_news() {
            $("#btn_fetch").toggleClass("fa-spin")
            // create AJAX request here
            }
        </script>
    </body>
</html>
<?php 
database_close($mysql);
?>
