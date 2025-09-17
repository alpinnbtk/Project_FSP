<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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
            echo "<label>NRP Mahasiswa : </label><input type = 'text' value = '". $row['nrp']. "' name = 'txtNRP'><br>";
            echo "<label>Nama Mahasiswa : </label><input type = 'text' value = '". $row['nama']. "' name = 'txtNama'><br>";
            echo "<label>Gender Mahasiswa : </label>
                  <select name = 'genderMhs'>\
                    <option value = 'Pria'";
                    if ($row['gender'] == 'Pria') { echo "selected"; }
                    echo ">Pria</option>";
            echo   "<option value = 'Wanita'";
                    if ($row['gender'] == 'Wanita') { echo "selected"; }
                    echo ">Wanita</option>";
            echo "</select><br>";
            echo "<label>Tanggal Lahir : </label><input type = 'date' value = '". $row['tanggal_lahir']. "' name = 'txtTanggalLahir'><br>";
            echo "<label>Angkatan Mahasiswa : </label><input type = 'text' value = '". $row['angkatan']. "' name = 'txtAngkatan'><br>";
            echo "<img src = 'foto_mahasiswa/".$nrp_mahasiswa.".".$row['foto_extention']. "' alt = 'Foto Mahasiswa'><br>";
            echo "<input type = 'file' name = 'fotoBaru'><br>";
            echo "<button type = 'submit' name = 'btnEdit'>Ganti Foto</button>";
            echo "</form>";
        } else {
            echo "Data tidak ditemukan";
        }
    ?>
</body>
</html>