<!DOCTYPE html>
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
                        <li>
                            <a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="active">
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
                    <h1>Manage Feeds</h1>
                </section>
                <section class="content container-fluid">
                    <div class="row"> 

                        <div style="padding: 0px 16px;">
                            <div class="box">
                                <?php
                                if(isset($_GET["action"]) && empty($_GET["action"]) == false) {
                                    switch ($_GET["action"]) {
                                        case 'add':
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Add feed</h3>
                                                </div>
                                                <div class="box-body">
                                                    <form role="form">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="name" class="control-label">Name:</label>
                                                                <input class="form-control" id="name" placeholder="Enter name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Category:</label>
                                                                <select class="form-control">
                                                                    <option value="10">Sports</option>
                                                                    <option value="10">Health</option>
                                                                    <option value="10">Politics</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="url" class="control-label">URL:</label>
                                                                <input class="form-control" id="url" placeholder="Enter url" value="https://news.yahoo.com/sports">
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                        <div class="box-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <a href="feeds.php">
                                                                <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            ';
                                        break;
                                        case 'edit':
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Edit feed</h3>
                                                </div>
                                                <div class="box-body">
                                                    <form role="form">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="name" class="control-label">Name:</label>
                                                                <input class="form-control" id="name" placeholder="Enter name" value="Yahoo sports">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Category:</label>
                                                                <select class="form-control">
                                                                    <option value="10">Sports</option>
                                                                    <option value="10">Health</option>
                                                                    <option value="10">Politics</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="url" class="control-label">URL:</label>
                                                                <input class="form-control" id="url" placeholder="Enter url" value="https://news.yahoo.com/sports">
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                        <div class="box-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <a href="feeds.php">
                                                                <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            ';
                                        break;
                                        case 'remove':
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Remove feed</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                        Do you really want to delete feed 
                                                        <span class="label label-default">Yahoo sports</span> ?
                                                    </div>
                                                    <button type="button" class="btn btn-primary">Yes, delete feed</button>
                                                    <a href="feeds.php">
                                                        <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                    </a>
                                                </div>
                                            ';
                                        break;
                                    }
                                }
                                else {
                                    echo '
                                    <div class="box-header">
                                        <h3 class="box-title">List of feeds</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-striped"> 
                                            <tbody>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>URL</th>
                                                    <th style="width: 80px">Download</th>
                                                    <th style="width: 80px">&nbsp;</th>
                                                </tr>
                                                <tr>
                                                    <td>Yahoo sports</td>
                                                    <td>Sports</td>
                                                    <td>
                                                        <a href="https://news.yahoo.com/sports" target="blank">https://news.yahoo.com/sports</a>
                                                    </td>
                                                    <td class="text-center"> 
                                                        <a href="feeds.php?action=cvs&feed=1234567890" data-toggle="tooltip" title="CSV"><i class="fa fa-lg fa-download"></i></a>
                                                        <a href="feeds.php?action=json&feed=1234567890" data-toggle="tooltip" title="JSON"><i class="fa-fw fa-lg fa fa-arrow-circle-down"></i></a>
                                                    </td>
                                                    <td class="text-center"> 
                                                        <a href="feeds.php?action=edit&feed=1234567890" data-toggle="tooltip" title="Edit feed"><i class="fa fa-edit fa-lg"></i></a>
                                                        <a href="feeds.php?action=remove&feed=1234567890" data-toggle="tooltip" title="Remove feed"><i class="fa-fw fa-lg fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>                                         
                                        </table>
                                    </div>
                                ';
                                }
                                ?>
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
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            })
        </script>
    </body>
</html>
