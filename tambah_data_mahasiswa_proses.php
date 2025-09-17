<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <?php
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $nrp    = $_POST['txtNRP'];
        $nama    = $_POST['txtNama'];  
        $gender = $_POST['genderMhs'];
        $tanggal_lahir = $_POST['txtTanggalLahir'];
        $angkatan = $_POST['txtAngkatan'];
        $foto     = $_FILES['fotoMahasiswa']; 

        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

        $sql = "INSERT INTO mahasiswa (nrp, nama, gender, tanggal_lahir, angkatan, foto_extention)
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('ssssss', $nrp, $nama, $gender, $tanggal_lahir, $angkatan, $ext);

        move_uploaded_file($foto['tmp_name'], "foto_mahasiswa/".$nrp.".".$ext);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        header("location: tabel_data_mahasiswa.php");
    ?>
</body>
</html>