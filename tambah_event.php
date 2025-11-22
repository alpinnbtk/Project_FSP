<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>

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
            width: 500px;
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
    </style>
</head>

<body>
    <h2>Tambahkan Event</h2>
    <form action="tambah_event_proses.php" method="POST" enctype="multipart/form-data">
        <label>Judul : </label>
        <input type='text' name='txtJudul' required><br>

        <label>Tanggal : </label>
        <input type='date' name='txtTanggal' required><br>

        <label>Keterangan : </label>
        <!-- <input type='textarea' name='txtKeterangan' required><br> -->
        <textarea name="txtKeterangan"></textarea><br>

        <label>Jenis Event : </label>
        <select name='jenisEvent' required>
            <option value='publik'>Publik</option>
            <option value='privat'>Privat</option>
        </select><br>

        <label>Poster : </label>
        <input type='file' name='fotoPoster' accept='image/jpeg, image/png'><br>
    </form>
</body>

</html>