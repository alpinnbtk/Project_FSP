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
    <title>Ganti Password</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            width: 400px;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            border-radius: 6px;
            padding: 7px;
            margin: 6px;

        }

        button {
            background: #4CAF50;
            color: white;
            padding: 10px 120px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>

<body>
    <h2>Ganti Password</h2>

    <form method="POST" action="ganti_password_proses.php">
        <label>Inputkan password : </label>
        <input type="password" name="pwdSekarang">

        <br>

        <label>Inputkan password baru : </label>
        <input type="password" name="pwdBaru">

        <br>

        <button type="submit" name="btnGantiPwd">Ganti Password</button>
    </form>
</body>

</html>