<?php
session_start();
include "db.php";

// Kontrola či je užívateľ prihlásený
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// STAV
if (isset($_GET['done'])) {
    $id = (int)$_GET['done'];
    mysqli_query($conn, "UPDATE tasks SET stav='hotova' WHERE id=$id");
    header("Location: todo.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
    header("Location: todo.php");
    exit();
}

// EDIT
$editTask = null;

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $resultEdit = mysqli_query($conn, "SELECT * FROM tasks WHERE id=$id");
    $editTask = mysqli_fetch_assoc($resultEdit);
}

// UPDATE
if (isset($_POST['upravit'])) {
    $id = (int)$_POST['id'];
    $nazov = trim($_POST['nazov']);
    $popis = trim($_POST['popis']);

    if (!empty($nazov)) {
        mysqli_query($conn, "UPDATE tasks SET nazov='$nazov', popis='$popis' WHERE id=$id");
        header("Location: todo.php");
        exit();
    } else {
        $chyba = "Názov úlohy nesmie byť prázdny";
    }
}

// CREATE
if (isset($_POST['pridat'])) {
    $nazov = trim($_POST['nazov']);
    $popis = trim($_POST['popis']);
    $user_id = $_SESSION['user_id'];

    if (!empty($nazov)) {
        mysqli_query($conn, "INSERT INTO tasks (user_id, nazov, popis)
                             VALUES ('$user_id', '$nazov', '$popis')");
        header("Location: todo.php");
        exit();
    } else {
        $chyba = "Názov úlohy nesmie byť prázdny";
    }
}

// READ
$result = mysqli_query($conn, "SELECT * FROM tasks WHERE user_id=" . $_SESSION['user_id'] . " ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Todo List</h1>
        <a href="todo.php?logout=1" class="btn btn-outline-danger">
            Odhlásiť sa
        </a>
    </div>

    <!-- FORM -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <?php if ($editTask) { ?>

                <h5 class="mb-3">Upraviť úlohu</h5>

                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $editTask['id']; ?>">

                    <div class="mb-3">
                        <input type="text" class="form-control"
                               name="nazov"
                               value="<?php echo htmlspecialchars($editTask['nazov']); ?>">
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="popis" rows="3"><?php
                            echo htmlspecialchars($editTask['popis']);
                        ?></textarea>
                    </div>

                    <button type="submit" name="upravit" class="btn btn-primary">
                        Uložiť
                    </button>

                    <a href="todo.php" class="btn btn-secondary">
                        Zrušiť
                    </a>
                </form>

            <?php } else { ?>

                <h5 class="mb-3">Pridaj úlohu</h5>

                <form method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nazov" placeholder="Názov úlohy">
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="popis" rows="3" placeholder="Popis"></textarea>
                    </div>

                    <button type="submit" name="pridat" class="btn btn-success w-100">
                        + Pridať úlohu
                    </button>
                </form>

            <?php } ?>

        </div>
    </div>

    <!-- ERROR -->
    <?php if (isset($chyba)) { ?>
        <div class="alert alert-danger">
            <?php echo $chyba; ?>
        </div>
    <?php } ?>

    <!-- ZOZNAM -->
    <h4 class="mb-3">Zoznam úloh</h4>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="card mb-3 shadow-sm">
                <div class="card-body">

                    <h5 class="card-title">
                        <?php echo htmlspecialchars($row['nazov']); ?>
                    </h5>

                    <p class="card-text">
                        <?php echo htmlspecialchars($row['popis']); ?>
                    </p>

                    <?php if ($row['stav'] === 'hotova') { ?>
                        <span class="badge bg-success">Hotová</span>
                    <?php } else { ?>
                        <span class="badge bg-warning text-dark">Čakajúca</span>
                    <?php } ?>

                    <div class="mt-3">

                        <?php if ($row['stav'] !== 'hotova') { ?>
                            <a href="todo.php?done=<?php echo $row['id']; ?>"
                               class="btn btn-sm btn-success">
                                Hotová
                            </a>
                        <?php } ?>

                        <a href="todo.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-sm btn-warning">
                            Upraviť
                        </a>

                        <a href="todo.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Naozaj vymazať?')">
                            Vymazať
                        </a>

                    </div>

                </div>
            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="alert alert-info text-center">
            Nemáte žiadne úlohy. Vytvorte si novú
        </div>

    <?php } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
