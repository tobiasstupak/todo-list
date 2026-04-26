<?php
include "db.php";

// DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id = $id");
    header("Location: todo.php");
    exit();
}

// CREATE
if (isset($_POST['pridat'])) {
    $nazov = trim($_POST['nazov']);
    $popis = trim($_POST['popis']);
    $user_id = 1; 

    if (!empty($nazov)) {
        $sql = "INSERT INTO tasks (user_id, nazov, popis) VALUES ('$user_id', '$nazov', '$popis')";
        mysqli_query($conn, $sql);
    } else {
        $chyba = "Nazov ulohy nesmie byt prazdny";
    }
}

// READ
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
<h2>Pridaj ulohu</h2>

<form method="POST">
    <input type="text" name="nazov" placeholder="Nazov ulohy"><br><br>
    <textarea name="popis" placeholder="Popis"></textarea><br><br>
    <button type="submit" name="pridat">Pridat</button>
</form>

<?php
if (isset($chyba)) {
    echo "<p style='color:red;'>$chyba</p>";
}
?>

<h2>Zoznam uloh</h2>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div style="border:1px solid black; padding:10px; margin:10px;">
        <b><?php echo $row['nazov']; ?></b><br>
        <?php echo $row['popis']; ?><br>
        Stav: <?php echo $row['stav']; ?><br><br>

        <a href="todo.php?delete=<?php echo $row['id']; ?>">Zmazat</a>
    </div>
<?php } ?>

</body>
</html>
