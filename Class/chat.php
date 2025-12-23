<?php
require_once("parent.php");

class chat extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getChat($idthread)
    {
        $sql = "SELECT * FROM chat WHERE idthread = ? ORDER BY tanggal_pembuatan ASC";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idthread);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }
}
