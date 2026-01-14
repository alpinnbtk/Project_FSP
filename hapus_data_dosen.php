<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Dosen</title>
</head>

<body>
    <h2> Hapus Data Dosen</h2><br>
    <?php
    require_once("Class/dosen.php");

    $dosen = new dosen();

    $npk_dosen = $_GET['npk'];
    $ext = $_GET['ext'];

    $response = $dosen->deleteDosen($npk_dosen);

    if ($response) {
        $pathFoto = "foto_dosen/" . $npk_dosen . "." . $ext;

        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }

    header("location: tabel_data_dosen.php");

    ?>
</body>

</html>