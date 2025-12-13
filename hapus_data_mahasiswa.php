<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Mahasiswa</title>
</head>

<body>
    <h2> Hapus Data Mahasiswa</h2><br>
    <?php
    require_once("Class/mahasiswa.php");

    $mahasiswa = new mahasiswa();

    $nrp_mahasiswa = $_GET['nrp'];
    $ext = $_GET['ext'];

    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    //     exit();
    // }

    // $sql = "DELETE FROM mahasiswa WHERE nrp = ?";
    // $stmt = $mysqli->prepare($sql);

    // $stmt->bind_param('i', $nrp_mahasiswa);

    $response = $mahasiswa->deleteMahasiswa($nrp_mahasiswa);

    if ($reponse) {
        $pathFoto = "foto_mahasiswa/" . $nrp_mahasiswa . "." . $ext;

        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }


    // if ($stmt->execute()) {
    //     echo "Data berhasil dihapus!";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

    // $stmt->close();
    // $mysqli->close();

    header("location: tabel_data_mahasiswa.php");
    ?>
</body>

</html>