<?php
session_start();
require_once("Class/group.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Group</title>
</head>

<body>
    <h2>Edit Group</h2>

    <?php
    $idgrup = $_GET["idgrup"];

    $group = new group();
    $result = $group->getGroupById($idgrup);

    if ($row = $result->fetch_assoc()) {
        echo "<form method='POST' action='edit_group_proses.php?idgrup=$idgrup'>";
        echo "<input name='idgrup' type='hidden' value='{$row['idgrup']}'><br>";

        echo "<label>Nama Group : </label>
              <input name='txtNama' type='text' value='{$row['nama']}'><br>";

        echo "<label>Jenis Group : </label>
              <select name='jenisGroup'>
                <option value='Publik' " . ($row['jenis'] == 'Publik' ? 'selected' : '') . ">Publik</option>
                <option value='Privat' " . ($row['jenis'] == 'Privat' ? 'selected' : '') . ">Privat</option>
              </select><br><br>";

        echo "<button type='submit' name='btnEdit'>Edit Group</button><br><br>";
    }

    echo "<a href='kelola_group_dosen.php?username={$_SESSION['username']}'>Kembali</a>";
    ?>
</body>

</html>