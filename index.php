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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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

        .login-container {
            text-align: center;
        }


        @media (max-width: 768px) {

            body {
                padding: 20px;
            }

            form {
                width: 80%;
                box-sizing: border-box;
            }

            button {
                width: 100%;
                padding: 10px;
            }

            input {
                width: 90%;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 10px;
            }

            h2 {
                text-align: center;
            }

            form {
                width: 100%;
                padding: 15px;
            }

            label {
                display: block;
                text-align: left;
                margin-top: 10px;
            }

            input {
                width: 100%;
                margin: 5px 0;
            }

            button {
                width: 100%;
                padding: 10px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        <form method="POST">

            <label>Username : </label>
            <input type="text" name="username">

            <br>

            <label>Password : </label>
            <input type="password" name="password">

            <br>

            <button type="submit" name="login">Login</button>

            <?php
            session_start();
            require_once("Class/akun.php");

            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $akun = new akun();
                $dataAkun = $akun->login($username, $password);

                if ($dataAkun) {

                    $_SESSION['username'] = $username;

                    if ($dataAkun['isadmin'] == 0) {
                        if ($dataAkun['nrp_mahasiswa'] != "") {
                            $_SESSION['role'] = 'mahasiswa';
                            header('location:home_mahasiswa.php');
                        }
                        if ($dataAkun['npk_dosen'] != "") {
                            $_SESSION['role'] = 'dosen';
                            header('location:home_dosen.php');
                        }
                    } else {
                        header('location:dashboard_admin.php');
                    }
                } else {
                    echo "<p>Username atau password salah!</p>";
                }
            }

            ?>

        </form>
    </div>
</body>

</html>