<?php
session_start();

if(isset($_SESSION['valid_user'])) {
    $_SESSION = array();
}

include 'database.php';

$mysql = database_open();
if (mysqli_connect_errno($mysql)) {
    die("Failed to connect to Database Server, please try again later.");
}

$multiple = 0;
$invalid = 0;

if(isset($_POST) && empty($_POST) == false) {
    // try to login user
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($mysql, "SELECT COUNT(*) AS `count` FROM ynews.users WHERE username = '". $username ."' AND password = '". $password ."'");
    $row = mysqli_fetch_assoc($result);
    
    if(isset($row) && intval($row['count']) == 1) {
      $_SESSION['valid_user'] = true;
      $_SESSION['username'] = $username;

      header('location:index.php');
    }
    else {
      if(isset($row) && intval($row['count']) > 1) {
        $multiple = 1;
      }
      else {
        $invalid = 1;     
      }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Y-news - Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form method="post">
      <?php
      if($multiple) {
        echo "<p class='center'>There is more than one user with those credentials. I can't continue.</p>";
      }
      else {
        if($invalid) {
          echo "<p class='text-center'>Wrong username or password.</p>";
        }
      }
      ?>
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
