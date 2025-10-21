<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Mahasiswa</title>
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
    <h2>Tabel Data Mahasiswa</h2>
    <?php
    echo "<form method = 'GET' action = 'tabel_data_mahasiswa.php'>";
    echo "<label> Masukkan Nama </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "";
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $limit = 2;

    $page = isset($_GET['start']) ? (int)$_GET['start'] : 1;
    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $prompt = "";
    $searched = "";

    if (isset($_GET['btnSearch'])) {
        $prompt = $_GET['txtSearch'];
        $searched = "%" . $prompt . "%";
    }

    $sql = "SELECT * FROM mahasiswa";

    if (!empty($prompt)) {
        if (is_numeric($prompt)) {
            $sql .= " WHERE nrp LIKE ?";
        } else {
            $sql .= " WHERE nama LIKE ?";
        }
    }

    if (!is_null($offset)) $sql .= " LIMIT ?,?";

    $stmt = $mysqli->prepare($sql);

    if (!empty($searched) && !is_null($offset)) {
        $stmt->bind_param('sii', $searched, $offset, $limit);
    } else if (!empty($searched)) {
        $stmt->bind_param('s', $searched);
    } else if (empty($searched) && !is_null($offset)) {
        $stmt->bind_param('ii', $offset, $limit);
    }

    $stmt->execute();
    $res = $stmt->get_result();


    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>NRP Mahasiswa</th> 
                    <th>Nama Mahasiswa</th> 
                    <th>Gender</th> 
                    <th>Tanggal Lahir</th>
                    <th>Angkatan</th>
                    <th>Foto Mahasiswa</th>
                    <th>Aksi</th> 
                    <th>Hapus</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nrp'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['tanggal_lahir'] . "</td>";
            echo "<td>" . $row['angkatan'] . "</td>";
            echo "<td><img src = 'foto_mahasiswa/" . $row['nrp'] . "." . $row['foto_extention'] . "'</td>";
            echo "<td><a href='edit_data_mahasiswa.php?nrp=" . $row['nrp'] . "'>Ubah Data</a></td>";
            echo "<td><a href='hapus_data_mahasiswa.php?nrp=" . $row['nrp'] . "'>Hapus Data</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href = 'tambah_data_mahasiswa.php'>Tambah Data Mahasiswa</a><br>";
        echo "<a href = 'dashboard_admin.php'>Kembali ke Dashboard</a>";
    } else {
        echo "<p>Tidak ada data ditemukan.</p>";
    }


    $sql = "SELECT * FROM mahasiswa";

    if (!empty($searched)) {
        if (is_numeric($searched)) {
            $sql .= " WHERE nrp LIKE ?";
        } else {
            $sql .= " WHERE nama LIKE ?";
        }
    }

    $stmtPage = $mysqli->prepare($sql);

    if (!empty($searched)) {
        $stmtPage->bind_param('s', $searched);
    }

    $stmtPage->execute();
    $resPage = $stmtPage->get_result();

    $total = $resPage->num_rows;
    $total_pages = ceil($total / $limit);

    echo "<div id='page'>";
    if ($page > 1) {
        echo "<a href='?start=1'>First</a>";
        echo "<a href='?start=" . ($page - 1) . "'>Prev</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<span class='active'>$i</span>";
        } else {

            echo "<a href='?start=$i'>$i</a>";
        }
    }

    if ($page < $total_pages) {
        echo "<a href='?start=" . ($page + 1) . "'>Next</a>";
        echo "<a href='?start=$total_pages'>Last</a>";
    }
    echo "</div>";

    ?>
</body>

</html>