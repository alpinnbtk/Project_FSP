<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
</head>

<body>
    <?php
    // $mysqli = new mysqli("localhost", "root", "", "fullstack");
    // if ($mysqli->connect_errno) {
    //     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    //     exit();
    // }

    // $npk    = $_POST['txtNPK'];
    // $nama    = $_POST['txtNama'];
    // $foto     = $_FILES['fotoDosen'];
    // $username = $_POST['txtUsername'];
    // $password = $_POST['txtPassword'];

    // $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
    // $sql = "SELECT COUNT(*) FROM dosen WHERE npk = ? ";
    // $cek = $mysqli->prepare($sql);
    // $cek->bind_param('s', $npk);
    // $cek->execute();
    // $cek->bind_result($count);
    // $cek->fetch();
    // $cek->close();

    // if ($count > 0) {
    //     header("location: tambah_data_dosen.php?error=npk");
    //     exit();
    // } else {
    //     $sql = "INSERT INTO dosen (npk, nama, foto_extension)
    //         VALUES (?, ?, ?)";

    //     $sqlInsertAkun = "INSERT INTO akun (username, password, npk_dosen, isadmin)
    //         VALUES (?, ?, ?, ?);";

    //     $stmt = $mysqli->prepare($sql);
    //     $stmt->bind_param('sss', $npk, $nama, $ext);

    //     $isAdmin = 0;
    //     $stmtAkun = $mysqli->prepare($sqlInsertAkun);
    //     // $username = str_replace(",", "", str_replace(".", "", strtolower(str_replace(" ", "", $nama))));
    //     $hash_password = password_hash($password, PASSWORD_DEFAULT);
    //     $stmtAkun->bind_param('sssi', $username, $hash_password, $npk, $isAdmin);

    //     move_uploaded_file($foto['tmp_name'], "foto_dosen/" . $npk . "." . $ext);

    //     if ($stmt->execute()) {
    //         echo "Data berhasil disimpan!";
    //         $stmtAkun->execute();
    //     } else {
    //         header("location: tambah_data_dosen.php?error=insert");
    //     }
    //     header("location: tabel_data_dosen.php");
    // }

    require_once("Class/dosen.php");

    $dosen = new dosen();

    $npk    = $_POST['txtNPK'];
    $nama    = $_POST['txtNama'];
    $foto     = $_FILES['fotoDosen'];
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'npk' => $npk,
        'nama' => $nama,
        'ext' => $ext,
        'username' => $username,
        'password' => $hash_password
    ];

    $targetFile = "foto_dosen/" . $npk . "." . $ext;

    if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
        $response = $dosen->insertDosen($data);

        if ($response == "success") {
            header("location: tabel_data_dosen.php");
        } else if ($response == "duplicate") {
            unlink($target_file);
            header("location:tambah_data_dosen.php?error=npk");
        } else {
            unlink($target_file);
            header("location:tambah_data_dosen.php?error=insert");
        }
    } else {
        header("location:tambah_data_dosen.php?error=upload");
    }
    ?>
</body>

</html>