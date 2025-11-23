<?php
$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$username = $_GET['username'];
$idgrup = $_GET['idgrup'];

$sql = "delete from member_grup where username = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

header("location: anggota_group.php?idgrup=$idgrup");
