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
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $npk    = $_POST['txtNPK'];
        $nama    = $_POST['txtNama'];   
        $foto     = $_FILES['fotoBaru']; 

        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

        $sql = "UPDATE dosen SET npk = ?, nama = ?, foto_extension = ? WHERE npk = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('ssss', $npk, $nama, $ext, $npk);

        if (isset($foto) && file_exists("foto_dosen/".$npk.".".$ext)) {
            unlink("foto_dosen/".$npk.".".$ext);
        }
        move_uploaded_file($foto['tmp_name'], "foto_dosen/".$npk.".".$ext);

        if ($stmt->execute()) {
            echo "Data berhasil diubah!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    ?>
</body>
</html>