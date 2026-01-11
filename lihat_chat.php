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

            margin-bottom: 40px;
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
            margin: 10px 0px;
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

        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;

        }

        #txtChat {
            flex: 1;
        }

        .btnKirim {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .chatInput {
            display: flex;
            justify-content: center;
            position: fixed;
            bottom: 5px;
            left: 0;
            width: 100%;
        }

        #warning {
            color: red;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 768px) {

            body {
                padding: 10px;
            }

            #chatBox {
                margin-bottom: 80px;
            }

            .chatUser,
            .chatLain {
                max-width: 85%;
                font-size: 14px;
            }

            .chatInput {
                padding: 5px;
                box-sizing: border-box;
            }

            #txtChat {
                font-size: 14px;
                padding: 8px;
            }

            .btnKirim {
                font-size: 14px;
                padding: 8px 14px;
            }

            h2 {
                text-align: center;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 8px;
            }

            #chatBox {
                margin-bottom: 90px;
            }

            .chatUser,
            .chatLain {
                max-width: 90%;
                font-size: 13px;
                padding: 8px;
            }

            #username {
                font-size: 13px;
            }

            #waktuKirim {
                font-size: 11px;
            }

            .chatInput {
                padding: 6px;
                background: #f4f6f9;
                border-top: 1px solid #ccc;
            }

            #txtChat {
                font-size: 13px;
                padding: 8px;
            }

            .btnKirim {
                font-size: 13px;
                padding: 8px 12px;
            }

            h2 {
                font-size: 18px;
                text-align: center;
            }
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
        echo "<button class='btnKirim'>Kirim</button>";
        echo "</div>";
    } else {
        echo "<p id='warning'>Thread ini telah ditutup!</p>";
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

                    if (item.nama_dosen == null) {
                        html += "<p id='username'>" + item.nama_mahasiswa + "</p>";

                    } else {
                        html += "<p id='username'>" + item.nama_dosen + "</p>";

                    }
                    // html += "<p id='username'>" + item.username_pembuat + "</p>";
                    html += "<p>" + item.isi + "</p>";
                    html += "<p id='waktuKirim'>" + item.tanggal_pembuatan + "</p>";
                    html += "</div>";
                });

                $("#chatBox").html(html);
            });
        }

        setInterval(ambilChat, 2000);
        ambilChat();

        $('body').on('click', '.btnKirim', function() {
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