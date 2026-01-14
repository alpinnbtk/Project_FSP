<?php
session_start();
require_once("Class/event.php");

$username = $_SESSION['username'];
$idgroup  = $_POST['idgrup'];

$judul      = $_POST['txtJudul'];
$tanggal    = $_POST['txtTanggal'];
$waktu      = $_POST['txtWaktu'];
$keterangan = $_POST['txtKeterangan'];
$jenis      = $_POST['jenisEvent'];
$poster     = $_FILES['fotoPoster'];

if (empty($poster['name'])) {
    header("location: tambah_event.php?error=upload");
    exit();
}

$ext = pathinfo($poster['name'], PATHINFO_EXTENSION);

$judulSlug   = strtolower(str_replace(" ", "-", $judul));
$tanggalEvent = $tanggal . " " . $waktu;

$data = [
    'idgrup' => $idgroup,
    'judul' => $judul,
    'slug' => $judulSlug,
    'tanggal' => $tanggal,
    'tanggal_event' => $tanggalEvent,
    'keterangan' => $keterangan,
    'jenis' => $jenis,
    'ext' => $ext
];

$event = new event();
$result = $event->insertEvent($data);

if ($result === "duplicate") {
    header("location: tambah_event.php?error=judul");
    exit();
} else if ($result === "gagal") {
    header("location: tambah_event.php?error=insert");
    exit();
}

$targetFile = "foto_poster/" . $result . "." . $ext;
move_uploaded_file($poster['tmp_name'], $targetFile);

header("location: detail_group_dosen.php?idgrup=$idgroup&username=$username");
