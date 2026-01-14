<?php
$peran = $_POST['peran'];

$result = [];

$searched = "";


$conn = new mysqli("localhost", "root", "", "fullstack");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($peran == "mahasiswa") {
    if ($searched != '') {
        $sql = "SELECT nrp, nama, foto_extention, a.username FROM mahasiswa m LEFT JOIN akun a ON a.nrp_mahasiswa = m.nrp WHERE nrp LIKE ? OR nama LIKE ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $searched, $searched);
    } else {
        $sql = "SELECT nrp, nama, foto_extention, a.username FROM mahasiswa m LEFT JOIN akun a ON a.nrp_mahasiswa = m.nrp;";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $item = array("id" => $row['nrp'], "nama" => $row['nama'], "username" => $row['username'], "foto" => $row['foto_extention']);
        $result[] = $item;
    }
} else {
    $sql = "SELECT npk, nama, foto_extension, a.username FROM dosen d LEFT JOIN akun a ON a.npk_dosen = d.npk;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $item = array("id" => $row['npk'], "nama" => $row['nama'], "username" => $row['username'], "foto" => $row['foto_extension']);
        $result[] = $item;
    }
}

echo json_encode($result);
