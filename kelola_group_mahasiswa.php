<?php
session_start();
require_once("Class/group.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Group Mahasiswa</title>
    <link rel="stylesheet" href="theme.css">

    <style>
        body {
            background: var(--bg-color);
            font-family: Arial;
        }

        form {
            background: var(--form-bg);
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        h2,
        p {
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        input {
            border-radius: 6px;
            padding: 7px;
            margin: 6px;
            color: var(--text-primary);

        }

        label {
            text-align: left;
            color: var(--text-primary);
        }

        table,
        th,
        tr,
        td {
            border: 1px solid var(--border-color);
        }

        table {
            border-collapse: collapse;

        }

        th,
        td {
            padding: 10px;
            color: var(--text-primary);
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
                color: var(--text-secondary);
                font-size: 14px;
                display: inline-block;
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
                color: var(--text-secondary);
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <h2>Semua Group</h2>

    <?php
    $group = new group();
    $res = $group->getGroupByMember($_SESSION['username']);

    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>ID Group</th> 
                    <th>Nama Group</th> 
                    <th>Detail</th> 
                    <th>Anggota</th>
                    <th>Event</th>
                    <th>Thread</th>
                    <th>Aksi</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idgrup'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";

            echo "<td><a href='detail_group_mahasiswa.php?idgrup=" . $row['idgrup'] . "&username=" . $_SESSION['username'] . "'>Detail Group</a></td>";
            echo "<td><a href='anggota_group_mahasiswa.php?idgrup=" . $row['idgrup'] . "'>Lihat Anggota Group</a></td>";
            echo "<td><a href='event_group_mahasiswa.php?idgrup=" . $row['idgrup'] . "'>Event Group</a></td>";
            echo "<td><a href='lihat_thread.php?idgrup=" .  $row['idgrup'] . "'>Lihat Thread</a></td>";
            echo "<td><a href='keluar_group.php?idgrup=" . $row['idgrup'] . "'>Keluar dari Group</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Anda belum memiliki grup.</p>";
    }
    ?>

    <a href="home_mahasiswa.php" id='kembali'>Kembali</a>
</body>

</html>