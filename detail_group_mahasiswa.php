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
    <link rel="stylesheet" href="theme.css">

    <style>
        body {
            background: var(--bg-color);
            font-family: Arial;
        }

        h2,
        li {
            margin-bottom: 20px;
            color: var(--text-primary);

        }


        a {
            color: var(--text-secondary);
            font-size: 14px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <?php
    $res = $group->getGroupById($idgrup);

    if ($res) {
        $jumlah = $member->countMember($idgrup);

        echo "<h2>Detail Grup: " . $res['nama'] . "</h2>";
        echo "<ul>";
        echo "<li>Dibuat Oleh: " . $res['username_pembuat'] . "</li>";
        echo "<li>Tanggal Dibuat: " . $res['tanggal_pembentukan'] . "</li>";
        echo "<li>Deskripsi: " . $res['deskripsi'] . "</li>";
        echo "<li>Kode Pendaftaran: " . $res['kode_pendaftaran'] . "</li>";
        echo "<li>Jumlah Anggota: $jumlah</li>";
        echo "</ul>";
    }
    ?>

    <a href="kelola_group_mahasiswa.php" class="back-btn">Kembali</a>

</body>

</html>