<?php
session_start();
require_once("Class/member_group.php");

$username = $_SESSION['username'];
$idgrup   = $_GET['idgrup'];

$member = new member_group();
$result = $member->keluarGroup($username, $idgrup);

if ($result) {
    echo "Berhasil keluar dari group!<br>";
    echo "<a href='home_mahasiswa.php'>Kembali ke Home</a>";
}
