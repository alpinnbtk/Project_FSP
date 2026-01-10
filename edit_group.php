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
            width: 400px;
        }

        label {
            display: inline-block;
            margin-top: 10px;
        }

        input,
        select {
            border-radius: 6px;
            padding: 10px;
            margin: 6px 0;
        }

        button {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            margin: 6px;
            font-size: 16px;
        }

        button:hover {
            background: #45a049;
        }


        @media (max-width: 768px) {
            form {
                width: 95%;
                box-sizing: border-box;
            }

            input,
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
            }

            button {
                width: 100%;
                margin-top: 10px;
            }

            a {
                display: block;
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>

</head>

<body>
    <h2>Edit Group</h2>

    <?php
    $idgrup = $_GET["idgrup"];

    $group = new group();
    $result = $group->getGroupById($idgrup);

    if ($result) {
        echo "<form method='POST' action='edit_group_proses.php?idgrup=$idgrup'>";
        echo "<input name='idgrup' type='hidden' value='" . $result['idgrup'] . "'><br>";

        echo "<label>Nama Group : </label>
              <input name='txtNama' type='text' value='" . $result['nama'] . "'><br>";

        echo "<label>Jenis Group : </label>
              <select name='jenisGroup'>
                <option value='Publik' " . ($result['jenis'] == 'Publik' ? 'selected' : '') . ">Publik</option>
                <option value='Privat' " . ($result['jenis'] == 'Privat' ? 'selected' : '') . ">Privat</option>
              </select><br><br>";

        echo "<button type='submit' name='btnEdit'>Edit Group</button><br><br>";
    }

    echo "<a href='kelola_group_dosen.php?username=" . $_SESSION['username'] . "'>Kembali</a>";
    ?>
</body>

</html>