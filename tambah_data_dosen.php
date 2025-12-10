<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>

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
            width: 380px;
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

        .btnSubmit {
            background: #4CAF50;
            color: white;
            padding: 10px 120px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .btnSubmit:hover {
            background: #45a049;
        }
    </style>
</head>

<body>
    <h2>Tambah Data Dosen</h2>
    <?php
    echo "<form method = 'POST' action = 'tambah_data_dosen_proses.php?' enctype = 'multipart/form-data'>";
    echo "<label>NPK Dosen : </label>
              <input type = 'text' name = 'txtNPK' maxlength='6' required><br>";
    echo "<label>Nama Dosen : </label>
              <input type = 'text' name = 'txtNama' required><br>";
    echo "<label>Foto Dosen : </label>
              <input type = 'file' name = 'fotoDosen' accept='image/jpeg, image/png'><br>";

    echo "<label>Username : </label>
              <input type = 'text' name = 'txtUsername' required><br>";
    echo "<label>Password : </label>
              <input type = 'password' name = 'txtPassword' required><br>";

    echo "<input type = 'submit' name = 'btnSubmit' class='btnSubmit'>";
    echo "</form>";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'npk') {
            echo "<div style='color:red; font-weight:bold;'>NPK sudah terdaftar sebelumnya!</div>";
        } else if ($_GET['error'] == 'insert') {
            echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
        } else if ($_GET['error'] == 'upload') {
            echo "<div style='color:red; font-weight:bold;'>Gagal upload foto!</div>";
        }
    }
    ?>
</body>

</html>