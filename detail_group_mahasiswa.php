<?php
session_start();
require_once("Class/group.php");
require_once("Class/member_group.php");

$idgrup = $_GET['idgrup'];

$group  = new group();
$member = new member_group();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Grup</title>
</head>

<body>

    <?php
    $res = $group->getGroupById($idgrup);

    if ($row = $res->fetch_assoc()) {
        $jumlah = $member->countMember($idgrup);

        echo "<h2>Detail Grup: {$row['nama']}</h2>";
        echo "<ul>";
        echo "<li>Dibuat Oleh: {$row['username_pembuat']}</li>";
        echo "<li>Tanggal Dibuat: {$row['tanggal_pembentukan']}</li>";
        echo "<li>Deskripsi: {$row['deskripsi']}</li>";
        echo "<li>Kode Pendaftaran: {$row['kode_pendaftaran']}</li>";
        echo "<li>Jumlah Anggota: $jumlah</li>";
        echo "</ul>";
    }
    ?>

    <a href="kelola_group_mahasiswa.php" class="back-btn">Kembali</a>

</body>

</html>