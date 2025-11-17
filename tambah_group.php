<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Dosen</title>
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

        .btnSearch {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .btnSearch:hover {
            background: #45a049;
        }

        #page {
            margin-top: 70px;
            text-align: center;
        }

        #page a {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid green;
            text-decoration: none;
            color: green;
        }


        #page a:hover {
            background-color: #e6ffe6;
        }

        #page span.active {
            background-color: #00b900ff;
            color: white;
            font-weight: bold;
            cursor: default;
            padding: 6px 11px;
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

    echo "<label> Masukkan kode pendaftaran </label>";
    echo "<input type = 'text' name = 'txtKode' required><br>";

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