<?php
require_once("parent.php");

class member_group extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function keluarGroup($username, $idgrup)
    {
        $sql = "DELETE FROM member_grup WHERE username = ? AND idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ss', $username, $idgrup);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function hapusMember($username)
    {
        $sql = "DELETE FROM member_grup WHERE username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function isMember(string $username, int $idgrup)
    {
        $sql = "SELECT COUNT(*) FROM member_grup WHERE username = ? AND idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $username, $idgrup);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    public function joinGroup(string $username, int $idgrup)
    {
        $sql = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("is", $idgrup, $username);
        $hasil = $stmt->execute();
        $stmt->close();

        return $hasil;
    }

    public function countMember(int $idgrup)
    {
        $sql = "SELECT COUNT(*) FROM member_grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count;
    }

    public function getMemberByGroup(int $idgrup, string $search = "")
    {
        $sql = "
            SELECT 
                mg.idgrup,
                mg.username,
                a.npk_dosen,
                a.nrp_mahasiswa,
                d.foto_extension AS foto_dosen,
                m.foto_extention AS foto_mahasiswa
            FROM member_grup mg
            INNER JOIN akun a ON mg.username = a.username
            LEFT JOIN dosen d ON a.npk_dosen = d.npk
            LEFT JOIN mahasiswa m ON a.nrp_mahasiswa = m.nrp
            WHERE mg.idgrup = ?
        ";

        if ($search !== "") {
            $sql .= " AND mg.username LIKE ? ";
        }

        $sql .= " ORDER BY a.npk_dosen DESC";

        $stmt = $this->mysqli->prepare($sql);

        if ($search !== "") {
            $like = "%" . $search . "%";
            $stmt->bind_param("is", $idgrup, $like);
        } else {
            $stmt->bind_param("i", $idgrup);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
