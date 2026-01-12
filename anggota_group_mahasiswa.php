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
            width: 500px;
        }


        h2,
        label {
            margin-bottom: 20px;
            color: var(--text-primary);

        }

        table,
        th,
        tr,
        td {
            border: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            color: var(--text-primary);

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

        a {
            color: var(--text-secondary);
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

            th,
            td {
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