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
    if(isset($_GET['action']) && trim($_GET['action']) == "remove" && isset($_GET['page']) && trim($_GET['page'])) {
        $query = "DELETE FROM ynews.static_pages WHERE `uuid`='". $_GET['page']. "'";
        $page = mysqli_query($mysql, $query);

        if($page) {
            $success = 1;
            $action = $_GET['action'];
        }
    }
    else {
        if(isset($_POST['title']) && trim($_POST['title']) && isset($_POST['content']) && trim($_POST['content'])) {
            $title = $_POST['title'];
            $content = strip_tags($_POST['content']);

            switch ($_GET['action']) {
                case 'add':
                    $uuid = random_int(RAND_MIN, RAND_MAX);
                    $query = "INSERT INTO ynews.static_pages (`title`, `content`, `uuid`) VALUES ('". $title ."', '". $content ."', '". $uuid ."')";
                    $page = mysqli_query($mysql, $query);
        
                    if($page) {
                        $success = 1;
                        $action = $_GET['action'];
                    }
                break;
                case 'edit':
                    $query = "UPDATE ynews.static_pages SET `title`='". $title ."', `content`='". $content ."' WHERE `uuid`='". $_GET['page'] ."'";
                    $page = mysqli_query($mysql, $query);
        
                    if($page) {
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

            <?php define('ACTIVE', 'pages'); include 'header.php'; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Manage Pages</h1>
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
                                        $msg = "Page added.";
                                    break;
                                    case 'edit':
                                        $msg = "Page updated.";
                                    break;
                                    case 'remove':
                                        $msg = "Page removed.";
                                    break;
                                }
                                if($msg == "Page removed.") {
                                    echo '
                                        <div class="box-body">
                                            <div class="alert alert-success alert-dismissible">
                                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                                '. $msg . '
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="pages.php">
                                                <button type="button" class="btn btn-default">Go to pages</button>
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
                                                <h3 class="box-title">Add page</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label">Title:</label>
                                                            <input class="form-control" id="name" name="title" placeholder="Enter title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="content" class="control-label">Content:</label>
                                                            <textarea class="form-control" id="content" name="content" rows=5 placeholder="Enter content"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="pages.php">
                                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        ';
                                    break;
                                    case 'edit':
                                        $result = mysqli_query($mysql, "SELECT `title`, `content` FROM ynews.static_pages WHERE `uuid`='". $_GET['page'] ."'");
                                        $row = mysqli_fetch_assoc($result);
                                        echo '
                                            <div class="box-header">
                                                <h3 class="box-title">Edit page</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label">Title:</label>
                                                            <input class="form-control" id="name" name="title" placeholder="Enter title" value="'. $row['title'] .'">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="content" class="control-label">Content:</label>
                                                            <textarea class="form-control" id="content" name="content" rows=5 placeholder="Enter content">'. $row['content'] .'</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="pages.php">
                                                            <button type="button" class="btn btn-default text-left pull-right">Cancel</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        ';
                                    break;
                                    case 'remove':
                                        if($success == false) {
                                            $result = mysqli_query($mysql, "SELECT `title` FROM ynews.static_pages WHERE `uuid`='". $_GET['page'] ."'");
                                            $row = mysqli_fetch_assoc($result);
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Remove page</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                        Do you really want to delete category 
                                                        <span class="label label-default">'. $row['title'] .'</span> ?
                                                    </div>
                                                    <form role="form" method="post">
                                                        <input type="hidden" name="action" value="">
                                                        <button type="submit" class="btn btn-primary">Yes, delete page</button>
                                                        <a href="pages.php">
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
                                        <h3 class="box-title">List of pages</h3>
                                    </div>
                                    <div class="box-body">
                                        <a href="pages.php?action=add">
                                            <button type="button" class="btn btn-primary">Add page</button>
                                        </a>
                                        <hr/>
                                        <div id="accordion">
                                        ';
                                        $result = mysqli_query($mysql, "SELECT `title`, `content`, `uuid` FROM ynews.static_pages");
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                                <div>
                                                    <div class="box-header">
                                                        <h4 class="box-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#'. $row['uuid'] .'" aria-expanded="false" class="collapsed">
                                                            '. $row['title'] .'
                                                            </a>
                                                        </h4>
                                                        <div class="pull-right">
                                                            <a href="pages.php?action=edit&page='. $row['uuid'] .'" data-toggle="tooltip" title="Edit page"><i class="fa fa-edit fa-lg"></i></a>
                                                            <a href="pages.php?action=remove&page='. $row['uuid'] .'" data-toggle="tooltip" title="Remove page"><i class="fa-fw fa-lg fa fa-trash-o"></i></a>
                                                        </div>
                                                    </div>
                                                    <div id="'. $row['uuid'] .'" class="panel-collapse collapse" aria-expanded="false">
                                                        <div class="box-body">
                                                            '. $row['content'] .'
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }

                                echo '
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
