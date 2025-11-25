<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Tambah Group</title>
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
    $tanggal = date("Y-m-d H:i:s");

    $sql = "SELECT COUNT(*) FROM grup WHERE nama = ? ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $namaGroup);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        header("location: tambah_group.php?error=namaGroup");
        exit();
    } else {
        $sql = "INSERT INTO grup (username_pembuat, nama, deskripsi, tanggal_pembentukan, jenis, kode_pendaftaran)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssssss', $_SESSION['username'], $namaGroup, $deskripsi, $tanggal, $jenis, $kode);


        if ($stmt->execute()) {
            $id = $mysqli->insert_id;
            $kode = "UBAYA" . $id;

            $sqlUpdate = "UPDATE grup SET kode_pendaftaran = ? WHERE idgrup = ?;";
            $stmtUpdate = $mysqli->prepare($sqlUpdate);
            $stmtUpdate->bind_param('si', $kode, $id);
            $stmtUpdate->execute();

            echo "Data berhasil disimpan!";
        } else {
            header("location: tambah_group.php?error=insert");
        }

        header("location: home_dosen.php");
    }
    ?>
</body>

</html>