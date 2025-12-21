<?php
require_once("Class/member_group.php");

$username = $_GET['username'];
$idgrup   = $_GET['idgrup'];

$member = new member_group();
$member->hapusMember($username);

header("location: anggota_group_dosen.php?idgrup=$idgrup");
