<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Group</title>
</head>
<body>
    <h2> Hapus Group</h2><br>
    <?php
        $idgroup = $_GET['idgrup'];
        
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $sql = "DELETE FROM grup WHERE idgrup = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('i', $idgroup);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();

        header("location: kelola_group_dosen.php");
    ?>
</body>
</html>