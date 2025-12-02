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
    $sqlCek = "SELECT COUNT(*) FROM member_grup WHERE username = ? AND idgrup = ?";
    $cek = $mysqli->prepare($sqlCek);
    $cek->bind_param('ss', $username, $row['idgrup']);
    $cek->execute();
    $cek->bind_result($count);
    $cek->fetch();
    $cek->close();

    if ($count > 0) {
        header("location: gabung_group.php?error=idgrup");
        exit();
    } else {
        $sqlInsert = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";
        $stmtInsert = $mysqli->prepare($sqlInsert);
        $stmtInsert->bind_param('ss', $row['idgrup'], $username);

        if ($stmtInsert->execute()) {
            echo "Berhasil join group!<br>";
            echo "<a href = 'home_mahasiswa.php'>Kembali ke Home</a>";
        }
    }
} else {
    header("location: gabung_group.php?error=invalid");
}
