<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Tambah Group</title>
</head>

<body>
    <?php

    require_once("Class/group.php");

    $group = new group();

    $data = [
        'username' => $_SESSION['username'],
        'namaGroup' => $_POST['txtNamaGroup'],
        'deskripsi' => $_POST['txtDeskripsi'],
        'tanggal' => date("Y-m-d H:i:s"),
        'jenis' => $_POST['jenisGroup'],
    ];

    $response = $group->tambahGroup($data);

    if ($response == "success") {
        header("location: home_dosen.php");
    } else if ($response == "duplicate") {
        header("location: tambah_group.php?error=namaGroup");
    } else {
        header("location: tambah_group.php?error=insert");
    }

    ?>
</body>

</html>