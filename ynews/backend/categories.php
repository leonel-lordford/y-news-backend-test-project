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
    if(isset($_GET['action']) && trim($_GET['action']) == "remove" && isset($_GET['category']) && trim($_GET['category'])) {
        $query = "DELETE FROM ynews.categories WHERE `uuid`='". $_GET['category']. "'";
        $category = mysqli_query($mysql, $query);

        if($category) {
            $success = 1;
            $action = $_GET['action'];
        }
    }
    else {
        if(isset($_POST['name']) && trim($_POST['name'])) {
            $name = $_POST['name'];

            switch ($_GET['action']) {
                case 'add':
                    $uuid = random_int(RAND_MIN, RAND_MAX);
                    $query = "INSERT INTO ynews.categories (`name`, `uuid`) VALUES ('". $name ."', '". $uuid ."')";
                    $category = mysqli_query($mysql, $query);
        
                    if($category) {
                        $success = 1;
                        $action = $_GET['action'];
                    }
                break;
                case 'edit':
                    $query = "UPDATE ynews.categories SET `name`='". $name ."' WHERE `uuid`='". $_GET['category'] ."'";
                    $category = mysqli_query($mysql, $query);
        
                    if($category) {
                        $success = 1;
                        $action = $_GET['action'];
                    }
                break;
            }
        }
        else {
            $errors = 1;
        }
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

            <?php define('ACTIVE', 'categories'); include 'header.php'; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Manage Categories</h1>
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
                                        $msg = "Category added.";
                                    break;
                                    case 'edit':
                                        $msg = "Category updated.";
                                    break;
                                    case 'remove':
                                        $msg = "Category removed.";
                                    break;
                                }
                                if($msg == "Category removed.") {
                                    echo '
                                        <div class="box-body">
                                            <div class="alert alert-success alert-dismissible">
                                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                                '. $msg . '
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="categories.php">
                                                <button type="button" class="btn btn-default">Go to categories</button>
                                            </a>
                                        </div>
                                    ';
                                }
                                else {
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
                            }
                            if(isset($_GET["action"]) && empty($_GET["action"]) == false) {
                                switch ($_GET["action"]) {
                                    case 'add':
                                        echo '
                                            <div class="box-header">
                                                <h3 class="box-title">Add category</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Name:</label>
                                                            <input class="form-control" id="name" name="name" placeholder="Enter name">
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="categories.php">
                                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        ';
                                    break;
                                    case 'edit':
                                        $result = mysqli_query($mysql, "SELECT `name` FROM ynews.categories WHERE `uuid`='". $_GET['category'] ."'");
                                        $row = mysqli_fetch_assoc($result);
                                        echo '
                                            <div class="box-header">
                                                <h3 class="box-title">Edit category</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Name:</label>
                                                            <input class="form-control" id="name" name="name" placeholder="Enter name" value="'. $row['name'] .'">
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="categories.php">
                                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        ';
                                    break;
                                    case 'remove':
                                        if($success == false) {
                                            $result = mysqli_query($mysql, "SELECT `name` FROM ynews.categories WHERE `uuid`='". $_GET['category'] ."'");
                                            $row = mysqli_fetch_assoc($result);
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Remove category</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                        Do you really want to delete category 
                                                        <span class="label label-default">'. $row['name'] .'</span> ?
                                                    </div>
                                                    <form role="form" method="post">
                                                        <input type="hidden" name="action" value="">
                                                        <button type="submit" class="btn btn-primary">Yes, delete category</button>
                                                        <a href="categories.php">
                                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                        </a>
                                                    </form>
                                                </div>
                                            ';
                                        }
                                    break;
                                }
                            }
                            else {
                                echo '
                                <div class="box-header">
                                    <h3 class="box-title">List of categories</h3>
                                </div>
                                <div class="box-body">
                                    <a href="categories.php?action=add">
                                        <button type="button" class="btn btn-primary">Add category</button>
                                    </a>
                                    <hr/>
                                    <table class="table table-striped"> 
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th style="width: 80px">&nbsp;</th>
                                            </tr>';
                                            $result = mysqli_query($mysql, "SELECT `name`, `uuid` FROM ynews.categories");
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo '
                                                    <tr>
                                                        <td>'. $row['name'] .'</td>
                                                        <td class="text-center"> 
                                                            <a href="categories.php?action=edit&category='. $row['uuid'] .'" data-toggle="tooltip" title="Edit category"><i class="fa fa-edit fa-lg"></i></a>
                                                            <a href="categories.php?action=remove&category='. $row['uuid'] .'" data-toggle="tooltip" title="Remove category"><i class="fa-fw fa-lg fa fa-trash-o"></i></a>
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
