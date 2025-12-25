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
        $sql = "SELECT c.idthread, c.username_pembuat, c.isi, TIME(c.tanggal_pembuatan) as tanggal_pembuatan, 
            d.nama as nama_dosen, m.nama as nama_mahasiswa FROM chat c JOIN akun a ON c.username_pembuat = a.username 
            LEFT JOIN dosen d on d.npk = a.npk_dosen 
            LEFT JOIN mahasiswa m on m.nrp = a.nrp_mahasiswa 
            WHERE c.idthread = ? ORDER BY c.tanggal_pembuatan ASC;";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idthread);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function kirimChat($idthread, $username, $isi)
    {
        $sql = "INSERT INTO chat (idthread, username_pembuat, isi, tanggal_pembuatan) VALUES (?, ?, ?, now());";
        $stmt   = $this->mysqli->prepare($sql);
        $stmt->bind_param("iss", $idthread, $username, $isi);
        return $stmt->execute();
    }
}
