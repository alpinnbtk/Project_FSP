<?php
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $username = $_SESSION['username'];

    $sql = "DELETE FROM member_grup WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);

    if ($stmt->execute()) {
        echo "Berhasil keluar dari group!<br>";
        echo "<a href = 'home_mahasiswa.php'>Kembali ke Home</a>";
    }
?>
