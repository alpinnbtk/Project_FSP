<?php
session_start();
require_once("Class/group.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung ke Group</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
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
                min-width: 700px;
            }

            th, td {
                font-size: 14px;
                padding: 6px;
            }
        }

        @media (max-width: 480px) {

            table {
                min-width: 700px;
            }

            th, td {
                font-size: 13px;
                padding: 5px;
            }

            input[type="text"],
            input[type="submit"] {
                width: 100%;
                box-sizing: border-box;
                margin-top: 6px;
            }
        }
    </style>

</head>

<body>
    <h2>Gabung ke Group Baru</h2>
    <form action="gabung_group_proses.php" method="POST">

        <?php
        $group = new group();
        $res = $group->getGroupPublik($_SESSION['username']);

        if ($res->num_rows > 0) {
            echo "<table> 
                <tr> 
                    <th>ID Group</th> 
                    <th>Nama Group</th> 
                    <th>Deskripsi</th> 
                    <th>Tanggal Pembentukan</th>
                    <th>Jenis</th>
                </tr>";

            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idgrup'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td>" . $row['tanggal_pembentukan'] . "</td>";
                echo "<td>" . $row['jenis'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Belum ada grup publik yang terbuka!</p>";
        }

        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'invalid') {
                echo "<p>Kode Pendaftaran tidak Valid!</p>";
            } else if ($_GET['error'] == 'idgrup') {
                echo "<p>Anda sudah tergabung dalam grup ini!</p>";
            }
        }
        ?>

        <label>Kode Pendaftaran : </label>
        <input type='text' name='txtKode' required><br>

        <input type="submit" name="btnSubmit" value="Submit">

        <br><br>
        <a href="home_mahasiswa.php">Kembali</a>
    </form>
</body>

</html>