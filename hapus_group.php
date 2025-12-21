<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Group</title>
</head>
<body>
    <h2>Hapus Group</h2><br>

    <?php
    require_once("Class/group.php");

    $idgroup = $_GET['idgrup'];

    $group = new group();
    $result = $group->deleteGroup($idgroup);

    if ($result) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Gagal menghapus data!";
    }

    header("location: kelola_group_dosen.php");
    ?>
</body>
</html>
