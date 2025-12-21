<?php
session_start();
require_once("Class/event.php");

$idgroup  = $_GET['idgroup'];
$username = $_SESSION['username'];

$idevent     = $_POST['idevent'];
$judul       = $_POST['txtJudul'];
$tanggal     = $_POST['txtTanggal'];
$waktu       = $_POST['txtWaktu'];
$keterangan  = $_POST['txtKeteranganBaru'];
$jenis       = $_POST['jenisEvent'];
$poster      = $_FILES['posterBaru'];

$judulSlug    = strtolower(str_replace(" ", "-", $judul));
$tanggalEvent = $tanggal . " " . $waktu;

$event = new event();

if (!empty($poster['name'])) {
    $ext = pathinfo($poster['name'], PATHINFO_EXTENSION);

    if (file_exists("foto_poster/" . $idevent . "." . $ext)) {
        unlink("foto_poster/" . $idevent . "." . $ext);
    }

    move_uploaded_file(
        $poster['tmp_name'],
        "foto_poster/" . $idevent . "." . $ext
    );

    $result = $event->updateEvent(
        $idevent,
        $judul,
        $judulSlug,
        $tanggalEvent,
        $keterangan,
        $jenis,
        $ext
    );
} else {
    $result = $event->updateEvent(
        $idevent,
        $judul,
        $judulSlug,
        $tanggalEvent,
        $keterangan,
        $jenis
    );
}

if ($result) {
    header("location: detail_group_dosen.php?idgrup=$idgroup&username=$username");
} else {
    echo "Gagal mengubah data event";
}
