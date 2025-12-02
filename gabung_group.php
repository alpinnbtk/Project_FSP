<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung ke Group</title>

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
            width: 700px;
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

        p {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <h2>Gabung ke Group Baru</h2>
    <form action="gabung_group_proses.php" method="POST">

        <?php
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }

        $sql = "SELECT * FROM grup WHERE jenis = 'Publik' AND idgrup NOT IN (SELECT idgrup FROM member_grup WHERE username = ?);";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo "<table> 
                <tr> 
                    <th>ID Group</th> 
                    <th>Nama Group</th> 
                    <th>Deskripsi</th> 
                    <th>Tanggal Pembentukan</th>
                    <th>Jenis</th>
                    <th>Kode Pendaftaran</th>
                </tr>";

            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idgrup'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td>" . $row['tanggal_pembentukan'] . "</td>";
                echo "<td>" . $row['jenis'] . "</td>";
                echo "<td>" . $row['kode_pendaftaran'] . "</td>";
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