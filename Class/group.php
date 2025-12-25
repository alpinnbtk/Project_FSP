<?php
require_once("parent.php");

class group extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tambahGroup(array $input)
    {
        $sql = "SELECT COUNT(*) FROM grup WHERE nama = ? ";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $input['namaGroup']);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            return "duplicate";
        } else {
            $sqlGroup = "INSERT INTO grup (username_pembuat, nama, deskripsi, tanggal_pembentukan, jenis, kode_pendaftaran)
            VALUES (?, ?, ?, ?, ?, ?)";
            $kode = '';
            $stmtGroup = $this->mysqli->prepare($sqlGroup);
            $stmtGroup->bind_param('ssssss', $input['username'], $input['namaGroup'], $input['deskripsi'], $input['tanggal'], $input['jenis'], $kode);

            if ($stmtGroup->execute()) {
                $id = $this->mysqli->insert_id;
                $kode = "UBAYA" . $id;

                $sqlUpdate = "UPDATE grup SET kode_pendaftaran = ? WHERE idgrup = ?;";
                $stmtUpdate = $this->mysqli->prepare($sqlUpdate);
                $stmtUpdate->bind_param('si', $kode, $id);
                $stmtUpdate->execute();

                $sqlMember = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";
                $stmtMember = $this->mysqli->prepare($sqlMember);
                $stmtMember->bind_param('ss', $id, $input['username']);
                $stmtMember->execute();

                return "success";
            } else {

                return "insert";
            }
        }
    }

    public function getGroupByUsernamePembuat(string $username)
    {
        $sql = "SELECT * FROM grup where username_pembuat = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    public function getGroupByMember(string $username)
    {
        $sql = "SELECT * 
            FROM grup g 
            INNER JOIN member_grup m ON g.idgrup = m.idgrup 
            WHERE m.username = ?";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    public function deleteGroup($idgrup)
    {
        $sql = "DELETE FROM grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $idgrup);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getGroupPublik(string $username)
    {
        $sql = "SELECT * FROM grup 
            WHERE jenis = 'Publik' 
            AND idgrup NOT IN (
                SELECT idgrup FROM member_grup WHERE username = ?
            )";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }


    public function updateGroup($idgrup, $nama, $jenis)
    {
        $sql = "UPDATE grup SET nama = ?, jenis = ? WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssi", $nama, $jenis, $idgrup);

        $hasil = $stmt->execute();
        $stmt->close();

        return $hasil;
    }

    public function getGroupByKode(string $kode)
    {
        $sql = "SELECT * FROM grup WHERE kode_pendaftaran = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    public function getGroupById(string $idgroup)
    {
        $sql = "SELECT * FROM grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $idgroup);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res->fetch_assoc();
    }
}
