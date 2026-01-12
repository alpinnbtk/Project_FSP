<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread</title>
    <link rel="stylesheet" href="theme.css">

    <style>
        body {
            background: var(--bg-color);
            font-family: Arial;
        }

        h2 {
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        a {
            color: var(--text-secondary);
        }

        table,
        th,
        tr,
        td {
            border: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-primary);
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        @media (max-width: 768px) {

            body {
                padding: 15px;
            }

            table {
                width: 100%;
                display: block;
                overflow-x: auto;
                font-size: 14px;
            }

            th,
            td {
                padding: 8px;
            }

            h2 {
                text-align: center;
            }

            a {
                font-size: 14px;
                display: inline-block;
                margin: 5px 0;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 10px;
            }

            table {
                font-size: 13px;
            }

            th,
            td {
                padding: 6px;
            }

            h2 {
                font-size: 18px;
                text-align: center;
            }

            a {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <h2>Semua Thread</h2>

    <?php
    session_start();

    require_once("Class/thread.php");
    $thread = new thread();

    $idGroup = $_GET['idgrup'];

    $dataThread = $thread->getThread($idGroup);

    if ($dataThread) {
        echo "<table> 
                <tr> 
                    <th>ID Thread</th> 
                    <th>Username Pembuat</th> 
                    <th>Tanggal Pembuatan</th> 
                    <th>Status</th>
                    <th>Chat</th>
                    <th>Aksi</th>
                </tr>";

        while ($row = $dataThread->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idthread'] . "</td>";
            echo "<td>" . $row['username_pembuat'] . "</td>";
            echo "<td>" . $row['tanggal_pembuatan'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";

            echo "<td><a href='lihat_chat.php?idgrup=" . $idGroup . "&idthread=" .  $row['idthread'] . "'>Lihat Chat</a></td>";

            if ($row['username_pembuat'] == $_SESSION['username']) {
                echo "<td><a href='close_thread.php?idgrup=" . $idGroup . "&idthread=" .  $row['idthread'] . "'>Close Thread</a></td>";
            } else {
                echo "<td>---</td>";
            }
            echo "</tr>";
        }
    }

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'insert') {
            echo "<div style='color:red; font-weight:bold;'>Gagal membuat thread!</div>";
        } else if ($_GET['error'] == 'delete') {
            echo "<div style='color:red; font-weight:bold;'>Gagal menutup thread!</div>";
        }
    }
    ?>

    <?php
    if ($_SESSION['role'] == 'dosen') {
        echo "<a href='kelola_group_dosen.php?username=" . $_SESSION['username'] . "'>Kembali</a>";
    } else if ($_SESSION['role'] == 'mahasiswa') {
        echo "<a href='kelola_group_mahasiswa.php?username=" . $_SESSION['username'] . "'>Kembali</a>";
    }
    ?>

    <br>
    <a href="tambah_thread.php?idgrup=<?php echo $idGroup ?>">Buat Thread</a>


</body>

</html>