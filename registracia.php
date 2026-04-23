<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Registracia</h2>

<form method="POST">
    <input type="text" name="meno" placeholder="meno"><br><br>
    <input type="password" name="heslo" placeholder="heslo"><br><br>
    <button type="submit" name="registracia">Registrovat</button>
</form>

</body>
</html>

<?php
include "db.php";

if (isset($_POST['registracia'])) {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    if ($meno != "" && $heslo != "") {
        $sql = "INSERT INTO users (meno, heslo) VALUES ('$meno', '$heslo')";
        mysqli_query($conn, $sql);

        header("Location: todo.php");
        exit;
    } else {
        echo "Vypln vsetky udaje";
    }
}
?>


