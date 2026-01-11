<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Group Dosen</title>
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

        @media (max-width: 768px) {

            body {
                padding: 15px;
            }

            form {
                width: 100%;
                padding: 15px;
                box-sizing: border-box;
            }

            table {
                width: 100%;
                font-size: 14px;
                display: block;
                overflow-x: auto;
            }

            th, td {
                padding: 8px;
            }

            h2 {
                text-align: center;
            }

            a {
                display: inline-block;
                margin: 3px 0;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 10px;
            }

            form {
                width: 100%;
                padding: 12px;
            }

            table {
                font-size: 13px;
                display: block;
                overflow-x: auto;
            }

            th, td {
                padding: 6px;
            }

            h2 {
                text-align: center;
                font-size: 18px;
            }

            a {
                font-size: 13px;
            }

            #page {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>
    <h2>Semua Group</h2>
    <?php
    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    // }

    // $sql = "SELECT * FROM grup where username_pembuat = ?";
    // $stmt = $mysqli->prepare($sql);
    // $stmt->bind_param("s", $_SESSION['username']);
    // $stmt->execute();
    // $res = $stmt->get_result();

    require_once("Class/group.php");

    $group = new group();

    $dataGroup = $group->getGroupByMember($_SESSION['username']);

    if ($dataGroup) {
        echo "<table> 
                <tr> 
                    <th>ID Group</th> 
                    <th>Nama Group</th> 
                    <th>Detail</th> 
                    <th>Anggota</th>
                    <th>Event</th>
                    <th>Thread</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>";

        while ($row = $dataGroup->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idgrup'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";

            echo "<td><a href='detail_group_dosen.php?idgrup=" . $row['idgrup'] . "&username=" . $_SESSION['username'] . "'>Detail Group</a></td>";
            echo "<td><a href='anggota_group_dosen.php?idgrup=" .  $row['idgrup'] . "'>Lihat Anggota Group</a></td>";
            echo "<td><a href='event_group_dosen.php?idgrup=" .  $row['idgrup'] . "'>Event Group</a></td>";
            echo "<td><a href='lihat_thread.php?idgrup=" .  $row['idgrup'] . "'>Lihat Thread</a></td>";
            echo "<td><a href='edit_group.php?idgrup=" .  $row['idgrup'] . "'>Edit Group</a></td>";
            echo "<td><a href='hapus_group.php?idgrup=" .  $row['idgrup'] . "'>Hapus Group</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Anda belum memiliki grup.</p>";
    }

    ?>

    <a href="home_dosen.php">Kembali</a>

</body>

</html>