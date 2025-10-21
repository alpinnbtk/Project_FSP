<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

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
    <h2>Login</h2>

    <form method="POST">

        <label>Username : </label>
        <input type="text" name="username">

        <br />

        <label>Password : </label>
        <input type="password" name="password">

        <br />

        <button type="submit" name="login">Login</button>

        <?php
        session_start();

        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $mysqli->prepare("SELECT * FROM akun WHERE username LIKE ?");
            $stmt->bind_param(
                "s",
                $username,
            );

            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {

                $is_authenticated = password_verify($_POST['password'], $row['password']);

                if ($is_authenticated) {
                    if ($row['isadmin'] == 0) {
                        $_SESSION['username'] = $username;
                        header('location:home.php');
                    } else {
                        header('location:dashboard_admin.php');
                    }
                } else {
                    echo "<p>Password anda salah</p>";
                }
            } else {
                echo "<p>User tidak terdaftar!</p>";
            }
        }

        ?>

    </form>

</body>

</html>