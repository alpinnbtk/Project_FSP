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
        $nrp_awal = $_POST['nrp_awal'];
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $nrp_baru    = $_POST['txtNRP'];
        $nama    = $_POST['txtNama'];  
        $gender = $_POST['genderMhs'];
        $tanggal_lahir = $_POST['txtTanggalLahir'];
        $angkatan = $_POST['txtAngkatan'];
        $foto     = $_FILES['fotoBaru'];; 

        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

        if (!empty($foto['name'])) {
            $sql = "UPDATE mahasiswa SET nrp = ?, nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ?, foto_extention = ? WHERE nrp = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sssssss', $nrp_baru, $nama, $gender, $tanggal_lahir, $angkatan, $ext, $nrp_awal);

            if (file_exists("foto_mahasiswa/".$nrp_baru.".".$ext)) {
                unlink("foto_mahasiswa/".$nrp_baru.".".$ext);
            }
            move_uploaded_file($foto['tmp_name'], "foto_mahasiswa/".$nrp_baru.".".$ext);
        } 
        else {
            $sql = "UPDATE mahasiswa SET nrp = ?, nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ? WHERE nrp = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ssssss', $nrp_baru, $nama, $gender, $tanggal_lahir, $angkatan, $nrp_awal);
        }

        if ($stmt->execute()) {
            echo "Data berhasil diubah!<br>";
        } else {
            echo "Error: ".$stmt->error."<br>";
        }

        echo "<a href = 'tabel_data_mahasiswa.php'>Kembali ke Tabel Data</a><br>";
        echo "<a href = 'edit_data_mahasiswa.php'>Kembali ke Halaman Edit</a><br>";

        $stmt->close();
        $mysqli->close();
    ?>
</body>
</html>