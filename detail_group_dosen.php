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

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }


        .detail-box {
            background: #fffdf8ff;
            padding: 20px 30px;
            border-radius: 10px;
            width: 900px;
            margin: 30px auto;
        }

        #member {
            width: 40%;
            vertical-align: top;
        }

        #event {
            width: 60%;
            vertical-align: top;

        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            width: 350px;
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
        }

        th,
        td {
            padding: 10px;
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
    $mysqli = new mysqli("localhost", "root", "", "fullstack");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $idgroup = $_GET['idgrup'];
    $username = $_GET['username'];

    $sql = "SELECT * FROM grup where idgrup = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $idgroup);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {

        $sql2 = "SELECT COUNT(*) FROM member_grup where idgrup = ?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param('i', $idgroup);
        $stmt2->execute();
        $stmt2->bind_result($count);
        $stmt2->fetch();
        $stmt2->close();

        echo "<div class='detail-box'>";
        echo "<h2>Grup " . $row['nama'] . "</h2>";
        echo "<h3><b>Dibuat Oleh:</b> " . $row['username_pembuat'] . "</h3>";
        echo "<h3><b>Tanggal Dibuat:</b> " . $row['tanggal_pembentukan'] . "</h3>";
        echo "<h3><b>Deskripsi:</b> " . $row['deskripsi'] . "</h3>";
        echo "<h3><b>Kode Pendaftaran:</b> " . $row['kode_pendaftaran'] . "</h3>";
        echo "<h3><b>Jumlah Anggota:</b> " . $count . "</h3>";
        echo "</div>";
    }
    ?>

    <table>
        <tr>
            <td id="member">
                <h2>Member</h2>

                <form method="POST">
                    <input type="radio" name="rdo" id="rdoMhs" value="mahasiswa"> <label>Mahasiswa</label>
                    <input type="radio" name="rdo" id="rdoDos" value="dosen"> <label>Dosen</label>
                </form>

                <label>Masukkan NRP/NPK atau Nama</label><br>
                <input type='text' name='txtSearch'>
                <input type="button" value="Submit" id="btnSearch" class="btnSearch">

                <table>
                    <thead id="head">
                        <tr></tr>
                    </thead>
                    <tbody id="body"></tbody>
                </table>

                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'idgrup') {
                        echo "<div style='color:red; font-weight:bold;'>Sudah terdaftar di grup ini!</div>";
                    } else if ($_GET['error'] == 'insert') {
                        echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
                    }
                }
                ?>
            </td>

            <td id="event">
                <h2>Event</h2>
                <a href="tambah_event.php?idgroup=<?php echo $idgroup ?>">Tambah Event</a>

                <?php
                $sqlEvent = "SELECT * FROM event WHERE idgrup = ?";
                $stmtEvent = $mysqli->prepare($sqlEvent);
                $stmtEvent->bind_param('i', $idgroup);
                $stmtEvent->execute();
                $resEvent = $stmtEvent->get_result();

                if ($resEvent->num_rows > 0) {
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

                    while ($rowEvent = $resEvent->fetch_assoc()) {
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
                }
                ?>
            </td>
        </tr>
    </table>

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