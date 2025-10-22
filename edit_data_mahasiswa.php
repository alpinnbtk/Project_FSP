<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>

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
    <h2>Edit Data Mahasiswa</h2>
    <?php
    $nrp_mahasiswa = $_GET['nrp'];
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }
    $stmt = $mysqli->prepare('SELECT * FROM mahasiswa WHERE nrp = ?');
    $stmt->bind_param("s", $nrp_mahasiswa);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form method = 'POST' action = 'edit_data_mahasiswa_proses.php' enctype = 'multipart/form-data'>";
        echo "<label>NRP Mahasiswa : </label><input type = 'text' value = '" . $row['nrp'] . "' disabled><br>";
        echo "<input type = 'hidden' value = '" . $row['nrp'] . "' name = 'txtNRP'><br>";


        echo "<input type='hidden' name='nrp_awal' value='" . $row['nrp'] . "'>";
        echo "<label>Nama Mahasiswa : </label><input type = 'text' value = '" . $row['nama'] . "' name = 'txtNama'><br>";
        echo "<label>Gender Mahasiswa : </label>
                  <select name = 'genderMhs'>\
                    <option value = 'Pria'";
        if ($row['gender'] == 'Pria') {
            echo "selected";
        }
        echo ">Pria</option>";
        echo   "<option value = 'Wanita'";
        if ($row['gender'] == 'Wanita') {
            echo "selected";
        }
        echo ">Wanita</option>";
        echo "</select><br>";
        echo "<label>Tanggal Lahir : </label><input type = 'date' value = '" . $row['tanggal_lahir'] . "' name = 'txtTanggalLahir'><br>";
        echo "<label>Angkatan Mahasiswa : </label><input type = 'text' value = '" . $row['angkatan'] . "' name = 'txtAngkatan'><br>";

        echo "<label>Foto Mahasiswa : </label><br>";
        echo "<img src = 'foto_mahasiswa/" . $nrp_mahasiswa . "." . $row['foto_extention'] . "' alt = 'Foto Mahasiswa'><br>";
        echo "<input type = 'file' name = 'fotoBaru' accept='image/jpeg, image/png'><br>";
        echo "<button type = 'submit' name = 'btnEdit' class='btnEdit'>Edit Data</button>";
        echo "</form>";
    } else {
        echo "Data tidak ditemukan";
    }
    ?>
</body>

</html>