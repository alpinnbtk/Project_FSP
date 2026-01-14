<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

require_once("Class/akun.php");

$akun = new akun();

$username = $_SESSION['username'];
$password = $_POST['pwdSekarang'];
$passwordBaru = $_POST['pwdBaru'];

$response = $akun->gantiPassword($username, $password, $passwordBaru);

if ($response == "success") {
    echo "<h1>Berhasil mengganti password!</h1>";
    echo "<br>";
    echo "<a href = 'ganti_password.php'>Kembali ke ganti password</a><br>";
    echo "<a href = 'home.php'>Kembali ke Home</a>";
} else {
    echo "<p>Password anda salah!</p>";
}
