<?php
$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$username = $_GET['username'];
$idgrup = $_GET['idgrup'];

$sql = "DELETE FROM member_grup WHERE username = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

header("location: anggota_group_dosen.php?idgrup=$idgrup");
