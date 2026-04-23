<?php
include "db.php";

if (isset($_POST['register'])) {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    if ($meno != "" && $heslo != "") {
        $sql = "INSERT INTO users (meno, heslo) VALUES ('$meno', '$heslo')";
        mysqli_query($conn, $sql);

        echo "Uspešná registrácia";
    } else {
        echo "Vyplň všetky údaje";
    }
}
?>
