<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
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


        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;
            width: 30%;
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

        #npk {
            color: var(--text-primary);
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                padding: 20px;
            }

            input {
                width: 80%;
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

            input {
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
    <h2>Edit Data Dosen</h2>
    <?php
    require_once("Class/dosen.php");

    $npk_dosen = $_GET['npk'];

    $dosen = new dosen();
    $dataDosen = $dosen->getDosenByNpk($npk_dosen);

    if ($dataDosen) {
        echo "<form method = 'POST' action = 'edit_data_dosen_proses.php' enctype = 'multipart/form-data'>";
        echo "<label>NPK Dosen : </label><input type = 'text' id='npk' value = '" . $dataDosen['npk'] . "' disabled><br>";
        echo "<input type = 'hidden' value = '" . $dataDosen['npk'] . "' name = 'txtNPK'><br>";

        echo "<input type='hidden' name='npk_awal' value='" . $dataDosen['npk'] . "'>";
        echo "<label>Nama Dosen : </label><input type = 'text' value = '" . $dataDosen['nama'] . "' name = 'txtNama'><br>";
        echo "<label>Foto Dosen : </label><br>";
        echo "<img src = 'foto_dosen/" . $npk_dosen . "." . $dataDosen['foto_extension'] . "' alt = 'Foto Dosen'><br>";
        echo "<input type = 'file' name = 'fotoBaru' accept='image/jpeg, image/png'><br>";
        echo "<button type = 'submit' name = 'btnEdit' class='btnEdit'>Edit Data</button>";
        echo "</form>";
    } else {
        echo "Data tidak ditemukan";
    }
    ?>
</body>

</html>