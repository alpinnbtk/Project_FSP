<?php
session_start();
require_once("Class/event.php");

$idevent  = $_GET['idevent'];
$idgroup  = $_GET['idgroup'];
$ext      = $_GET['ext'];
$username = $_SESSION['username'];

$event = new event();
$result = $event->deleteEvent($idevent);

if ($result) {
    unlink("foto_poster/" . $idevent . "." . $ext);
}

header("location: detail_group_dosen.php?idgrup=" . $idgroup . "&username=" . $username);
