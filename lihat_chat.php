<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

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
    $chat = new chat();

    $idThread = $_GET['idthread'];

    $dataChat = $chat->getChat($idThread);

    if ($dataChat) {
        echo "<table> 
                <tr> 
                    <th>ID Chat</th> 
                    <th>Username Pembuat</th> 
                    <th>Isi</th>
                    <th>Tanggal Pembuatan</th> 
                </tr>";

        while ($row = $dataChat->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idchat'] . "</td>";
            echo "<td>" . $row['username_pembuat'] . "</td>";
            echo "<td>" . $row['isi'] . "</td>";
            echo "<td>" . $row['tanggal_pembuatan'] . "</td>";

            echo "<td><a href='lihat_chat.php?idthread=" .  $row['idthread'] . "'>Lihat Chat</a></td>";

            if ($row['username_pembuat'] == $_SESSION['username']) {
                echo "<td><a href='close_thread.php?idthread=" .  $row['idthread'] . "'>Hapus Thread</a></td>";
            } else {
                echo "<td>Tidak ada</td>";
            }
            echo "</tr>";
        }
    }
    ?>

    <a href="buat_thread.php">Buat Thread</a>

</body>

</html>