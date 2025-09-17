<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Mahasiswa</title>
    <style>
        table, th, tr, td {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        img {
            width: 150px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h2>Tabel Data Mahasiswa</h2>
    <?php
        echo "<form method = 'GET' action = 'tabel_data_mahasiswa.php'>";
        echo "<label> Masukkan Judul </label>";
        echo "<input type = 'text' name = 'txtSearch'>";
        echo "<input type = 'submit' name = 'btnSearch'>";
        echo "";
        $mysqli = new mysqli("localhost", "root", "", "fullstack");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }

        if(isset($_GET['btnSearch'])) {
            $prompt = $_GET['txtSearch'];
            $searched = "%".$prompt."%";
            if (is_numeric($prompt)) {
                $stmt = $mysqli->prepare("SELECT * FROM mahasiswa WHERE nrp LIKE ?");
            }
            else {
                $stmt = $mysqli->prepare("SELECT * FROM mahasiswa WHERE nama LIKE ?");
            }
            $stmt->bind_param("s", $searched);
        } else {
            $stmt = $mysqli->prepare("SELECT * FROM mahasiswa");
        }
        
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo "<table> 
                <tr> 
                    <th>NRP Mahasiswa</th> 
                    <th>Nama Mahasiswa</th> 
                    <th>Gender</th> 
                    <th>Tanggal Lahir</th>
                    <th>Angkatan</th>
                    <th>Foto Mahasiswa</th>
                    <th>Aksi</th> 
                    <th>Hapus</th>
                </tr>";

            while($row = $res->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>".$row['nrp']."</td>" ; 
                    echo "<td>". $row['nama']."</td>";
                    echo "<td>".$row['gender']."</td>";
                    echo "<td>".$row['tanggal_lahir']."</td>";
                    echo "<td>".$row['angkatan']."</td>";
                    echo "<td><img src = 'foto_mahasiswa/".$row['nrp'].".".$row['foto_extention']."'</td>";
                    echo "<td><a href='edit_data_mahasiswa.php?nrp=".$row['nrp']."'>Ubah Data</a></td>";
                    echo "<td><a href='hapus_data_mahasiswa.php?nrp=".$row['nrp']."'>Hapus Data</a></td>";
                echo "</tr>";
            }
            echo "</table>" ;
            echo "<a href = 'tambah_data_mahasiswa.php'>Tambah Data Mahasiswa</a>";
        } else {
            echo "<p>Tidak ada data ditemukan.</p>";
        }
        
    ?>
</body>
</html>