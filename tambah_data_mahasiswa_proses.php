<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <?php

    require_once("Class/mahasiswa.php");

    $mahasiswa = new mahasiswa();

    $nrp    = $_POST['txtNRP'];
    $nama    = $_POST['txtNama'];
    $gender = $_POST['genderMhs'];
    $tanggal_lahir = $_POST['txtTanggalLahir'];
    $angkatan = $_POST['txtAngkatan'];
    $foto     = $_FILES['fotoMahasiswa'];
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'nrp' => $nrp,
        'nama' => $nama,
        'gender' => $gender,
        'tanggal_lahir' => $tanggal_lahir,
        'angkatan' => $angkatan,
        'ext' => $ext,
        'username' => $username,
        'password' => $hash_password
    ];

    $targetFile = "foto_mahasiswa/" . $nrp . "." . $ext;

    if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
        $response = $mahasiswa->insertMahasiswa($data);

        if ($response == "success") {
            header("location: tabel_data_mahasiswa.php");
        } else if ($response == "duplicate") {
            unlink($target_file);
            header("location:tambah_data_mahasiswa.php?error=nrp");
        } else {
            unlink($target_file);
            header("location:tambah_data_mahasiswa.php?error=insert");
        }
    } else {
        header("location:tambah_data_mahasiswa.php?error=upload");
    }
    ?>
</body>

</html>