<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Group</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        a {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idgroup = $_GET['idgrup'];

    $sql = "select mg.idgrup, mg.username, a.nrp_mahasiswa, 
        a.npk_dosen from member_grup mg join akun a 
        on mg.username = a.username where idgrup = $idgroup
        order by npk_dosen desc ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<h2>Anggota Grup : </h2>";

    echo "<table>";
    echo "<thead id='head'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nama</th>";
    echo "<th>Aksi</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody id='body'>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        if ($row['nrp_mahasiswa'] == null) {
            echo "<td>" . $row['npk_dosen'] . "</td>";
        }
        if ($row['npk_dosen'] == null) {
            echo "<td>" . $row['nrp_mahasiswa'] . "</td>";
        }
        echo "<td>" . $row['username'] . "</td>";
        echo "<td><a href='hapus_member.php?idgrup=$idgroup&username=" . $row['username'] . "'>Keluarkan</a></td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    ?>



</body>

</html>