<?php
include "db.php";

// PRIDANIE ULOHY
if (isset($_POST['pridat'])) {
    $nazov = trim($_POST['nazov']);
    $popis = trim($_POST['popis']);
    $user_id = 1; // natvrdo user

    if (!empty($nazov)) {
        $sql = "INSERT INTO tasks (user_id, nazov, popis) VALUES ('$user_id', '$nazov', '$popis')";
        mysqli_query($conn, $sql);
    } else {
        $chyba = "Nazov ulohy nesmie byt prazdny";
    }
}

// NACITANIE ULOH
$sql = "SELECT * FROM tasks ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Todo list</title>
</head>
<body>

<h1>Todo List</h1>
