<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
</head>

<body>
    <?php

    require_once("Class/dosen.php");

    $dosen = new dosen();

    $npk    = $_POST['txtNPK'];
    $nama    = $_POST['txtNama'];
    $foto     = $_FILES['fotoDosen'];
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'npk' => $npk,
        'nama' => $nama,
        'ext' => $ext,
        'username' => $username,
        'password' => $hash_password
    ];

    $targetFile = "foto_dosen/" . $npk . "." . $ext;

    if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
        $response = $dosen->insertDosen($data);

        if ($response == "success") {
            header("location: tabel_data_dosen.php");
        } else if ($response == "duplicate") {
            unlink($target_file);
            header("location:tambah_data_dosen.php?error=npk");
        } else {
            unlink($target_file);
            header("location:tambah_data_dosen.php?error=insert");
        }
    } else {
        header("location:tambah_data_dosen.php?error=upload");
    }
    ?>
</body>

</html>