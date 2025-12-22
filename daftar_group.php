<?php

// $mysqli = new mysqli("localhost", "root", "", "fullstack");
// if ($mysqli->connect_errno) {
//     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
//     exit();
// }
require_once("Class/member_group.php");

$idgrup = $_GET['idgrup'];
$username = $_GET['username'];

// $sql = "SELECT COUNT(*) FROM member_grup WHERE idgrup = ? and username = ? ";
// $cek = $mysqli->prepare($sql);
// $cek->bind_param('is', $idgrup, $username);
// $cek->execute();
// $cek->bind_result($count);
// $cek->fetch();
// $cek->close();

$memberGroup = new member_group();

$dataMemberGroup = $memberGroup->isMember($username, $idgrup);
if ($dataMemberGroup) {
    header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username&error=idgrup");
} else {
    $dataInsertMember = $memberGroup->joinGroup($username, $idgrup);

    if ($dataInsertMember) {
        header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username");
    } else {
        header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username&error=insert");
    }
}

// if ($count > 0) {
//     header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username&error=idgrup");
//     exit();
// } else {
//     $sql = "INSERT INTO member_grup (idgrup, username) values (?, ?);";
//     $stmt = $mysqli->prepare($sql);
//     $stmt->bind_param("is", $idgrup, $username);

//     if ($stmt->execute()) {
//         echo "Data berhasil ditambahkan!";
//     } else {
//         header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username&error=insert");
//     }
//     header("location: detail_group_dosen.php?idgrup=$idgrup&username=$username");
// }
