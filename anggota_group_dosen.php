<?php
session_start();
require_once("Class/member_group.php");

$idgroup = $_GET['idgrup'];
$search = "";

if (isset($_GET['btnSearch']) && !empty($_GET['txtSearch'])) {
    $search = $_GET['txtSearch'];
}

$member = new member_group();
$res = $member->getMemberByGroup($idgroup, $search);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Group Dosen</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            width: 500px;
            margin-bottom: 20px;
        }

        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            background: white;
            width: auto;
            table-layout: auto;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        img {
            width: 80px;
            height: auto;
        }

        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;
        }

        .btnSearch {
            background: #4CAF50;
            color: white;
            padding: 10px 40px;
            border-radius: 6px;
            font-size: 16px;
        }

        .btnSearch:hover {
            background: #45a049;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                box-sizing: border-box;
            }

            table {
                width: 100%;
            }

            th, td {
                padding: 8px;
                font-size: 14px;
            }

            img {
                width: 60px;
            }
        }

        @media (max-width: 480px) {
            form {
                width: 100%;
                box-sizing: border-box;
            }

            input[type="text"] {
                width: 100%;
                box-sizing: border-box;
            }

            .btnSearch {
                width: 100%;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            img {
                width: 55px;
            }
        }
    </style>


</head>

<body>

    <h2>Anggota Grup</h2>

    <form method="GET">
        <input type="hidden" name="idgrup" value="<?= $idgroup ?>">
        <label>Masukkan Username</label>
        <input type="text" name="txtSearch">
        <input type="submit" name="btnSearch" value="Cari" class="btnSearch">
    </form>

    <div class = "table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $res->fetch_assoc()) {

                    if (!empty($row['nrp_mahasiswa'])) {
                        $id = $row['nrp_mahasiswa'];
                        $foto = $row['foto_mahasiswa'];
                        $folder = "foto_mahasiswa/";
                    } else {
                        $id = $row['npk_dosen'];
                        $foto = $row['foto_dosen'];
                        $folder = "foto_dosen/";
                    }
                ?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $row['username'] ?></td>
                        <td>
                            <?php if (!empty($foto)) { ?>
                                <img src="<?= $folder . $id . '.' . $foto ?>">
                            <?php } else { ?>
                                <i>Tidak ada foto</i>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="hapus_member.php?idgrup=<?= $idgroup ?>&username=<?= $row['username'] ?>">
                                Keluarkan
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br>
    <a href="kelola_group_dosen.php?username=<?= $_SESSION['username'] ?>">Kembali</a>

</body>

</html>