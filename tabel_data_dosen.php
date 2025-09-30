<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Dosen</title>
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
            /* width: 100%; */
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
    </style>
</head>

<body>
    <h2>Tabel Data Dosen</h2>
    <?php
    echo "<form method = 'GET' action = 'tabel_data_dosen.php'>";
    echo "<label> Masukkan Judul </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "";
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    if (isset($_GET['btnSearch'])) {
        $prompt = $_GET['txtSearch'];
        $searched = "%" . $prompt . "%";
        if (is_numeric($prompt)) {
            $stmt = $mysqli->prepare("SELECT * FROM dosen WHERE npk LIKE ?");
        } else {
            $stmt = $mysqli->prepare("SELECT * FROM dosen WHERE nama LIKE ?");
        }
        $stmt->bind_param("s", $searched);
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM dosen");
    }

    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>NPK Dosen</th> 
                    <th>Nama Dosen</th> 
                    <th>Foto Dosen</th> 
                    <th>Aksi</th> 
                    <th>Hapus</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['npk'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td><img src = 'foto_dosen/" . $row['npk'] . "." . $row['foto_extension'] . "'</td>";
            echo "<td><a href='edit_data_dosen.php?npk=" . $row['npk'] . "'>Ubah Data</a></td>";
            echo "<td><a href='hapus_data_dosen.php?npk=" . $row['npk'] . "&ext=" . $row['foto_extension'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus Data</a></td>";
            echo "</tr>";
        }
        echo "</table><br>";
        echo "<a href = 'tambah_data_dosen.php'>Tambah Data Dosen</a>";
    } else {
        echo "<p>Tidak ada data ditemukan.</p>";
    }

    ?>
</body>

</html>