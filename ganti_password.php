<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Ganti Password</h2>

    <form method="POST" action="ganti_password_proses.php">
        <label>Inputkan password sekarang : </label>
        <input type="text" name="pwdSekarang">

        <br>

        <label>Inputkan password baru : </label>
        <input type="text" name="pwdBaru">

        <br>

        <button type="submit" name="btnGantiPwd">Ganti Password</button>
    </form>
</body>

</html>