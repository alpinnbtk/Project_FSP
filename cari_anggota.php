<?php
require_once("class/mahasiswa.php");
require_once("class/dosen.php");

$peran  = $_POST['peran'];
$prompt = $_POST['prompt'];

$data = [];

if ($peran == "mahasiswa") {

    $mhs = new mahasiswa();
    $res = $mhs->cariMahasiswa($prompt);

    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
} else if ($peran == "dosen") {

    $dsn = new dosen();
    $res = $dsn->cariDosen($prompt);

    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
