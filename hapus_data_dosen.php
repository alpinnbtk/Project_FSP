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
        $npk_dosen = $_GET['npk'];
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $sql = "DELETE FROM dosen WHERE npk = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('i', $npk_dosen);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();

    ?>
</body>
</html>