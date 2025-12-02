<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$username = $_SESSION['username'];
$idgrup = $_POST["idgrup"];
$nama = $_POST['txtNama'];
$jenis = $_POST['jenisGroup'];

$sql = "UPDATE grup SET nama = ?, jenis = ? WHERE idgrup = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sss', $nama, $jenis, $idgrup);


if ($stmt->execute()) {
    echo "Data berhasil diubah!<br>";
    header("location: kelola_group_dosen.php?username=$username");
} else {
    echo "Error: " . $stmt->error . "<br>";
}


$stmt->close();
$mysqli->close();
