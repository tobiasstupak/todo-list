<?php
include "db.php";

// Stav
if (isset($_GET['done'])) {
    $id = (int)$_GET['done'];
    mysqli_query($conn, "UPDATE tasks SET stav='hotova' WHERE id=$id");
    header("Location: todo.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id = $id");
    header("Location: todo.php");
    exit();
}

// UPDATE
$editTask = null;

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $resultEdit = mysqli_query($conn, "SELECT * FROM tasks WHERE id = $id");
    $editTask = mysqli_fetch_assoc($resultEdit);
}

if (isset($_POST['upravit'])) {
    $id = (int)$_POST['id'];
    $nazov = trim($_POST['nazov']);
    $popis = trim($_POST['popis']);

    if (!empty($nazov)) {
        mysqli_query($conn, "UPDATE tasks SET nazov='$nazov', popis='$popis' WHERE id=$id");
        header("Location: todo.php");
        exit();
    } else {
        $chyba = "Nazov ulohy nesmie byt prazdny";
    }
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
<?php if ($editTask) { ?>
    <h2>Upravit ulohu</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $editTask['id']; ?>">
        <input type="text" name="nazov" value="<?php echo htmlspecialchars($editTask['nazov']); ?>"><br><br>
        <textarea name="popis"><?php echo htmlspecialchars($editTask['popis']); ?></textarea><br><br>
        <button type="submit" name="upravit">Ulozit</button>
    </form>
<?php } else { ?>
    <h2>Pridaj ulohu</h2>
    <form method="POST">
        <input type="text" name="nazov" placeholder="Nazov ulohy"><br><br>
        <textarea name="popis" placeholder="Popis"></textarea><br><br>
        <button type="submit" name="pridat">Pridat</button>
    </form>
<?php } ?>

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
        <a href="todo.php?edit=<?php echo $row['id']; ?>">Upravit</a>
        <a href="todo.php?done=<?php echo $row['id']; ?>">Hotova</a>
    </div>
<?php } ?>

</body>
</html>
