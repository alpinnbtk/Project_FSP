<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        table,
        th,
        tr,
        td {
            border: 1px solid black;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        img {
            width: 150px;
            height: 200px;
        }

        #member,
        #event {
            float: left;
            width: 50%;

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

    while ($row = $res->fetch_assoc()) {
        echo "<h2>Grup " . $row['nama'] . "</h2>";
    }
    ?>

    <div id="member">
        <h2>Member</h2>
        <form method="POST">
            <input type="radio" name="rdo" id="rdoMhs" value="mahasiswa">
            <label>Mahasiswa</label>

            <input type="radio" name="rdo" id="rdoDos" value="dosen">
            <label>Dosen</label>
        </form>


        <label> Masukkan NRP/NPK atau Nama </label>
        <input type='text' name='txtSearch'>
        <input type="button" value="Submit" id="btnSearch">


        <table>
            <thead id="head">
                <tr>
                </tr>
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
        // else {
        //     echo "<div style='color:green; font-weight:bold;'>Berhasil didaftarkan!</div>";
        // }
        ?>
    </div>

    <div id="event">
        <h2>Event</h2>
        <a href="tambah_event.php?idgroup=<?php echo $idgroup ?>">Tambah Event</a>
        <?php
        $sqlEvent = "SELECT * FROM event WHERE idgrup = ?";
        $stmtEvent = $mysqli->prepare($sqlEvent);
        $stmtEvent->bind_param('i', $idgroup);
        $stmtEvent->execute();
        $resEvent = $stmtEvent->get_result();

        if ($resEvent->num_rows > 0) {
            echo "<table> 
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


                echo "<td><a href='edit_event.php?idgroup=" . $idgroup . "&idevent=" .  $rowEvent['idevent'] . "'>Edit event</a></td>";
                echo "<td><a href='hapus_event.php?idgroup=" . $idgroup . "&idevent=" . $rowEvent['idevent']  . "&ext=" . $rowEvent['poster_extension'] . "'>Hapus event</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>

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
                $("#head").append("<th>NRP</th><th>Nama</th><th>Username</th><th>Aksi</th>")
                $.each(mhs, function(i, item) {
                    $("#body").append("<tr> <td>" + item.id + "</td> <td>" + item.nama + "</td><td>" + item.username + "</td><td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan ke group</a></td> </tr>");
                })
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
                var mhs = JSON.parse(data);
                $("#head").append("<th>NPK</th><th>Nama</th><th>Username</th><th>Aksi</th>")
                $.each(mhs, function(i, item) {
                    $("#body").append("<tr> <td>" + item.id + "</td> <td>" + item.nama + "</td><td>" + item.username + "</td><td><a href='daftar_group.php?idgrup=" + idgroup + "&username=" + item.username + "'>Daftarkan ke group</a></td> </tr>");
                })
            })
    });
</script>