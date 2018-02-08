<?php
const HOST = "127.0.0.1";
const DATABASE = "ynews";
const USERNAME = "ynews";
const PASSWORD = "Y-news*2018,";

const RAND_MIN = 11111111;
const RAND_MAX = 99999999;

function database_open() {
    $link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    return $link;
}

function database_close($link) {
    mysqli_close($link);
}
?>
