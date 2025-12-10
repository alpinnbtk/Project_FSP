<?php
require_once("parent.php");

class mahasiswa extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMahasiswa($keyword_judul = '', $offset = null, $limit = null)
    {
        $sql = "select * from mahasiswa";
        $modified_keyword = '%' . $keyword_judul . '%';

        if (!empty($keyword_judul)) {
            if (is_numeric($keyword_judul)) {
                $sql .= " where nrp like ?";
            } else {
                $sql .= " where nama like ?";
            }
        }

        if (!is_null($offset) && !is_null($limit)) {
            $sql .= " limit ?,?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!empty($keyword_judul) && !is_null($offset) && !is_null($limit)) {
            $stmt->bind_param('sii', $modified_keyword, $offset, $limit);
        } else if (!empty($keyword_judul)) {
            $stmt->bind_param('s', $modified_keyword);
        } else if (empty($keyword_judul) && !is_null($offset) && !is_null($limit)) {
            $stmt->bind_param('ii', $offset, $limit);
        }


        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }

    public function getTotalData($keyword_judul)
    {
        $sql = "select count(*) as total from mahasiswa";
        $modified_keyword = '%' . $keyword_judul . '%';

        if (!empty($keyword_judul)) {
            if (is_numeric($keyword_judul)) {
                $sql .= " where nrp like ?";
            } else {
                $sql .= " where nama like ?";
            }
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!empty($keyword_judul)) {
            $stmt->bind_param('s', $modified_keyword);
        }

        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();

        return $row['total'] ? $row['total'] : 0;
    }

    public function insertMahasiswa(array $input)
    {
        $sqlCek = "SELECT COUNT(*) FROM mahasiswa WHERE nrp = ? ";
        $stmtCek = $this->mysqli->prepare($sqlCek);
        $stmtCek->bind_param('s', $input['nrp']);
        $stmtCek->execute();
        $stmtCek->bind_result($count);
        $stmtCek->fetch();
        $stmtCek->close();

        if ($count > 0) {
            return "duplicate";
        } else {
            $sqlMhs = "INSERT INTO mahasiswa (nrp, nama, gender, tanggal_lahir, angkatan, foto_extention) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtMhs = $this->mysqli->prepare($sqlMhs);
            $stmtMhs->bind_param('ssssss', $input['nrp'], $input['nama'], $input['gender'], $input['tanggal_lahir'], $input['angkatan'], $input['ext']);

            if (!$stmtMhs->execute()) {
                return "gagal_insertMahasiswa";
            }
            $stmtMhs->close();

            $sqlAkun = "INSERT INTO akun (username, password, nrp_mahasiswa, isadmin)
            VALUES (?, ?, ?, ?);";
            $stmtAkun = $this->mysqli->prepare($sqlAkun);
            $isAdmin = 0;

            $stmtAkun->bind_param('sssi', $input['username'], $input['hash_password'], $input['npk'], $isAdmin);

            if (!$stmtAkun->execute()) {
                return "gagal_insertAkun";
            }
            $stmtAkun->close();

            return "success";
        }
    }
}
