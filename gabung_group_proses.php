<?php
session_start();
require_once("Class/group.php");
require_once("Class/member_group.php");

$username = $_SESSION['username'];
$kode     = $_POST['txtKode'];

$group  = new group();
$member = new member_group();

$res = $group->getGroupByKode($kode);

if ($row = $res->fetch_assoc()) {

    $idgrup = $row['idgrup'];

    if ($member->isMember($username, $idgrup)) {
        header("location: gabung_group.php?error=idgrup");
        exit();
    }

    if ($member->joinGroup($username, $idgrup)) {
        header("location: home_mahasiswa.php");
        exit();
    } else {
        echo "Gagal join group!";
    }
} else {
    header("location: gabung_group.php?error=invalid");
    exit();
}
