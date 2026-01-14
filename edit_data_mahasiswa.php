<?php
require_once("class/mahasiswa.php");

$nrp_mahasiswa = $_GET['nrp'];

$mhs = new mahasiswa();
$result = $mhs->getMahasiswaByNRP($nrp_mahasiswa);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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
            width: 700px;
        }

        h2,
        label,
        p {
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        img {
            width: 150px;
            height: 200px;
        }

        input,
        select {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;
            width: 40%;
        }

        .btnEdit {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        .btnEdit:hover {
            background: #45a049;
        }

        #nrp {
            color: var(--text-primary);
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                padding: 20px;
            }

            input,
            select {
                width: 90%;
            }

            img {
                width: 120px;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            h2 {
                text-align: center;
            }

            label {
                display: block;
                margin-top: 10px;
            }

            input,
            select {
                width: 100%;
                margin: 6px 0;
            }

            .btnEdit {
                width: 100%;
                padding: 12px;
                font-size: 16px;
            }

            img {
                display: block;
                margin: auto;
                width: 110px;
            }
        }
    </style>
</head>

<body>

    <h2>Edit Data Mahasiswa</h2>

    <?php if ($row): ?>
        <form method="POST" action="edit_data_mahasiswa_proses.php" enctype="multipart/form-data">

            <label>NRP Mahasiswa :</label>
            <input id="nrp" type="text" value="<?= $row['nrp']; ?>" disabled>
            <input type="hidden" name="nrp_awal" value="<?= $row['nrp']; ?>">

            <br>

            <label>Nama Mahasiswa :</label>
            <input type="text" name="txtNama" value="<?= $row['nama']; ?>">

            <br>

            <label>Gender Mahasiswa :</label>
            <select name="genderMhs">
                <option value="Pria" <?= ($row['gender'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                <option value="Wanita" <?= ($row['gender'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
            </select>

            <br>

            <label>Tanggal Lahir :</label>
            <input type="date" name="txtTanggalLahir" value="<?= $row['tanggal_lahir']; ?>">

            <br>

            <label>Angkatan Mahasiswa :</label>
            <input type="text" name="txtAngkatan" value="<?= $row['angkatan']; ?>">

            <br><br>

            <label>Foto Mahasiswa :</label><br>
            <img src="foto_mahasiswa/<?= $row['nrp'] . '.' . $row['foto_extention']; ?>"><br><br>
            <input type="file" name="fotoBaru" accept="image/jpeg, image/png">

            <br><br>

            <button type="submit" name="btnEdit" class="btnEdit">Edit Data</button>

        </form>

    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>

</body>

</html>