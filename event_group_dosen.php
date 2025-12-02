<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>

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
            width: 1000px;
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
    <h2>Event Group</h2>

    <?php

    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idgroup = $_GET['idgrup'];

    echo "<form method='GET' action='event_group_dosen.php?idgrup=$idgroup'>";
    echo "<label> Masukkan Judul Event </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "<input type='hidden' name='idgrup' value='$idgroup'>";

    $prompt = "";
    $searched = "";

    if (isset($_GET['btnSearch'])) {
        if (!empty($_GET['txtSearch'])) {
            $prompt = $_GET['txtSearch'];
            $searched = "%" . $prompt . "%";
        }
    }

    $sql = "SELECT * FROM event WHERE idgrup = ?";

    if (!empty($searched)) {
        $sql .= " AND judul LIKE ?";
    }

    $stmt = $mysqli->prepare($sql);

    if (!empty($searched)) {
        $stmt->bind_param('is', $idgroup, $searched);
    } else {
        $stmt->bind_param("i", $idgroup);
    }

    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>ID Event</th> 
                    <th>Judul</th> 
                    <th>Tanggal</th> 
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Poster</th>
                    <th>Update</th>
                    <th>Hapus</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idevent'] . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "<td>" . $row['jenis'] . "</td>";
            echo "<td><img src = 'foto_poster/" . $row['idevent'] . "." . $row['poster_extension'] . "'></td>";


            echo "<td><a href='update_event.php?idgrup=" .  $row['idevent'] . "'>Edit event</a></td>";
            echo "<td><a href='hapus_event.php?nrp=" .  $_SESSION['username'] . "'>Hapus event</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada event yang terdaftar!</p>";
    }

    echo "<a href='kelola_group_dosen.php?username=" . $_SESSION['username'] . "'>Kembali</a>";

    ?>
</body>

</html>