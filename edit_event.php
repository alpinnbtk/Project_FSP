<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        h2 {
            margin-bottom: 15px;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: left;
            width: 500px;
        }

        img {
            width: 150px;
            height: 250px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        input,
        textarea,
        select {
            border-radius: 6px;
            padding: 10px;
            margin: 6px 0;
            width: auto;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            padding: 10px 25px;
            border-radius: 6px;
            background: #4CAF50;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #45a049;
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                box-sizing: border-box;
            }

            img {
                width: 120px;
                height: auto;
            }

            input,
            textarea,
            select {
                width: 100%;
                box-sizing: border-box;
            }
        }

        @media (max-width: 480px) {
            h2 {
                text-align: center;
            }

            form {
                width: 100%;
                padding: 15px;
                box-sizing: border-box;
            }

            label {
                display: block;
                margin-top: 10px;
            }

            img {
                display: block;
                margin: 10px auto;
                width: 100px;
            }

            button {
                width: 100%;
                font-size: 16px;
            }
        }
    </style>

</head>

<body>
    <h2>Edit Event</h2>

    <?php
    require_once("Class/event.php");

    $idevent = $_GET['idevent'];
    $idgroup = $_GET['idgroup'];

    $event = new event();
    $result = $event->getEventById($idevent);

    if ($row = $result->fetch_assoc()) {

        echo "<form method='POST' action='edit_event_proses.php?idgroup=$idgroup' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='idevent' value='{$row['idevent']}'>";

        echo "<label>Judul : </label>
              <input name='txtJudul' type='text' value='{$row['judul']}'><br>";

        $tanggal = strtotime($row['tanggal']);
        $date = date("Y-m-d", $tanggal);
        $waktu = date("H:i:s", $tanggal);

        echo "<label>Tanggal : </label>
              <input name='txtTanggal' type='date' value='$date'><br>";

        echo "<label>Waktu : </label>
              <input name='txtWaktu' type='time' value='$waktu'><br>";

        echo "<label>Keterangan : </label>
              <textarea name='txtKeteranganBaru'>{$row['keterangan']}</textarea><br>";

        echo "<label>Jenis Event : </label>
              <select name='jenisEvent'>
                <option value='Publik' " . ($row['jenis'] == 'Publik' ? 'selected' : '') . ">Publik</option>
                <option value='Privat' " . ($row['jenis'] == 'Privat' ? 'selected' : '') . ">Privat</option>
              </select><br>";

        echo "<label>Foto Poster : </label><br>";
        echo "<img src='foto_poster/" . $row['idevent'] . "." . $row['poster_extension'] . "'><br>";
        echo "<input type='file' name='posterBaru' accept='image/jpeg, image/png'><br>";

        echo "<button type='submit' name='btnEdit'>Edit Event</button>";
        echo "</form>";
    }
    ?>
</body>

</html>