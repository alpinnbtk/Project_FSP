<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>

    <style>
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
    </style>
</head>

<body>
    <h2>Event Group</h2>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idgroup = $_GET['idgrup'];

    $sql = "SELECT * FROM event WHERE idgrup = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idgroup);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        echo "<table> 
                <tr> 
                    <th>ID Event</th> 
                    <th>Judul</th> 
                    <th>Tanggal</th> 
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Update</th>
                    <th>Hapus</th>
                </tr>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idevent'] . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "<td>" . $row['jenis'] . "</td>";


            echo "<td><a href='update_event.php?idgrup=" .  $row['idevent'] . "'>Edit event</a></td>";
            echo "<td><a href='hapus_event.php?nrp=" .  $_SESSION['username'] . "'>Hapus event</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada event yang terdaftar!</p>";
    }

    ?>
</body>

</html>