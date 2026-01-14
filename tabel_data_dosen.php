<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Dosen</title>
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
    <h2>Tabel Data Dosen</h2>
    <?php

    require_once("Class/dosen.php");

    $dosen = new dosen();
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

    echo "<form method = 'GET' action = 'tabel_data_dosen.php'>";
    echo "<label> Masukkan NPK / Nama </label>";
    echo "<input type = 'text' name = 'txtSearch'>";
    echo "<input type = 'submit' name = 'btnSearch' class='btnSearch'>";
    echo "";

    $res = $dosen->getDosen($prompt, $offset, $limit);

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
            echo "<td><img src = 'foto_dosen/" . $row['npk'] . "." . $row['foto_extension'] . "'></td>";
            echo "<td><a href='edit_data_dosen.php?npk=" . $row['npk'] . "'>Ubah Data</a></td>";
            echo "<td><a href='hapus_data_dosen.php?npk=" . $row['npk'] . "&ext=" . $row['foto_extension']  . "'>Hapus Data</a></td>";
            echo "</tr>";
        }
        echo "</table><br>";
        echo "<a href = 'tambah_data_dosen.php'>Tambah Data Dosen</a><br>";
        echo "<a href = 'dashboard_admin.php'>Kembali ke Halaman Home</a>";
    } else {
        echo "<p>Tidak ada data ditemukan.</p>";
    }

    $total = $dosen->getTotalData($prompt);

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