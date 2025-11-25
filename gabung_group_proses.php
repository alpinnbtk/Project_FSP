<?php
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $username = $_SESSION['username'];
    $kode_pendaftaran = $_POST['txtKode'];

    $sql = "SELECT * FROM grup WHERE kode_pendaftaran = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $kode_pendaftaran);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $sql = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $row['idgrup'], $username);

        if ($stmt->execute()) {
            echo "Berhasil join group!<br>";
            echo "<a href = 'home_mahasiswa.php'>Kembali ke Home</a>";
        }
    } else {
        header("location: gabung_group.php?error=invalid");
    }
?>
