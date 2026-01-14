<?php

require_once("Class/member_group.php");

$idgrup = $_GET['idgrup'];
$username = $_GET['username'];

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


