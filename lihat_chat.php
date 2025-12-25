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

        #chatBox {
            display: flex;
            flex-direction: column;

            margin-bottom: 20px;
            padding: 10px;
        }

        .chatUser {
            align-self: flex-end;
            margin: 10px 0px;
            background-color: #dcf8c6;
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
        }

        .chatLain {
            align-self: flex-start;
            background-color: #d8d8d8ff;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
        }

        #username {
            font-weight: 600;
        }

        #waktuKirim {
            font-size: 12px;
            text-align: right;
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
    // $dataChat = $chat->getChat($idThread);

    $dataThread = $thread->getThreadById($idThread);
    $statusThread = $dataThread['status'];

    $username = $_SESSION['username'];

    ?>

    <a href="lihat_thread.php?idgrup=<?php echo $dataThread['idgrup'] ?>">Kembali</a>


    <div id="chatBox">
    </div>

    <?php
    if ($statusThread == "Open") {
        echo "<div class='chatInput'>";
        echo "<input type='text' id='txtChat' placeholder='Ketik chat'>";
        echo "<button id='btnKirim'>Kirim</button>";
        echo "</div>";
    } else {
        echo "Thread ini telah ditutup!";
    }

    ?>

    <script>
        var id_thread = <?php echo $idThread; ?>;
        var username = "<?php echo $username; ?>";

        function ambilChat() {
            $.post("ambil_chat.php", {
                idthread: id_thread
            }, function(data) {
                var listChat = JSON.parse(data);
                var html = "";

                $.each(listChat, function(i, item) {
                    var tipeChat = item.username_pembuat == username ? "chatUser" : "chatLain";

                    html += "<div class='" + tipeChat + "'>";
                    html += "<p id='username'>" + item.username_pembuat + "</p>";
                    html += "<span>" + item.isi + "</span>";
                    html += "<p id='waktuKirim'>" + item.tanggal_pembuatan + "</p>";
                    html += "</div>";
                });

                $("#chatBox").html(html);
            });
        }

        setInterval(ambilChat, 2000);
        ambilChat();

        $('body').on('click', '#btnKirim', function() {
            var chat = $("#txtChat").val();

            if (chat.trim() != "") {
                $.post("kirim_chat.php", {
                    idthread: id_thread,
                    isi: chat
                }).done(function() {
                    $("#txtChat").val("");
                })
            }

        });
    </script>

</body>

</html>