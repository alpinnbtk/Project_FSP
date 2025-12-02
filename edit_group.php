<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

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
            width: 500px;
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
    <h2>Edit Event</h2>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idgrup = $_GET["idgrup"];

    $stmt = $mysqli->prepare('SELECT * FROM grup WHERE idgrup = ?');
    $stmt->bind_param("i", $idgrup);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form method = 'POST' action = 'edit_group_proses.php?idgrup=$idgrup' enctype = 'multipart/form-data'>";
        echo "<input name='idgrup' type = 'hidden' value = '" . $row['idgrup'] . "'><br>";

        echo "<label>Nama Group : </label><input name='txtNama' type = 'text' value = '" . $row['nama'] . "'><br>";

        echo "<label>Jenis Group : </label>
                  <select name = 'jenisGroup'>\
                    <option value = 'Publik'";
        if ($row['jenis'] == 'Publik') {
            echo "selected";
        }
        echo ">Publik</option>";
        echo   "<option value = 'Privat'";
        if ($row['jenis'] == 'Privat') {
            echo "selected";
        }
        echo ">Privat</option>";
        echo "</select><br><br>";

        echo "<button type = 'submit' name = 'btnEdit' class='btnEdit'>Edit Event</button><br><br>";
    }

    echo "<a href='kelola_group_dosen.php?username=" . $_SESSION['username'] . "'>Kembali</a>";

    ?>
</body>

</html>