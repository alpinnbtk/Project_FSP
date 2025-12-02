<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Grup</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }


        .detail-box {
            background: #fffdf8ff;
            padding: 20px 30px;
            border-radius: 10px;
            width: 900px;
            margin: 30px auto;
        }

        #member {
            width: 40%;
        }

        #event {
            width: 60%;

        }

        .back-btn {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .back-btn:hover {
            background: #45a049;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }

        $idgroup = $_GET['idgrup'];
        $username = $_GET['username'];

        // ========== DETAIL GRUP ==========

        $sql = "SELECT * FROM grup WHERE idgrup = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $idgroup);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {

            echo "<div>";
            echo "<h2>Detail Grup: " . $row['nama'] . "</h2>";

            echo "<ul>";
            echo "<li>Dibuat Oleh : " . $row['username_pembuat'] . "</li>";
            echo "<li>Tanggal Dibuat : " . $row['tanggal_pembentukan'] . "</li>";
            echo "<li>Deskripsi : " . $row['deskripsi'] . "</li>";
            echo "<li>Kode Pendaftaran : " . $row['kode_pendaftaran'] . "</li>";

            // Hitung jumlah anggota
            $sql = "SELECT COUNT(*) FROM member_grup WHERE idgrup = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $idgroup);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            echo "<li>Jumlah Anggota : " . $count . "</li><br>";
            echo "</ul>";
        }
        echo "<a href='kelola_group_mahasiswa.php?username='" . $_SESSION['username'] . "' class='back-btn'>Kembali</a>";
        ?>


    </div>

</body>

</html>