<?php
include 'database.php';

$mysql = database_open();
if (mysqli_connect_errno($mysql)) {
    die("Failed to connect to Database Server, please try again later.");
}

// used for showing messages to user
$errors = 0;
$success = 0;
$action = 0;

if(isset($_POST) && empty($_POST) == false) {
    if(isset($_POST['name']) && trim($_POST['name']) && isset($_POST['category']) && trim($_POST['category']) && 
        isset($_POST['url']) && trim($_POST['url'])) {
        // get correct category
        $category = 0;
        $result = mysqli_query($mysql, "SELECT `id_categories` FROM ynews.categories WHERE `uuid` = '". $_POST['category'] ."'");
        if($result->num_rows) {
            $row = mysqli_fetch_assoc($result);
            $category = $row['id_categories'];
        }

        if($category) {
            $name = $_POST['name'];
            $source = $_POST['url'];
            $uuid = random_int(RAND_MIN, RAND_MAX);
            $query = "INSERT INTO ynews.feeds (`name`, `source`, `categories_id_categories`, `uuid`) VALUES ('". $name ."', '". $source ."', '". $category ."', '". $uuid ."')";
            $feed = mysqli_query($mysql, $query);

            if($feed) {
                $success = 1;
                $action = $_GET['action'];
            }
        }
    }
    else {
        $errors = 1;
    }
}
?>
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
                            if($errors) {
                                echo '
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                        Errors detected, please fill in all the fields.
                                    </div>
                                </div>
                                ';
                            }
                            if($success) {
                                $msg = "";
                                switch ($action) {
                                    case 'add':
                                        $msg = "Feed added.";
                                    break;
                                }
                                echo '
                                <div class="box-body">
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                                        '. $msg . '
                                    </div>
                                </div>
                                ';
                            }
                            if(isset($_GET["action"]) && empty($_GET["action"]) == false) {
                                switch ($_GET["action"]) {
                                    case 'add':
                                        echo '
                                            <div class="box-header">
                                                <h3 class="box-title">Add feed</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Name:</label>
                                                            <input class="form-control" id="name" name="name" placeholder="Enter name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Category:</label>
                                                            <select class="form-control" id="category" name="category">';
                                                            $result = mysqli_query($mysql, "SELECT `name`, `uuid` FROM ynews.categories");
                                                            while($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='". $row['uuid'] ."'>". $row['name'] ."</option>";
                                                            }
                                                            echo '</select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="url" class="control-label">URL:</label>
                                                            <input class="form-control" id="url" name="url" placeholder="Enter url">
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
                                    <a href="feeds.php?action=add">
                                        <button type="button" class="btn btn-primary">Add feed</button>
                                    </a>
                                    <hr/>
                                    <table class="table table-striped"> 
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>URL</th>
                                                <th style="width: 80px">Download</th>
                                                <th style="width: 80px">&nbsp;</th>
                                            </tr>';
                                            $result = mysqli_query($mysql, "SELECT `feeds`.`name`, `feeds`.`source`, `categories`.`name` as cat, `feeds`.`uuid` FROM ynews.feeds inner join ynews.categories ON `feeds`.`categories_id_categories` = `categories`.`id_categories`");
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo '
                                                    <tr>
                                                        <td>'. $row['name'] .'</td>
                                                        <td>'. $row['cat'] .'</td>
                                                        <td>
                                                            <a href="'. $row['source'] .'" target="blank">'. $row['source'] .'</a>
                                                        </td>
                                                        <td class="text-center"> 
                                                            <a href="feeds.php?action=cvs&feed='. $row['uuid'] .'" data-toggle="tooltip" title="CSV"><i class="fa fa-lg fa-download"></i></a>
                                                            <a href="feeds.php?action=json&feed='. $row['uuid'] .'" data-toggle="tooltip" title="JSON"><i class="fa-fw fa-lg fa fa-arrow-circle-down"></i></a>
                                                        </td>
                                                        <td class="text-center"> 
                                                            <a href="feeds.php?action=edit&feed='. $row['uuid'] .'" data-toggle="tooltip" title="Edit feed"><i class="fa fa-edit fa-lg"></i></a>
                                                            <a href="feeds.php?action=remove&feed='. $row['uuid'] .'" data-toggle="tooltip" title="Remove feed"><i class="fa-fw fa-lg fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                            echo '</tbody>                                         
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
