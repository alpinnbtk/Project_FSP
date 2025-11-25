<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$idevent = $_GET['idevent'];
$idgroup = $_GET['idgroup'];
$ext = $_GET['ext'];
$username = $_SESSION['username'];

$sql = "DELETE FROM event WHERE idevent = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $idevent);

if ($stmt->execute()) {
    unlink("foto_poster/" . $idevent . "." . $ext);
}

header("location: detail_group.php?idgrup=" . $idgroup . "&username=" . $username);
