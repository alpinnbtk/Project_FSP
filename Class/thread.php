<?php
require_once("parent.php");

class thread extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getThread($idgrup)
    {
        $sql = "SELECT * FROM thread WHERE idgrup = ? ORDER BY tanggal_pembuatan ASC";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function getThreadById($idthread)
    {
        $sql = "SELECT * FROM thread WHERE idthread = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idthread);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc();
    }

    public function tambahThread($idgrup, $username)
    {
        $sql = "INSERT INTO thread (idgrup, username_pembuat, tanggal_pembuatan, status) VALUES (?, ?, now(), 'Open');";
        $stmt   = $this->mysqli->prepare($sql);
        $stmt->bind_param("is", $idgrup, $username);
        return $stmt->execute();
    }

    public function closeThread($idthread, $username)
    {
        $sql = "UPDATE thread SET status = 'Close' WHERE idthread = ? AND username_pembuat = ?";
        $stmt   = $this->mysqli->prepare($sql);
        $stmt->bind_param("is", $idthread, $username);
        return $stmt->execute();
    }
}
