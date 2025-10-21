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

    $sql = "SELECT COUNT(*) FROM mahasiswa WHERE nrp = ? ";
    $cek = $mysqli->prepare($sql);
    $cek->bind_param('s', $nrp);
    $cek->execute();
    $cek->bind_result($count);
    $cek->fetch();
    $cek->close();

    if ($count > 0) {
        header("location: tambah_data_mahasiswa.php?error=nrp");
        exit();
    } else {
        $sql = "INSERT INTO mahasiswa (nrp, nama, gender, tanggal_lahir, angkatan, foto_extention)
            VALUES (?, ?, ?, ?, ?, ?)";

        $sqlInsertAkun = "INSERT INTO akun (username, password, nrp_mahasiswa, isadmin)
            VALUES (?, ?, ?, ?);";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssssss', $nrp, $nama, $gender, $tanggal_lahir, $angkatan, $ext);

        $isAdmin = 0;
        $stmtAkun = $mysqli->prepare($sqlInsertAkun);
        $username = strtolower(str_replace(" ", "", $nama));
        $hash_password = password_hash($nrp, PASSWORD_DEFAULT);
        $stmtAkun->bind_param('sssi', $username, $hash_password, $nrp, $isAdmin);

        move_uploaded_file($foto['tmp_name'], "foto_mahasiswa/" . $nrp . "." . $ext);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
            $stmtAkun->execute();
        } else {
            header("location: tambah_data_mahasiswa.php?error=insert");
        }

        header("location: tabel_data_mahasiswa.php");
    }

    ?>
</body>

</html>