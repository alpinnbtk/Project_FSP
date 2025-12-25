<?php
session_start();

require_once("Class/chat.php");

$idthread = $_POST['idthread'];
$isi = $_POST['isi'];
$username = $_SESSION['username'];

$chat = new chat();
$response = $chat->kirimChat($idthread, $username, $isi);

if ($response) {
    echo "success";
} else {
    echo "error";
}
