<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Group Mahasiswa</title>
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: left;
            width: 900px;
        }

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

        form {
            margin-bottom: 20px;
        }

        img {
            width: 150px;
            height: 200px;
        }


        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;

        }

        .btnSearch {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .btnSearch:hover {
            background: #45a049;
        }

        #page {
            margin-top: 70px;
            text-align: center;
        }

        #page a {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid green;
            text-decoration: none;
            color: green;
        }


        #page a:hover {
            background-color: #e6ffe6;
        }

        #page span.active {
            background-color: #00b900ff;
            color: white;
            font-weight: bold;
            cursor: default;
            padding: 6px 11px;
        }
    </style>
</head>

<body>
    <h2>Semua Group</h2>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $sql = "SELECT * FROM grup g INNER JOIN member_grup m ON g.idgrup = m.idgrup WHERE m.username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>ID Group</th> 
                    <th>Nama Group</th> 
                    <th>Detail</th> 
                    <th>Anggota</th>
                    <th>Event</th>
                    <th>Aksi</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idgrup'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";

            echo "<td><a href='detail_group_mahasiswa.php?idgrup=" . $row['idgrup'] . "&username=" . $_SESSION['username'] . "'>Detail Group</a></td>";
            echo "<td><a href='anggota_group_mahasiswa.php?idgrup=" .  $row['idgrup'] . "'>Lihat Anggota Group</a></td>";
            echo "<td><a href='event_group_mahasiswa.php?idgrup=" .  $row['idgrup'] . "'>Event Group</a></td>";
            echo "<td><a href='keluar_group.php?username=" .  $_SESSION['username'] . "&idgrup=" . $row['idgrup'] . "'>Keluar dari Group</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Anda belum memiliki grup.</p>";
    }

    ?>
    <a href="home_mahasiswa.php">Kembali</a>
</body>

</html>