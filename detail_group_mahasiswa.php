<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Grup</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
            padding: 20px;
        }

        h2, h3 {
            margin: 5px 0;
        }

        .container {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        table, th, td {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
        }

        img {
            width: 120px;
            height: 160px;
            object-fit: cover;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        .back-btn:hover {
            background: #005dc1;
        }
    </style>
</head>

<body>

<div class="container">

<?php
$mysqli = new mysqli("localhost", "root", "", "fullstack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$idgroup = $_GET['idgrup'];
$username = $_GET['username'];

// ========== DETAIL GRUP ==========

$sql = "SELECT * FROM grup WHERE idgrup = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $idgroup);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {

    echo "<h2>Detail Grup: " . $row['nama'] . "</h2><br>";

    echo "<h3>• Dibuat Oleh : ". $row['username_pembuat'] . "</h3>";
    echo "<h3>• Tanggal Dibuat : ". $row['tanggal_pembentukan'] . "</h3>";
    echo "<h3>• Deskripsi : ". $row['deskripsi'] . "</h3>";
    echo "<h3>• Kode Pendaftaran : ". $row['kode_pendaftaran'] . "</h3>";

    // Hitung jumlah anggota
    $sql = "SELECT COUNT(*) FROM member_grup WHERE idgrup = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $idgroup);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo "<h3>• Jumlah Anggota : ". $count . "</h3><br>";
}
?>

<a href="kelola_group_mahasiswa.php/username = <?php echo $_SESSION['username']; ?>" class="back-btn">Kembali</a>

</div>

</body>
</html>
