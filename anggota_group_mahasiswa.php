<?php
session_start();
require_once("Class/member_group.php");

$idgroup = $_GET['idgrup'];
$search = "";

if (isset($_GET['btnSearch']) && !empty($_GET['txtSearch'])) {
    $search = $_GET['txtSearch'];
}

$member = new member_group();
$res = $member->getMemberByGroup($idgroup, $search);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Group Mahasiswa</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            width: 500px;
        }

        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            width: 100%;
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

        .container {
            max-width: 100%;
            padding: 15px;
            box-sizing: border-box;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {

            form {
                width: 100%;
                box-sizing: border-box;
            }

            input[type="text"] {
                width: 100%;
                box-sizing: border-box;
            }

            .btnSearch {
                width: 100%;
                box-sizing: border-box;
            }

            img {
                width: 100px;
                height: auto;
            }

            h2 {
                text-align: center;
            }
        }

        @media (max-width: 600px) {

            th, td {
                font-size: 14px;
                padding: 6px;
            }

            img {
                width: 60px;
                height: auto;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <?php

    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     die("Failed to connect to MySQL: " . $mysqli->connect_error);
    // }

    // $idgroup = $_GET['idgrup'];

    // $prompt = "";
    // $searched = "";

    // if (isset($_GET['btnSearch'])) {
    //     if (!empty($_GET['txtSearch'])) {
    //         $prompt = $_GET['txtSearch'];
    //         $searched = "%" . $prompt . "%";
    //     }
    // }

    // $sql =
    //     "SELECT 
    //         mg.idgrup,
    //         mg.username,
    //         a.npk_dosen,
    //         a.nrp_mahasiswa,
    //         d.foto_extension AS foto_dosen,
    //         m.foto_extention AS foto_mahasiswa
    //     FROM member_grup mg
    //     INNER JOIN akun a ON mg.username = a.username
    //     LEFT JOIN dosen d ON a.npk_dosen = d.npk
    //     LEFT JOIN mahasiswa m ON a.nrp_mahasiswa = m.nrp
    //     WHERE mg.idgrup = ?";

    // if (!empty($searched)) {
    //     $sql .= " AND mg.username LIKE ?";
    // }

    // $sql .= " ORDER BY a.npk_dosen DESC;";
    // $stmt = $mysqli->prepare($sql);

    // if (!empty($searched)) {
    //     $stmt->bind_param('is', $idgroup, $searched);
    // } else {
    //     $stmt->bind_param("i", $idgroup);
    // }

    // $stmt->execute();
    // $res = $stmt->get_result();

    echo "<h2>Anggota Grup :</h2>";

    echo "<form method='GET' action='anggota_group_mahasiswa.php?idgrup=$idgroup'>";
    echo "<label> Masukkan Username </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "<input type='hidden' name='idgrup' value='$idgroup'>";

    echo "<div class='table-wrapper'>";
    echo "<br><table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nama (Username)</th>";
    echo "<th>Foto</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    while ($row = $res->fetch_assoc()) {

        if ($row['nrp_mahasiswa']) {
            $id = $row['nrp_mahasiswa'];
            $ext = $row['foto_mahasiswa'];
            $folder = "foto_mahasiswa/";
        } else {
            $id = $row['npk_dosen'];
            $ext = $row['foto_dosen'];
            $folder = "foto_dosen/";
        }

        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row['username'] . "</td>";

        if ($ext) {
            echo "<td><img src='" . $folder . $id . "." . $ext . "' width='80'></td>";
        } else {
            echo "<td><i>Tidak ada foto</i></td>";
        }

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    echo "<a href='kelola_group_mahasiswa.php?username=" . $_SESSION['username'] . "'>Kembali</a>";

    ?>
</div>
</body>

</html>