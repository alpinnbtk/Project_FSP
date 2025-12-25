<?php
session_start();

require_once("Class/chat.php");

$idthread = $_POST['idthread'];

$chat = new chat();
$dataChat = $chat->getChat($idthread);

$arrChat = [];

if ($dataChat) {
    while ($row = $dataChat->fetch_assoc()) {
        $arrChat[] = $row;
    }
}

echo json_encode($arrChat);
