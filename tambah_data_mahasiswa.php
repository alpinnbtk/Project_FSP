<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Data Mahasiswa</title>
</head>

<body>
      <h2>Tambah Data Mahasiswa</h2>
      <?php
      $mysqli = new mysqli("localhost", "root", "", "fullstack");
      if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
      }

      echo "<form method = 'POST' action = 'tambah_data_mahasiswa_proses.php?' enctype = 'multipart/form-data'>";
      echo "<label>NRP Mahasiswa : </label>
              <input type = 'text' name = 'txtNRP' required><br>";
      echo "<label>Nama Mahasiswa : </label>
              <input type = 'text' name = 'txtNama' required><br>";
      echo "<label>Gender Mahasiswa : </label>
              <select name = 'genderMhs' required>
                <option value = 'Pria'>Pria</option>
                <option value = 'Wanita'>Wanita</option>
              </select><br>";
      echo "<label>Tanggal Lahir : </label>
              <input type = 'date' name = 'txtTanggalLahir' required><br>";
      echo "<label>Angkatan Mahasiswa : </label>
              <input type = 'text' name = 'txtAngkatan' required><br>";
      echo "<label>Foto Mahasiswa : </label>
              <input type = 'file' name = 'fotoMahasiswa' accept='image/jpg, image/png'><br>";
      echo "<input type = 'submit' name = 'btnSubmit'>";
      echo "</form>";

      if (isset($_GET['error'])) {
            if ($_GET['error'] == 'nrp') {
                  echo "<div style='color:red; font-weight:bold;'>NRP sudah terdaftar sebelumnya!</div>";
            } elseif ($_GET['error'] == 'insert') {
                  echo "<div style='color:red; font-weight:bold;'>Gagal menyimpan data!</div>";
            }
      }
      ?>
</body>

</html>