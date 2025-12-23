<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Close Thread</title>
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: left;
            width: 900px;
        }

        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        img {
            width: 150px;
            height: 200px;
        }


        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;

        }
    </style>
</head>

<body>
    <h2>Close Thread</h2>
    <?php
    session_start();

    require_once("Class/thread.php");

    $thread = new thread();

    $idGroup = $_GET['idgrup'];

    $idThread = $_GET['idthread'];
    $username = $_SESSION['username'];
    $response = $thread->closeThread($idThread, $username);

    if ($response) {
        header("location:lihat_thread.php?idgrup=" . $idGroup);
    } else {
        header("location:lihat_thread.php?error=delete");
    }
    ?>
</body>

</html>