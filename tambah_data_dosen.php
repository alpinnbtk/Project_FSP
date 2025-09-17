<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
</head>
<body>
    <h2>Tambah Data Dosen</h2>
    <?php
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        echo "<form method = 'POST' action = 'tambah_data_dosen_proses.php?' enctype = 'multipart/form-data'>";
        echo "<label>NPK Dosen : </label>
              <input type = 'text' name = 'txtNPK'><br>";
        echo "<label>Nama Dosen : </label>
              <input type = 'text' name = 'txtNama'><br>";
        echo "<label>Foto Dosen : </label>
              <input type = 'file' name = 'fotoDosen'><br>";
        echo "<input type = 'submit' name = 'btnSubmit'>";
        echo "</form>";
    ?>
</body>
</html>