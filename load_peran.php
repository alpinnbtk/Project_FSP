<?php
$peran = $_POST['peran'];

$result = [];

$searched = "";


$conn = new mysqli("localhost", "root", "", "fullstack");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($peran == "mahasiswa") {
    if ($searched != '') {
        $sql = "select nrp, nama, a.username from mahasiswa m left join akun a on a.nrp_mahasiswa = m.nrp where nrp like ? or nama like ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $searched, $searched);
    } else {
        $sql = "select nrp, nama, a.username from mahasiswa m left join akun a on a.nrp_mahasiswa = m.nrp;";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $item = array("id" => $row['nrp'], "nama" => $row['nama'], "username" => $row['username']);
        $result[] = $item;
    }
} else {
    $sql = "select npk, nama, a.username from dosen d left join akun a on a.npk_dosen = d.npk;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $item = array("id" => $row['npk'], "nama" => $row['nama'], "username" => $row['username']);
        $result[] = $item;
    }
}

echo json_encode($result);
