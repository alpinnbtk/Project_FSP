<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h2>Semua Chat</h2>

    <?php
    session_start();

    require_once("Class/chat.php");
    require_once("Class/thread.php");

    $chat = new chat();
    $thread = new thread();

    $idThread = $_GET['idthread'];
    $dataChat = $chat->getChat($idThread);

    $dataThread = $thread->getThreadById($idThread);
    $statusThread = $dataThread['status'];

    ?>

    <a href="lihat_thread.php?idgrup=<?php echo $dataThread['idgrup'] ?>">Kembali</a>


    <div id="chat-box">
    </div>

    <?php
    if ($statusThread == "Open") {
        echo "<div class='chatInput'>";
        echo "<input type='text' id='txtChat' placeholder='Ketik chat'>";
        echo "<button id='btnKirim'>Kirim</button>";
        echo "</div>";
    } else {
        echo "Ditutup Oeyy!";
    }

    ?>

</body>

</html>