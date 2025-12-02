<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$idgroup = $_GET['idgroup'];
$username = $_SESSION['username'];

$idevent = $_POST['idevent'];
$judul = $_POST['txtJudul'];
$tanggal = $_POST['txtTanggal'];
$waktu = $_POST['txtWaktu'];
$keterangan = $_POST['txtKeteranganBaru'];
$jenis = $_POST['jenisEvent'];
$poster = $_FILES['posterBaru'];

$ext = pathinfo($poster['name'], PATHINFO_EXTENSION);

$judulSlug = strtolower(str_replace(" ", "-", $judul));
$tanggalEvent = $tanggal . " " . $waktu;
if (!empty($poster['name'])) {
    $sql = "UPDATE event SET judul = ?, `judul-slug` = ?, tanggal = ?, keterangan = ?, jenis = ?, poster_extension = ?  WHERE idevent = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssss', $judul, $judulSlug, $tanggalEvent, $keterangan, $jenis, $ext, $idevent);

    if (isset($poster) && file_exists("foto_poster/" . $idevent . "." . $ext)) {
        unlink("foto_poster/" . $idevent . "." . $ext);
    }
    move_uploaded_file($poster['tmp_name'], "foto_poster/" . $idevent . "." . $ext);
} else {
    $sql = "UPDATE event SET judul = ?, `judul-slug` = ?, tanggal = ?, keterangan = ?, jenis = ?  WHERE idevent = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssss', $judul, $judulSlug, $tanggalEvent, $keterangan, $jenis, $idevent);
}

if ($stmt->execute()) {
    echo "Data berhasil diubah!<br>";
    header("location: detail_group_dosen.php?idgrup=$idgroup&username=$username");
} else {
    echo "Error: " . $stmt->error . "<br>";
}


$stmt->close();
$mysqli->close();
