<?php
$conn = mysqli_connect("localhost", "root", "root", "db_todo");

if (!$conn) {
    die("Chyba pripojenia k databaze: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
