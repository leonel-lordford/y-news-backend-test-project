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

if(isset($_POST) && empty($_POST) == false) {
    // get all feeds and update database
    $result = mysqli_query($mysql, "SELECT `id_feeds`, `source` FROM ynews.feeds");
    while($row = mysqli_fetch_assoc($result)) {
        $rss = simplexml_load_file($row['source']);
        foreach ($rss->channel->item as $item) {
            $title = $item->title;
            $desc = strip_tags($item->description);
            $link = $item->link;
            $date = date_format(new DateTime($item->pubDate), "c");
            $feed = $row['id_feeds'];
            $updated = date_format(new DateTime(), "c");
            $uuid = random_int(RAND_MIN, RAND_MAX);
            
            $query = "INSERT INTO ynews.news (`title`, `description`, `link`, `pubdate`, `feeds_id_feeds`, `saved_at`, `uuid`) VALUES('" . $title . "', '" . $desc. "', '" . $link . "', '" . $date . "', '" . $feed . "', '" . $updated . "', '" . $uuid . "')";
            $news = mysqli_query($mysql, $query);
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
            
            <?php define('ACTIVE', 'index'); include 'header.php'; ?>
            
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>General status</h1>
                </section>
                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4"> 
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-refresh"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Last update</span>
                                    <?php
                                    // get last news' saved datetime
                                    $result = mysqli_query($mysql, "SELECT `saved_at` FROM ynews.news ORDER BY  `id_news` DESC LIMIT 1");
                                    $row = mysqli_fetch_assoc($result);
                                    if(isset($row)) {
                                        $d = date_create($row['saved_at']);
                                        $date = date_format($d, "Y-m-d");
                                        $time = date_format($d, "G:i a");
                                        echo '
                                            <span class="info-box-number"><small>'. $date .'</small></span>
                                            <span class="info-box-number"><small>'. $time .'</small></span>
                                        ';
                                    }
                                    else {
                                        echo '
                                            <span class="info-box-number"><small>There are no news available</small></span>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>                             
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-feed"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total feeds</span>
                                    <?php
                                    // get count(feeds)
                                    $result = mysqli_query($mysql, "SELECT COUNT(*) AS 'total_feeds' FROM ynews.feeds");
                                    $row = mysqli_fetch_assoc($result);
                                    if(isset($row)) {
                                        echo '
                                            <span class="info-box-number">'. $row['total_feeds'] .'</span>
                                        ';
                                    }
                                    else {
                                        echo '
                                        <span class="info-box-number">0</span>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">News</span>
                                    <?php
                                    // get count(news)
                                    $result = mysqli_query($mysql, "SELECT COUNT(*) AS 'total_news' FROM ynews.news");
                                    $row = mysqli_fetch_assoc($result);
                                    if(isset($row)) {
                                        echo '
                                            <span class="info-box-number">'. $row['total_news'] .'</span>
                                        ';
                                    }
                                    else {
                                        echo '
                                        <span class="info-box-number">0</span>
                                        ';
                                    }
                                    ?>
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
                                        <form method="POST">
                                            <input type="hidden" name="update" />
                                            <button type="submit" class="btn btn-default btn-lrg" onclick="javascript:update_news()">
                                                <i class="fa fa-refresh" id="btn_fetch"></i>&nbsp; Fetch data
                                            </button>
                                        </form>
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
                $("#btn_fetch").toggleClass("fa-spin");
            }
        </script>
    </body>
</html>
<?php 
database_close($mysql);
?>
