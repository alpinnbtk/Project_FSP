<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Mahasiswa</title>
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
            width: 900px;
        }

        h2,
        label,
        p {
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

            h2 {
                text-align: center;
            }

            form {
                width: 100%;
                box-sizing: border-box;
                padding: 15px;
            }

            input {
                width: 60%;
                box-sizing: border-box;
            }

            .btnSearch {
                width: auto;
                padding: 10px 20px;
                font-size: 14px;
            }

            table {
                width: 100%;
                display: block;
                overflow-x: auto;
                font-size: 14px;
            }

            img {
                width: 100px;
                height: auto;
            }

            #page {
                margin-top: 40px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 10px;
            }

            h2 {
                font-size: 18px;
                text-align: center;
            }

            form {
                padding: 12px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }

            input {
                width: 100%;
                margin-bottom: 10px;
            }

            .btnSearch {
                width: 100%;
                padding: 10px;
            }

            table {
                font-size: 13px;
            }

            img {
                width: 80px;
            }

            #page a,
            #page span {
                padding: 4px 7px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <h2>Tabel Data Mahasiswa</h2>
    <?php

    require_once("Class/mahasiswa.php");

    $mahasiswa = new mahasiswa();
    $limit = 2;

    $page = isset($_GET['start']) ? (int)$_GET['start'] : 1;
    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $prompt = "";
    $searched = "";

    if (isset($_GET['btnSearch'])) {
        if (!empty($_GET['txtSearch'])) {
            $prompt = $_GET['txtSearch'];
            $searched = "%" . $prompt . "%";
        }
    }

    echo "<form method = 'GET' action = 'tabel_data_mahasiswa.php'>";
    echo "<label> Masukkan NRP / Nama </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "";

    $res = $mahasiswa->getMahasiswa($prompt, $offset, $limit);

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
            echo "<td><img src = 'foto_mahasiswa/" . $row['nrp'] . "." . $row['foto_extention'] . "'></td>";
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

    $total = $mahasiswa->getTotalData($prompt);
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