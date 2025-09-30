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
    $npk_awal = $_POST['npk_awal'];
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $npk_baru    = $_POST['txtNPK'];
    $nama    = $_POST['txtNama'];
    $foto     = $_FILES['fotoBaru'];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

    if (!empty($foto['name'])) {
        $sql = "UPDATE dosen SET nama = ?, foto_extension = ? WHERE npk = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('sss', $nama, $ext, $npk_awal);

        if (isset($foto) && file_exists("foto_dosen/" . $npk_baru . "." . $ext)) {
            unlink("foto_dosen/" . $npk_baru . "." . $ext);
        }
        move_uploaded_file($foto['tmp_name'], "foto_dosen/" . $npk_baru . "." . $ext);
    } else {
        $sql = "UPDATE dosen SET nama = ? WHERE npk = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('ss', $nama, $npk_awal);
    }

    if ($stmt->execute()) {
        echo "Data berhasil diubah!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    echo "<a href = 'tabel_data_dosen.php'>Kembali ke Tabel Data</a><br>";
    echo "<a href = 'edit_data_dosen.php'>Kembali ke Halaman Edit</a><br>";

    $stmt->close();
    $mysqli->close();
    ?>
</body>

</html>