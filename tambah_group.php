<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Group</title>
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
    <h2>Tambah Group</h2>
    <?php
    echo "<form method = 'POST' action = 'tambah_group_proses.php'>";
    echo "<label> Masukkan nama group </label>";
    echo "<input type = 'text' name = 'txtNamaGroup' required><br>";

    echo "<label> Masukkan deskripsi group </label>";
    echo "<input type = 'text' name = 'txtDeskripsi' required><br>";

    echo "<label>Jenis Group : </label>
              <select name = 'jenisGroup' required>
                <option value = 'publik'>Publik</option>
                <option value = 'privat'>Privat</option>
              </select><br>";

    echo "<br>";
    echo "<input type = 'submit' name = 'btnSubmit' class='btnSubmit'>";
    echo "</form>";

    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'namaGroup') {
            echo "<div style='color:red; font-weight:bold;'>Nama group sudah terdaftar sebelumnya!</div>";
        } else if ($_GET['error'] == 'insert') {
            echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
        }
    }
    ?>
</body>

</html>