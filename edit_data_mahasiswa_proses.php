<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h2> Edit Data Mahasiswa</h2><br>
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
        $foto     = $_FILES['fotoBaru'];; 

        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

        $sql = "UPDATE mahasiswa SET nrp = ?, nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ?, foto_extention = ? WHERE nrp = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('sssssss', $nrp, $nama, $gender, $tanggal_lahir, $angkatan, $ext, $nrp);

        if (isset($foto) && file_exists("foto_mahasiswa/".$nrp.".".$ext)) {
            unlink("foto_mahasiswa/".$nrp.".".$ext);
        }
        move_uploaded_file($foto['tmp_name'], "foto_mahasiswa/".$nrp.".".$ext);

        if ($stmt->execute()) {
            echo "Data berhasil diubah!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    ?>
</body>
</html>