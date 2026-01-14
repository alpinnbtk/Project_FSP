<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
</head>

<body>
    <h2> Edit Data Dosen</h2><br>
    <?php

    require_once("Class/dosen.php");
    $dosen = new dosen();

    $npk_awal = $_POST['npk_awal'];
    $npk_baru    = $_POST['txtNPK'];
    $nama    = $_POST['txtNama'];
    $foto     = $_FILES['fotoBaru'];

    $data = [
        'npk_awal' => $npk_awal,
        'npk_baru' => $npk_baru,
        'nama' => $nama,
    ];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

    $response = $dosen->editDosen($data, $foto);

    if ($response) {
        if (!empty($foto['name'])) {
            $pathFoto = "foto_dosen/" . $npk_awal . "." . $ext;
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }
            move_uploaded_file($foto['tmp_name'], $pathFoto);
        }
        echo "Berhasil mengubah data!<br>";
    } else {
        echo "Gagal mengubah data!<br>";
    }

    echo "<a href = 'tabel_data_dosen.php'>Kembali ke Tabel Data</a><br>";
    echo "<a href = 'edit_data_dosen.php?npk=" . $npk_awal . "'>Kembali ke Halaman Edit</a><br>";

    ?>
</body>

</html>