<?php
session_start();
require_once("Class/group.php");

$username = $_SESSION['username'];
$idgrup   = $_POST['idgrup'];
$nama     = $_POST['txtNama'];
$jenis    = $_POST['jenisGroup'];

$group = new group();

if ($group->updateGroup($idgrup, $nama, $jenis)) {
    header("location: kelola_group_dosen.php?username=$username");
    exit();
} else {
    echo "Gagal mengubah data group!";
}
