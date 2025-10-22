<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
            color: #373737ff;
        }

        h2 {
            color: #2c3e50;
        }

        .menu ul {
            list-style: none;
        }

        .menu li {
            margin: 10px 0px;
        }

        .menu a {
            text-decoration: none;
            color: #3c3c3cff;
            background: #fffa91;
            padding: 8px 14px;
            border-radius: 4px;
            display: inline-block;
        }

        .menu a:hover {
            background: #e1dc81ff;

        }
    </style>
</head>

<body>
    <h2>Selamat Datang Admin!</h2>
    <p>Silahkan pilih menu : </p>

    <div class="menu">
        <ul>
            <h4>Dosen</h4>
            <li><a href="tambah_data_dosen.php">Insert Dosen</a></li>
            <li><a href="tabel_data_dosen.php">Tabel Dosen</a></li>
        </ul>

        <ul>
            <h4>Mahasiswa</h4>
            <li><a href="tambah_data_mahasiswa.php">Insert Mahasiswa</a></li>
            <li><a href="tabel_data_mahasiswa.php">Tabel Mahasiswa</a></li>
        </ul>

        <ul>
            <h4>Lainnya</h4>
            <li><a href="logout.php">Logout</a></li>
        </ul>

    </div>
</body>

</html>