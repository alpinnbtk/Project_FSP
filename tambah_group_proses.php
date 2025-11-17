<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $namaGroup = $_POST['txtNamaGroup'];
    $deskripsi = $_POST['txtDeskripsi'];
    $jenis = $_POST['jenisGroup'];
    $kode = $_POST['txtKode'];
    $tanggal = date("Y-m-d H:i:s");

    $sql = "SELECT COUNT(*) FROM grup WHERE nama = ? ";
    $cek = $mysqli->prepare($sql);
    $cek->bind_param('s', $namaGroup);
    $cek->execute();
    $cek->bind_result($count);
    $cek->fetch();
    $cek->close();

    if ($count > 0) {
        header("location: tambah_group.php?error=namaGroup");
        exit();
    } else {
        $sql = "INSERT INTO grup (username_pembuat, nama, deskripsi, tanggal_pembentukan, jenis, kode_pendaftaran)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssssss', $_SESSION['username'], $namaGroup, $deskripsi, $tanggal, $jenis, $kode);


        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
        } else {
            header("location: tambah_group.php?error=insert");
        }

        header("location: home_dosen.php");
    }
    ?>
</body>

</html>