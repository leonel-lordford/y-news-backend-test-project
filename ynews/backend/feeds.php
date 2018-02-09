<?php
session_start();

if(isset($_SESSION['valid_user']) == false) {
    header('location: login.php');
}

include 'database.php';

$mysql = database_open();
if (mysqli_connect_errno($mysql)) {
    die("Failed to connect to Database Server, please try again later.");
}

// used for showing messages to user
$errors = 0;
$success = 0;
$action = 0;
$no_data = 0;

if(isset($_GET['action']) && trim($_GET['action']) == "csv" && isset($_GET['feed']) && trim($_GET['feed'])) {
    // get current feed
    $result = mysqli_query($mysql, "SELECT `id_feeds` FROM `feeds` WHERE `uuid` = '". $_GET['feed'] . "'");
    $row = mysqli_fetch_assoc($result);
    if(empty($row) == false) {
        $feed = $row['id_feeds'];        
        $csv = "";
        $result = mysqli_query($mysql, "SELECT `news`.`title`, `news`.`description`, `news`.`link`, `news`.`pubdate`, `categories`.`name` as `category` FROM `news` JOIN `feeds` ON `news`.`feeds_id_feeds` = `feeds`.`id_feeds` JOIN `categories` ON `feeds`.`categories_id_categories` = `categories`.`id_categories` WHERE `feeds`. `id_feeds` = '". $feed ."'");
        while($row = mysqli_fetch_assoc($result)) {
            $csv .= strip_tags($row['title']) . '*#*' . strip_tags($row['description']) . '*#*' . $row['link'] . '*#*' . $row['pubdate'] . '*#*' . $row['category'] . PHP_EOL;
        }
    
        if(empty($csv) == false) {
            $csv = "Title*#*Description*#*Source*#*Publication Date*#*Category" . PHP_EOL . $csv;
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="feeds.csv"');
            echo $csv; exit();
        }
        else {
            $no_data = 1;
            $action = $_GET['action'];
        }
    }
    else {
        $no_data = 1;
        $action = $_GET['action'];
    }
}

if(isset($_GET['action']) && trim($_GET['action']) == "json" && isset($_GET['feed']) && trim($_GET['feed'])) {
    // get current feed
    $result = mysqli_query($mysql, "SELECT `id_feeds` FROM `feeds` WHERE `uuid` = '". $_GET['feed'] . "'");
    $row = mysqli_fetch_assoc($result);
    if(empty($row) == false) {
        $feed = $row['id_feeds'];        
        $json = array();
        $result = mysqli_query($mysql, "SELECT `news`.`title`, `news`.`description`, `news`.`link`, `news`.`pubdate`, `categories`.`name` as `category` FROM `news` JOIN `feeds` ON `news`.`feeds_id_feeds` = `feeds`.`id_feeds` JOIN `categories` ON `feeds`.`categories_id_categories` = `categories`.`id_categories` WHERE `feeds`. `id_feeds` = '". $feed ."'");
        while($row = mysqli_fetch_assoc($result)) {
            array_push($json, $row);
        }

        // var_dump($json);
        $json = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    
        if(count($json)) {
            header('Content-Type: application/json');
            header('Content-Disposition: attachement; filename="feeds.json"');
            echo $json; exit();
        }
        else {
            $no_data = 1;
            $action = $_GET['action'];
        }
    }
    else {
        $no_data = 1;
        $action = $_GET['action'];
    }
}

if(isset($_POST) && empty($_POST) == false) {
    if(isset($_GET['action']) && trim($_GET['action']) == "remove" && isset($_GET['feed']) && trim($_GET['feed'])) {
        $query = "DELETE FROM ynews.feeds WHERE `uuid`='". $_GET['feed']. "'";
        $feed = mysqli_query($mysql, $query);

        if($feed) {
            $success = 1;
            $action = $_GET['action'];
        }
    }
    else {
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

                switch ($_GET['action']) {
                    case 'add':
                        $uuid = random_int(RAND_MIN, RAND_MAX);
                        $query = "INSERT INTO ynews.feeds (`name`, `source`, `categories_id_categories`, `uuid`) VALUES ('". $name ."', '". $source ."', '". $category ."', '". $uuid ."')";
                        $feed = mysqli_query($mysql, $query);
            
                        if($feed) {
                            $success = 1;
                            $action = $_GET['action'];
                        }
                    break;
                    case 'edit':
                        $query = "UPDATE ynews.feeds SET `name`='". $name ."', `source`='". $source ."', `categories_id_categories`='". $category ."' WHERE `uuid`='". $_GET['feed'] ."'";
                        $feed = mysqli_query($mysql, $query);
            
                        if($feed) {
                            $success = 1;
                            $action = $_GET['action'];
                        }
                    break;
                }            
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

            <?php define('ACTIVE', 'feeds'); include 'header.php'; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Manage Feeds</h1>
                </section>
                <section class="content container-fluid">
                    <div class="row"> 

                        <div style="padding: 0px 16px;">
                            <div class="box">
                            <?php
                            if($no_data) {
                                echo '
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                        No data for download.
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="feeds.php">
                                        <button type="button" class="btn btn-default">Go to feeds</button>
                                    </a>
                                </div>
                                ';
                            }
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
                                    case 'edit':
                                        $msg = "Feed updated.";
                                    break;
                                    case 'remove':
                                        $msg = "Feed removed.";
                                    break;
                                }
                                if($msg == "Feed removed.") {
                                    echo '
                                        <div class="box-body">
                                            <div class="alert alert-success alert-dismissible">
                                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                                '. $msg . '
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="feeds.php">
                                                <button type="button" class="btn btn-default">Go to feeds</button>
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
                                        $result = mysqli_query($mysql, "SELECT `name`, `source`, `categories_id_categories` as cat FROM ynews.feeds WHERE `uuid`='". $_GET['feed'] ."'");
                                        $row = mysqli_fetch_assoc($result);
                                        echo '
                                            <div class="box-header">
                                                <h3 class="box-title">Edit feed</h3>
                                            </div>
                                            <div class="box-body">
                                                <form role="form" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Name:</label>
                                                            <input class="form-control" id="name" name="name" placeholder="Enter name" value="'. $row['name'] .'">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Category:</label>
                                                            <select class="form-control" id="category" name="category">';
                                                            $categories = mysqli_query($mysql, "SELECT `id_categories`, `name`, `uuid` FROM ynews.categories");
                                                            while($cat = mysqli_fetch_assoc($categories)) {
                                                                if($cat['id_categories'] == $row['cat']) {
                                                                    echo "<option value='". $cat['uuid'] ."' selected>". $cat['name'] ."</option>";
                                                                }
                                                                else {
                                                                    echo "<option value='". $cat['uuid'] ."'>". $cat['name'] ."</option>";
                                                                }
                                                            }
                                                            echo '</select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="url" class="control-label">URL:</label>
                                                            <input class="form-control" id="url" name="url" placeholder="Enter url" value="'. $row['source'] .'">
                                                        </div>
                                                    </div>
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
                                        if($success == false) {
                                            $result = mysqli_query($mysql, "SELECT `name` FROM ynews.feeds WHERE `uuid`='". $_GET['feed'] ."'");
                                            $row = mysqli_fetch_assoc($result);
                                            echo '
                                                <div class="box-header">
                                                    <h3 class="box-title">Remove feed</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                        Do you really want to delete feed 
                                                        <span class="label label-default">'. $row['name'] .'</span> ?
                                                    </div>
                                                    <form role="form" method="post">
                                                        <input type="hidden" name="action" value="">
                                                        <button type="submit" class="btn btn-primary">Yes, delete feed</button>
                                                        <a href="feeds.php">
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
                                                            <a href="feeds.php?action=csv&feed='. $row['uuid'] .'" data-toggle="tooltip" title="CSV, use *#* as separator"><i class="fa fa-lg fa-download"></i></a>
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
