<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$username = $_SESSION['username'];
$idgroup = $_POST['idgrup'];

$judul = $_POST['txtJudul'];
$tanggal = $_POST['txtTanggal'];
$waktu = $_POST['txtWaktu'];
$keterangan = $_POST['txtKeterangan'];
$jenis = $_POST['jenisEvent'];
$poster     = $_FILES['fotoPoster'];


if (empty($poster['name'])) {
    echo "No file selected!";
    exit();
}

$ext = pathinfo($poster['name'], PATHINFO_EXTENSION);

$sql = "SELECT COUNT(*) FROM event WHERE judul = ? and tanggal = ?";
$cek = $mysqli->prepare($sql);
$cek->bind_param('ss', $judul, $tanggal);
$cek->execute();
$cek->bind_result($count);
$cek->fetch();
$cek->close();


if ($count > 0) {
    header("location: tambah_event.php?error=judul");
    exit();
} else {
    $judulSlug = strtolower(str_replace(" ", "-", $judul));
    $tanggalEvent = $tanggal . " " . $waktu;

    $sql = "INSERT INTO event (idgrup, judul, `judul-slug`, tanggal, keterangan, jenis, poster_extension)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssss', $idgroup, $judul, $judulSlug, $tanggalEvent, $keterangan, $jenis, $ext);

    if ($stmt->execute()) {
        $idevent = $stmt->insert_id;
        move_uploaded_file($poster['tmp_name'], "foto_poster/" . $idevent . "." . $ext);

        echo "Data berhasil disimpan!";
    } else {
        header("location: tambah_event.php?error=insert");
    }

    header("location: detail_group.php?idgrup=$idgroup&username=$username");
}
