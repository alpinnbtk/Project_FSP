<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home Dosen</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            text-align: left;
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

        p {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <?php
    echo "<h2>Halo " . $_SESSION['username'] . "</h2>";
    ?>
    <h2>Menu</h2>

    <ul>
        <li><a href="ganti_password.php">Ganti Password</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="tambah_group.php">Buat Grup</a></li>
        <li><a href="kelola_group_dosen.php?username= <?php echo $_SESSION['username']; ?> ">Kelola Grup</a></li>
    </ul>

</body>

</html>