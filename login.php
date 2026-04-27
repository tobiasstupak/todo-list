<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    $sql = "SELECT * FROM users WHERE meno='$meno' AND heslo='$heslo'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['meno'] = $user['meno'];
        header("Location: todo.php");
        exit;
    } else {
        $chyba = "Zle meno alebo heslo";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prihlásenie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Prihlásenie</h2>

                    <?php if (isset($chyba)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $chyba; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="meno" placeholder="Meno" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="heslo" placeholder="Heslo" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                            Prihlásiť sa
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted">
                            Nemáte účet? <a href="registracia.php">Zaregistrujte sa</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
