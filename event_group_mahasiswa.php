<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
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
            text-align: left;
            width: 1000px;
        }

        h2 {
            margin-bottom: 20px;
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

        a {
            color: var(--text-secondary);
        }

        form {
            margin-bottom: 20px;
        }

        img {
            width: 450px;
            height: 300px;
        }


        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;

        }

        img {
            width: 150px;
            height: 200px;
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

        @media (max-width: 768px) {

            form {
                width: 100%;
                box-sizing: border-box;
            }

            table {
                display: block;
                overflow-x: auto;
                max-width: 100%;
                min-width: 1000px;
            }

            img {
                width: 120px;
                height: auto;
            }

            th,
            td {
                padding: 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {

            table {
                min-width: 1000px;
            }

            img {
                width: 90px;
                height: auto;
            }

            th,
            td {
                padding: 6px;
                font-size: 13px;
            }

            input,
            .btnSearch {
                width: 100%;
                box-sizing: border-box;
            }

            .table-geser {
                width: 100%;
                overflow-x: auto;
                margin-top: 15px;
                border: 1px solid black;
            }
        }
    </style>
</head>

<body>
    <h2>Event Group</h2>

    <?php
    require_once "Class/event.php";

    $idgroup = $_GET['idgrup'];

    $event = new event();

    $search = "";
    if (isset($_GET['btnSearch']) && !empty($_GET['txtSearch'])) {
        $search = $_GET['txtSearch'];
    }

    $res = $event->getEventsByGroup($idgroup, $search);

    if ($res->num_rows > 0) {
        echo "<div class='table-geser'>";
        echo "<table> 
                <tr> 
                    <th>ID Event</th> 
                    <th>Judul</th> 
                    <th>Tanggal</th> 
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Poster</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idevent'] . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "<td>" . $row['jenis'] . "</td>";
            echo "<td><img src = 'foto_poster/" . $row['idevent'] . "." . $row['poster_extension'] . "'></td>";

            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>Belum ada event yang terdaftar!</p>";
    }

    echo "<a href='kelola_group_mahasiswa.php?username=" . $_SESSION['username'] . "'>Kembali</a>";

    ?>
</body>

</html>