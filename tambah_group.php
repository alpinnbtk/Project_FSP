<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Group</title>
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

        h2 {
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        label {
            text-align: left;
            color: var(--text-primary);
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

        @media (max-width: 768px) {

            body {
                padding: 20px;
            }

            h2 {
                text-align: center;
            }

            form {
                width: 100%;
                box-sizing: border-box;
                padding: 20px;
            }

            input,
            select {
                width: 90%;
                box-sizing: border-box;
            }

            .btnSubmit {
                width: 100%;
                padding: 12px;
                background-color: var(--btn-bg);
                color: var(--text-primary);
            }

            a {
                display: inline-block;
                margin-top: 10px;
                color: var(--text-secondary);
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
                padding: 15px;
            }

            label {
                display: block;
                margin-top: 10px;
            }

            input,
            select {
                width: 100%;
                margin: 5px 0;
            }

            .btnSubmit {
                font-size: 15px;
                padding: 12px;
                background-color: var(--btn-bg);
                color: var(--text-primary);

            }

            a {
                display: block;
                margin-top: 15px;
                text-align: center;
                color: var(--text-secondary);
            }
        }
    </style>
</head>

<body>
    <h2>Tambah Group</h2>
    <?php
    echo "<form method = 'POST' action = 'tambah_group_proses.php'>";
    echo "<label> Masukkan nama group </label>";
    echo "<input type = 'text' name = 'txtNamaGroup' required><br>";

    echo "<label> Masukkan deskripsi group </label>";
    echo "<input type = 'text' name = 'txtDeskripsi' required><br>";

    echo "<label>Jenis Group : </label>
              <select name = 'jenisGroup' required>
                <option value = 'publik'>Publik</option>
                <option value = 'privat'>Privat</option>
              </select><br>";

    echo "<br>";
    echo "<input type = 'submit' name = 'btnSubmit' class='btnSubmit'>";


    echo "<br><br><a href='home_dosen.php'>Kembali</a>";
    echo "</form>";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'namaGroup') {
            echo "<div style='color:red; font-weight:bold;'>Nama group sudah terdaftar sebelumnya!</div>";
        } else if ($_GET['error'] == 'insert') {
            echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
        }
    }
    ?>


</body>

</html>