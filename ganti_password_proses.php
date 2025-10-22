<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$stmt = $mysqli->prepare('SELECT * FROM akun WHERE username = ?');
$stmt->bind_param("s", $_SESSION['username']); 
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$is_authenticated = password_verify($_POST['pwdSekarang'], $row['password']);

if ($is_authenticated) {
    $sql = "UPDATE akun SET password = ? WHERE username = ?";
    $stmtGanti = $mysqli->prepare($sql);

    $hash_password = password_hash($_POST['pwdBaru'], PASSWORD_DEFAULT);
    $stmtGanti->bind_param("ss", $hash_password, $_SESSION['username']);

    $stmtGanti->execute();

    $stmtGanti->close();
    $mysqli->close();

    echo "<p>Berhasil ganti password</p>";
    echo "<br />";
    echo "<a href = 'ganti_password.php'>Kembali ke ganti password</a>";
    echo "<a href = 'home.php'>Kembali ke Home</a>";
} else {
    echo "<p>Password anda salah!</p>";
}
?>
