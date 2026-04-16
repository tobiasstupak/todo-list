<?php
include "db.php";

if (isset($_POST['login'])) {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    if ($meno != "" && $heslo != "") {
        $sql = "INSERT INTO users (meno, heslo) VALUES ('$meno', '$heslo')";
        mysqli_query($conn, $sql);

        echo "Ulozene";
    } else {
        echo "Vypln vsetko";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Prihlasenie</h2>

<form method="POST">
    <input type="text" name="meno" placeholder="meno"><br><br>
    <input type="password" name="heslo" placeholder="heslo"><br><br>
    <button type="submit" name="login">Prihlasit sa</button>
</form>

</body>
</html>