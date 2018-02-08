<?php
echo '
<header class="main-header">
    <a href="index.php" class="logo">
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
        <ul class="sidebar-menu" data-widget="tree">';
            if(ACTIVE == "index") {
                echo '<li class="active">';
            }
            else {
                echo '<li>';
            }
            echo '
                <a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a>
            </li>';
            if(ACTIVE == "feeds") {
                echo '<li class="active">';
            }
            else {
                echo '<li>';
            }
            echo '
                <a href="feeds.php"><i class="fa fa-link"></i> <span>Feeds</span></a>
            </li>';
            if(ACTIVE == "categories") {
                echo '<li class="active">';
            }
            else {
                echo '<li>';
            }
            echo '
                <a href="categories.php"><i class="fa fa-link"></i> <span>Categories</span></a>
            </li>';
            if(ACTIVE == "pages") {
                echo '<li class="active">';
            }
            else {
                echo '<li>';
            }
            echo '
                <a href="pages.php"><i class="fa fa-link"></i> <span>Static pages</span></a>
            </li>';
            
            if(ACTIVE == "users") {
                echo '<li class="active">';
            }
            else {
                echo '<li>';
            }
            echo '
                <a href="users.php"><i class="fa fa-link"></i> <span>Users</span></a>
            </li>
        </ul>
    </section>
</aside>';

?>