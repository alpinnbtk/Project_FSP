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

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: left;
            width: 500px;
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
    <h2>Edit Event</h2>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idevent = $_GET['idevent'];
    $idgroup = $_GET["idgroup"];

    $stmt = $mysqli->prepare('SELECT * FROM event WHERE idevent = ?');
    $stmt->bind_param("i", $idevent);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form method = 'POST' action = 'edit_event_proses.php?idgroup=$idgroup' enctype = 'multipart/form-data'>";
        echo "<input name='idevent' type = 'hidden' value = '" . $row['idevent'] . "'><br>";

        echo "<label>Judul : </label><input name='txtJudul' type = 'text' value = '" . $row['judul'] . "'><br>";

        $tanggal = strtotime($row['tanggal']);
        $date = date("Y-m-d", $tanggal);
        $waktu = date("H:i:s", $tanggal);
        echo "<label>Tanggal : </label><input name='txtTanggal' type = 'date' value = '" . $date . "'><br>";
        echo "<label>Waktu : </label><input name='txtWaktu' type = 'time' value = '" . $waktu . "'><br>";

        echo "<label>Keterangan : </label><textarea name='txtKeteranganBaru'>" . $row['keterangan'] . "</textarea><br>";

        echo "<label>Jenis Event : </label>
                  <select name = 'jenisEvent'>\
                    <option value = 'Publik'";
        if ($row['jenis'] == 'Publik') {
            echo "selected";
        }
        echo ">Publik</option>";
        echo   "<option value = 'Privat'";
        if ($row['jenis'] == 'Privat') {
            echo "selected";
        }
        echo ">Privat</option>";
        echo "</select><br>";

        echo "<label>Foto Poster : </label><br>";
        echo "<img src = 'foto_poster/" . $row['judul'] . "." . $row['poster_extension'] . "' alt = 'Poster Event'><br>";
        echo "<input type = 'file' name = 'posterBaru' accept='image/jpeg, image/png'><br>";
        echo "<button type = 'submit' name = 'btnEdit' class='btnEdit'>Edit Event</button>";
    }
    ?>
</body>

</html>