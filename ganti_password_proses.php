<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$stmt = $mysqli->prepare('SELECT * FROM akun WHERE username = ? and password = ?');
$stmt->bind_param("ss", $_SESSION['username'], $_POST['pwdSekarang']); // "i" = integer
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "update akun set password = ? where username = ?";
    $stmtGanti = $mysqli->prepare($sql);

    $stmtGanti->bind_param("ss", $_POST['pwdBaru'], $_SESSION['username']);

    $stmtGanti->execute();

    $stmtGanti->close();
    $mysqli->close();

    echo "<p>Berhasil ganti password</p>";
    echo "<br />";
    echo "<a href='ganti_password.php'>Kembali ke ganti password</a>";
} else {
    echo "<p>Password anda salah!</p>";
}
