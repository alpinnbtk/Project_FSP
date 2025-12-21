<?php
require_once("parent.php");

class dosen extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDosen($keyword_judul = '', $offset = null, $limit = null)
    {
        $sql = "select * from dosen";
        $modified_keyword = '%' . $keyword_judul . '%';

        if (!empty($keyword_judul)) {
            if (is_numeric($keyword_judul)) {
                $sql .= " where npk like ?";
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
        $sql = "select count(*) as total from dosen";
        $modified_keyword = '%' . $keyword_judul . '%';

        if (!empty($keyword_judul)) {
            if (is_numeric($keyword_judul)) {
                $sql .= " where npk like ?";
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

    public function insertDosen(array $input)
    {
        $sqlCek = "SELECT COUNT(*) FROM dosen WHERE npk = ? ";
        $stmtCek = $this->mysqli->prepare($sqlCek);
        $stmtCek->bind_param('s', $input['npk']);
        $stmtCek->execute();
        $stmtCek->bind_result($count);
        $stmtCek->fetch();
        $stmtCek->close();

        if ($count > 0) {
            return "duplicate";
        } else {
            $sqlDosen = "INSERT INTO dosen (npk, nama, foto_extension) VALUES (?, ?, ?)";
            $stmtDosen = $this->mysqli->prepare($sqlDosen);
            $stmtDosen->bind_param('sss', $input['npk'], $input['nama'], $input['ext']);

            if (!$stmtDosen->execute()) {
                return "gagal_insertDosen";
            }
            $stmtDosen->close();

            $sqlAkun = "INSERT INTO akun (username, password, npk_dosen, isadmin)
            VALUES (?, ?, ?, ?);";
            $stmtAkun = $this->mysqli->prepare($sqlAkun);
            $isAdmin = 0;

            $stmtAkun->bind_param('sssi', $input['username'], $input['password'], $input['npk'], $isAdmin);

            if (!$stmtAkun->execute()) {
                return "gagal_insertAkun";
            }
            $stmtAkun->close();

            return "success";
        }
    }

    public function editDosen(array $data, array $foto)
    {
        $npkAwal = $data['npk_awal'];
        $nama = $data['nama'];

        if (!empty($foto['name'])) {
            $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

            $sql = "UPDATE dosen SET nama = ?, foto_extension = ? WHERE npk = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('sss', $nama, $ext, $npkAwal);
        } else {
            $sql = "UPDATE dosen SET nama = ? WHERE npk = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('ss', $nama, $npkAwal);
        }

        return $stmt->execute();
        $stmt->close();
    }

    public function deleteDosen($npk)
    {
        $sql = "DELETE FROM dosen WHERE npk = ?";
        $stmt = $this->mysqli->prepare($sql);

        $stmt->bind_param('i', $npk);

        return $stmt->execute();
        $stmt->close();
    }

    public function cariDosen($prompt)
    {
        $sql = "SELECT 
                d.npk AS id,
                d.nama,
                a.username,
                d.foto_extension
            FROM dosen d
            INNER JOIN akun a ON d.npk = a.npk_dosen
            WHERE d.npk LIKE ? OR d.nama LIKE ?
            ORDER BY d.nama ASC";

        $stmt = $this->mysqli->prepare($sql);
        $keyword = "%" . $prompt . "%";
        $stmt->bind_param("ss", $keyword, $keyword);
        $stmt->execute();

        return $stmt->get_result();
    }
}
