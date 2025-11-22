<?php
$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$idgroup = $_GET['idgroup'];

$judul = $_POST['txtJudul'];
$tanggal = $_POST['txtTanggal'];
$keterangan = $_POST['txtKeterangan'];
$jenis = $_POST['jenisGroup'];
$kode = $_POST['txtKode'];
$poster     = $_FILES['fotoPoster'];

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
    $judulSlug = strtolower(str_replace(" ", "-", $judulSlug));

    $sql = "INSERT INTO event (id_grup, judul, judul-slug, tanggal, keterangan, jenis, poster_extension)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssss', $idgroup, $judul, $judulSlug, $tanggal, $keterangan, $jenis, $ext);

    move_uploaded_file($poster['tmp_name'], "foto_psoter/" . $judul . "." . $ext);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        header("location: tambah_event.php?error=insert");
    }

    header("location: detail_group.php");
}
