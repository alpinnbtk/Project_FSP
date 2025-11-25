<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Group</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table, th, tr, td {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        a {
            color: red;
        }
    </style>
</head>

<body>
<?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    $idgroup = $_GET['idgrup'];

    $sql = 
        "SELECT 
            mg.idgrup,
            mg.username,
            a.npk_dosen,
            a.nrp_mahasiswa,
            d.foto_extension AS foto_dosen,
            m.foto_extention AS foto_mahasiswa
        FROM member_grup mg
        INNER JOIN akun a ON mg.username = a.username
        LEFT JOIN dosen d ON a.npk_dosen = d.npk
        LEFT JOIN mahasiswa m ON a.nrp_mahasiswa = m.nrp
        WHERE mg.idgrup = ?
        ORDER BY a.npk_dosen DESC";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idgroup);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<h2>Anggota Grup :</h2>";

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nama (Username)</th>";
    echo "<th>Foto</th>";
    echo "<th>Aksi</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    while ($row = $res->fetch_assoc()) {

        if ($row['nrp_mahasiswa']) {
            $id = $row['nrp_mahasiswa'];
            $foto = $row['foto_mahasiswa'];
            $folder = "foto_mahasiswa/";
        } else {
            $id = $row['npk_dosen'];
            $foto = $row['foto_dosen'];
            $folder = "foto_dosen/";
        }

        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row['username'] . "</td>";

        if ($foto) {
            echo "<td><img src='{$folder}{$id}.{$foto}' width='80'></td>";
        } else {
            echo "<td><i>No Photo</i></td>";
        }

        echo "<td><a href='hapus_member.php?idgrup=$idgroup&username=" . $row['username'] . "'>Keluarkan</a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
?>
</body>
</html>
