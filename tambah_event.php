<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
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
            width: 500px;
        }

        h2,
        label {
            margin-bottom: 20px;
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

        #button {
            background: var(--btn-bg);
            color: var(--text-primary);
            padding: 10px 120px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
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
            select,
            textarea {
                width: 90%;
                box-sizing: border-box;
            }

            input[type="submit"] {
                width: 100%;
                padding: 12px;
            }

            img {
                width: 120px;
                height: auto;
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
            select,
            textarea {
                width: 100%;
                margin: 5px 0;
            }

            input[type="submit"] {
                font-size: 15px;
                padding: 12px;
            }

            img {
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <h2>Tambahkan Event</h2>
    <form action="tambah_event_proses.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idgrup" value="<?php echo $_GET['idgroup'] ?>">

        <label>Judul : </label>
        <input type='text' name='txtJudul' required><br>

        <label>Tanggal : </label>
        <input type='date' name='txtTanggal' required>
        <input type='time' name='txtWaktu' required><br>

        <label>Keterangan : </label>
        <textarea name="txtKeterangan"></textarea><br>

        <label>Jenis Event : </label>
        <select name='jenisEvent' required>
            <option value='publik'>Publik</option>
            <option value='privat'>Privat</option>
        </select><br>

        <label>Poster : </label>
        <input type='file' name='fotoPoster' accept='image/jpeg, image/png'><br>

        <input type="submit" name="btnSubmit" value="Submit" id="button">
    </form>
</body>

</html>