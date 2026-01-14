<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Group</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="theme.css">

    <style>
        body {
            background: var(--bg-color);
            font-family: Arial;
        }

        form {
            background: var(--form-bg);
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        h2,
        h3 {
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        input {
            border-radius: 6px;
            padding: 7px;
            margin: 6px;
            color: var(--text-primary);

        }

        label {
            text-align: left;
            color: var(--text-primary);
        }


        .detail {
            background: var(--form-bg);
            padding: 20px 30px;
            border-radius: 10px;
            max-width: 900px;
            width: calc(95% - 40px);
            margin: 10px auto;

        }

        .container {
            display: flex;
            flex-wrap: wrap;
            margin: 0 auto;

        }

        @media(max-width: 768px) {

            .member,
            .event {
                width: calc(100% - 52px);
                margin: 10px auto;
                padding: 15px;
                background: var(--form-bg);
                border: 1px solid #9e9e9eff;
                border-radius: 10px;
            }

            form {
                width: 100%;
                max-width: 300px;
                background-color: #45a049;
            }

            img {
                width: 80px;
                height: auto;
            }

            .table-geser {
                width: 100%;
                overflow-x: auto;
                margin-top: 15px;
                border: 1px solid black;
            }

        }

        @media(min-width: 769px) {
            .member {
                width: calc(40% - 52px);
                margin: 10px auto;
                padding: 15px;
                background: var(--bg-color);
                border: 1px solid #9e9e9eff;
                border-radius: 10px;
            }

            .event {
                width: calc(60% - 52px);
                margin: 10px auto;
                padding: 15px;
                background: var(--bg-color);
                border: 1px solid #9e9e9eff;
                border-radius: 10px;
            }
        }

        form {
            background: var(--form-bg);
            padding: 20px 30px;
            border-radius: 10px;
            width: 300px;
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        table,
        th,
        tr,
        td {
            border: 1px solid var(--border-color);

        }

        table {
            border-collapse: collapse;

            min-width: 500px;
        }

        th,
        td {
            padding: 10px;
            color: var(--text-primary);

        }

        a {
            color: var(--text-secondary);
        }


        img {
            width: 150px;
            height: 200px;
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
            margin: 6px;
            font-size: 16px;
        }

        .btnSearch:hover {
            background: #45a049;
        }
    </style>

</head>

<body>

    <?php

    require_once("Class/group.php");
    require_once("Class/member_group.php");
    require_once("Class/event.php");

    $group = new group();
    $memberGroup = new member_group();
    $event = new event();

    $idgroup = $_GET['idgrup'];
    $username = $_GET['username'];

    $dataGroup = $group->getGroupById($idgroup);

    if ($dataGroup) {

        $dataCount = $memberGroup->countMember($idgroup);

        echo "<div class='detail'>";
        echo "<h2>Grup " . $dataGroup['nama'] . "</h2>";
        echo "<h3><b>Dibuat Oleh:</b> " . $dataGroup['username_pembuat'] . "</h3>";
        echo "<h3><b>Tanggal Dibuat:</b> " . $dataGroup['tanggal_pembentukan'] . "</h3>";
        echo "<h3><b>Deskripsi:</b> " . $dataGroup['deskripsi'] . "</h3>";
        echo "<h3><b>Kode Pendaftaran:</b> " . $dataGroup['kode_pendaftaran'] . "</h3>";
        echo "<h3><b>Jumlah Anggota:</b> " . $dataCount . "</h3>";
        echo "</div>";
    }
    ?>

    <div class="container">
        <div class="member">
            <h2>Member</h2>

            <form method="POST">
                <input type="radio" name="rdo" id="rdoMhs" value="mahasiswa"> <label>Mahasiswa</label>
                <input type="radio" name="rdo" id="rdoDos" value="dosen"> <label>Dosen</label>
            </form>

            <label>Masukkan NRP/NPK atau Nama</label><br>
            <input type='text' name='txtSearch'>
            <input type="button" value="Submit" id="btnSearch" class="btnSearch">

            <div class="table-geser">
                <table>
                    <thead id="head">
                        <tr></tr>
                    </thead>
                    <tbody id="body"></tbody>
                </table>
            </div>

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'idgrup') {
                    echo "<div style='color:red; font-weight:bold;'>Sudah terdaftar di grup ini!</div>";
                } else if ($_GET['error'] == 'insert') {
                    echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
                }
            }
            ?>
        </div>

        <div class="event">
            <h2>Event</h2>
            <a href="tambah_event.php?idgroup=<?php echo $idgroup ?>">Tambah Event</a>

            <?php
            $dataEvent = $event->getEventByGroupId($idgroup);

            if ($dataEvent->num_rows > 0) {
                echo "<div class='table-geser'>";
                echo "<table style='width:100%; margin-top:15px;'>
                <tr>
                    <th>ID Event</th>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Update</th>
                    <th>Hapus</th>
                </tr>";

                while ($rowEvent = $dataEvent->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowEvent['idevent'] . "</td>";
                    echo "<td><img src='foto_poster/" . $rowEvent['idevent'] . "." . $rowEvent['poster_extension'] . "'></td>";
                    echo "<td>" . $rowEvent['judul'] . "</td>";
                    echo "<td>" . $rowEvent['tanggal'] . "</td>";
                    echo "<td>" . $rowEvent['keterangan'] . "</td>";
                    echo "<td>" . $rowEvent['jenis'] . "</td>";
                    echo "<td><a href='edit_event.php?idgroup=" . $idgroup . "&idevent=" .  $rowEvent['idevent'] . "'>Edit</a></td>";
                    echo "<td><a href='hapus_event.php?idgroup=" . $idgroup . "&idevent=" . $rowEvent['idevent']  . "&ext=" . $rowEvent['poster_extension'] . "'>Hapus</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <a href="kelola_group_dosen.php?username=<?php echo $_SESSION['username']; ?>">Kembali</a>
</body>

</html>

<script>
    var idgroup = <?php echo $idgroup ?>;

    $("body").on("change", "#rdoMhs", function() {
        var p_peran = $(this).val();
        $("#head").html("");
        $("#body").html("");

        $.post("load_peran.php", {
                peran: p_peran
            })
            .done(function(data) {
                var mhs = JSON.parse(data);
                $("#head").append("<th>NRP</th><th>Nama</th><th>Username</th><th>Foto</th><th>Aksi</th>")
                $.each(mhs, function(i, item) {
                    $("#body").append(
                        "<tr>" +
                        "<td>" + item.id + "</td>" +
                        "<td>" + item.nama + "</td>" +
                        "<td>" + item.username + "</td>" +
                        "<td><img src='foto_mahasiswa/" + item.id + "." + item.foto + "'></td>" +
                        "<td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan</a></td>" +
                        "</tr>"
                    );
                });
            })
    });

    $("body").on("change", "#rdoDos", function() {
        var p_peran = $(this).val();
        $("#head").html("");
        $("#body").html("");

        $.post("load_peran.php", {
                peran: p_peran
            })
            .done(function(data) {
                var dos = JSON.parse(data);
                $("#head").append("<th>NPK</th><th>Nama</th><th>Username</th><th>Foto</th><th>Aksi</th>")
                $.each(dos, function(i, item) {
                    $("#body").append(
                        "<tr>" +
                        "<td>" + item.id + "</td>" +
                        "<td>" + item.nama + "</td>" +
                        "<td>" + item.username + "</td>" +
                        "<td><img src='foto_dosen/" + item.id + "." + item.foto + "'></td>" +
                        "<td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan</a></td>" +
                        "</tr>"
                    );
                });
            })
    });

    $("#btnSearch").on("click", function() {
        var prompt = $("input[name='txtSearch']").val().trim();
        var peran = $("input[name='rdo']:checked").val();

        if (!peran) {
            alert("Pilih Mahasiswa atau Dosen dulu!");
            return;
        }
        if (prompt == "") {
            alert("Masukkan NRP/NPK atau Nama!");
            return;
        }

        $("#head").html("");
        $("#body").html("");

        $.post("cari_anggota.php", {
                peran: peran,
                prompt: prompt
            })
            .done(function(data) {
                var result = JSON.parse(data);

                if (result.length == 0) {
                    $("#body").append("<tr><td colspan='5' style='color:red;'>Tidak ditemukan.</td></tr>");
                    return;
                }

                if (peran == "mahasiswa") {
                    $("#head").append("<th>NRP</th><th>Nama</th><th>Username</th><th>Foto</th><th>Aksi</th>");

                    $.each(result, function(i, item) {
                        $("#body").append(
                            "<tr>" +
                            "<td>" + item.id + "</td>" +
                            "<td>" + item.nama + "</td>" +
                            "<td>" + item.username + "</td>" +
                            "<td><img src='foto_mahasiswa/" + item.id + "." + item.foto_extention + "'></td>" +
                            "<td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan</a></td>" +
                            "</tr>"
                        );
                    });
                } else {
                    $("#head").append("<th>NPK</th><th>Nama</th><th>Username</th><th>Foto</th><th>Aksi</th>");

                    $.each(result, function(i, item) {
                        $("#body").append(
                            "<tr>" +
                            "<td>" + item.id + "</td>" +
                            "<td>" + item.nama + "</td>" +
                            "<td>" + item.username + "</td>" +
                            "<td><img src='foto_dosen/" + item.id + "." + item.foto_extension + "'></td>" +
                            "<td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan</a></td>" +
                            "</tr>"
                        );
                    });
                }
            });
    });
</script>