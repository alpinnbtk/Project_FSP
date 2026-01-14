<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
</head>

<body>
    <h2> Edit Data Mahasiswa</h2><br>
    <?php
    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    //     exit();
    // }

    require_once("Class/mahasiswa.php");

    $mahasiswa = new mahasiswa();

    $nrp_awal = $_POST['nrp_awal'];
    $nama    = $_POST['txtNama'];
    $gender = $_POST['genderMhs'];
    $tanggal_lahir = $_POST['txtTanggalLahir'];
    $angkatan = $_POST['txtAngkatan'];
    $foto     = $_FILES['fotoBaru'];;

    $data = [
        'nrp_awal' => $nrp_awal,
        'nama' => $nama,
        'gender' => $gender,
        'tanggal_lahir' => $tanggal_lahir,
        'angkatan' => $angkatan,
    ];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

    $response = $mahasiswa->editMahasiswa($data, $foto);

    if ($response) {
        if (!empty($foto['name'])) {
            $pathFoto = "foto_mahasiswa/" . $nrp_awal . "." . $ext;
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }
            move_uploaded_file($foto['tmp_name'], $pathFoto);
        }
        echo "Berhasil mengubah data!<br>";
    } else {
        echo "Gagal mengubah data!<br>";
    }

    echo "<a href = 'tabel_data_mahasiswa.php'>Kembali ke Tabel Data</a><br>";
    echo "<td><a href='edit_data_mahasiswa.php?nrp=" . $nrp_awal . "'>Kembali ke Halaman Edit</a></td>";

    ?>
</body>

</html>