<?php
const HOST = "127.0.0.1";
const DATABASE = "ynews";
const USERNAME = "ynews";
const PASSWORD = "Y-news*2018,";

function database_open() {
    $link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    return $link;
}

function database_close($link) {
    mysqli_close($link);
}
?>
