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
    <link rel="stylesheet" href="theme.css">

    <style>
        body {
            background: var(--bg-color);
            font-family: Arial;
        }

        form {
            background: var(--form-bg);
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
            color: var(--text-primary);

        }

        input {
            border-radius: 6px;
            padding: 7px;
            margin: 6px;
            color: var(--text-primary);

        }

        label {
            text-align: left;
            color: var(--text-primary);
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

        @media (max-width: 2160px) {

            body {
                padding: 15px;
            }

            h2 {
                text-align: center;
            }

            ul {
                padding-left: 20px;
            }

            li {
                margin-bottom: 30px;
                font-size: 16px;
            }

            li a {
                background: #4CAF50;
                color: white;
                padding: 12px;
                border-radius: 6px;
                text-align: center;
                text-decoration: none;
            }

            li a:hover {
                background: #45a049;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 10px;
            }

            h2 {
                font-size: 20px;
                text-align: center;
            }

            ul {
                padding: 0;
                list-style: none;
            }

            li {
                margin-bottom: 12px;
            }

            li a {
                display: block;
                background: #4CAF50;
                color: white;
                padding: 10px;
                border-radius: 6px;
                text-align: center;
                text-decoration: none;
            }

            li a:hover {
                background: #45a049;
            }
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