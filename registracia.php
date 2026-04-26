<?php
include "db.php";

if (isset($_POST['registracia'])) {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    if ($meno != "" && $heslo != "") {
        $sql = "INSERT INTO users (meno, heslo) VALUES ('$meno', '$heslo')";
        mysqli_query($conn, $sql);

        header("Location: login.php");
        exit;
    } else {
        $chyba = "Vyplňte všetky údaje";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Registrácia</h2>

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
                        <button type="submit" name="registracia" class="btn btn-success w-100 mb-3">
                            Zaregistrovať sa
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted">
                            Už máte účet? <a href="login.php">Prihláste sa</a>
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

