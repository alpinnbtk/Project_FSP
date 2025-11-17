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
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
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

    $sql = "SELECT * FROM grup where idgrup = $idgroup";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        echo "<h2>Grup " . $row['nama'] . "</h2>";
    }
    ?>
    <form method="POST">
        <input type="radio" name="rdo" id="rdoMhs" value="mahasiswa">
        <label>Mahasiswa</label>

        <input type="radio" name="rdo" id="rdoDos" value="dosen">
        <label>Dosen</label>
    </form>

    <table>
        <thead id="head">
            <tr>
            </tr>
        </thead>
        <tbody id="body"></tbody>
    </table>


</body>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'idgrup') {
        echo "<div style='color:red; font-weight:bold;'>Sudah terdaftar di grup ini!</div>";
    } else if ($_GET['error'] == 'insert') {
        echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
    }
}
?>

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