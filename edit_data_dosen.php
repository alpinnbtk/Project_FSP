<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>

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
            width: 700px;
        }

        img {
            width: 150px;
            height: 200px;
        }


        input {
            /* width: 100%; */
            border-radius: 6px;
            padding: 10px;
            margin: 6px;
            width: 30%;
        }

        .btnEdit {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .btnEdit:hover {
            background: #45a049;
        }
    </style>
</head>

<body>
    <h2>Edit Data Dosen</h2>
    <?php
    $npk_dosen = $_GET['npk'];
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }
    $stmt = $mysqli->prepare('SELECT * FROM dosen WHERE npk = ?');
    $stmt->bind_param("s", $npk_dosen); // "i" = integer
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form method = 'POST' action = 'edit_data_dosen_proses.php' enctype = 'multipart/form-data'>";
        echo "<label>NPK Dosen : </label><input type = 'text' value = '" . $row['npk'] . "' disabled><br>";
        echo "<input type = 'hidden' value = '" . $row['npk'] . "' name = 'txtNPK'><br>";

        echo "<input type='hidden' name='npk_awal' value='" . $row['npk'] . "'>";
        echo "<label>Nama Dosen : </label><input type = 'text' value = '" . $row['nama'] . "' name = 'txtNama'><br>";
        echo "<label>Foto Dosen : </label><br>";
        echo "<img src = 'foto_dosen/" . $npk_dosen . "." . $row['foto_extension'] . "' alt = 'Foto Dosen'><br>";
        echo "<input type = 'file' name = 'fotoBaru'><br>";
        echo "<button type = 'submit' name = 'btnEdit' class='btnEdit'>Edit Data</button>";
        echo "</form>";
    } else {
        echo "Data tidak ditemukan";
    }
    ?>
</body>

</html>