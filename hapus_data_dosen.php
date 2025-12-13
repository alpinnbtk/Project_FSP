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

    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    //     exit();
    // }

    // $sql = "DELETE FROM dosen WHERE npk = ?";
    // $stmt = $mysqli->prepare($sql);

    // $stmt->bind_param('i', $npk_dosen);

    $response = $dosen->deleteDosen($npk_dosen);

    if ($response) {
        $pathFoto = "foto_dosen/" . $npk_dosen . "." . $ext;

        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }

    // if (file_exists("foto_dosen/" . $npk_dosen . "." . $ext)) {
    //     unlink("foto_dosen/" . $npk_dosen . "." . $ext);
    // }

    // if ($stmt->execute()) {
    //     echo "Data berhasil dihapus!";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

    // $stmt->close();
    // $mysqli->close();

    header("location: tabel_data_dosen.php");

    ?>
</body>

</html>