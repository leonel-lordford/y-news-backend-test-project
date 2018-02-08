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
                                <div class="box-header">
                                    <h3 class="box-title">List of pages</h3>
                                </div>                                 


                                <div class="box-body"> 
                                    <div id="accordion">
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