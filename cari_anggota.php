<?php
    $mysqli = new mysqli("localhost", "root", "", "fullstack");

    $peran = $_POST['peran'];
    $prompt = $_POST['prompt'];

    $data = [];

    if ($peran == "mahasiswa") {

        $sql = "SELECT m.nrp AS id, m.nama, a.username, m.foto_extention 
                FROM mahasiswa m
                INNER JOIN akun a ON m.nrp = a.nrp_mahasiswa
                WHERE m.nrp LIKE ? OR m.nama LIKE ?
                ORDER BY m.nama ASC";
        
        $stmt = $mysqli->prepare($sql);
        $searched = "%" . $prompt . "%";
        $stmt->bind_param("ss", $searched, $searched);

    } else if ($peran == "dosen") {

        $sql = "SELECT d.npk AS id, d.nama, a.username, d.foto_extension 
                FROM dosen d
                INNER JOIN akun a ON d.npk = a.npk_dosen
                WHERE d.npk LIKE ? OR d.nama LIKE ?
                ORDER BY d.nama ASC";
        
        $stmt = $mysqli->prepare($sql);
        $searched = "%" . $prompt . "%";
        $stmt->bind_param("ss", $searched, $searched);
    }

    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
?>
