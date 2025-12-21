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

            $stmtAkun->bind_param('sssi', $input['username'], $input['password'], $input['nrp'], $isAdmin);

            if (!$stmtAkun->execute()) {
                return "gagal_insertAkun";
            }
            $stmtAkun->close();

            return "success";
        }
    }


    public function editMahasiswa(array $data, array $foto)
    {
        $nrpAwal = $data['nrp_awal'];
        $nama = $data['nama'];
        $gender = $data['gender'];
        $tanggalLahir = $data['tanggal_lahir'];
        $angkatan = $data['angkatan'];

        if (!empty($foto['name'])) {
            $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);

            $sql = "UPDATE mahasiswa SET nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ?, foto_extention = ? WHERE nrp = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('ssssss', $nama, $gender, $tanggalLahir, $angkatan, $ext, $nrpAwal);
        } else {
            $sql = "UPDATE mahasiswa SET nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ? WHERE nrp = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('sssss', $nama, $gender, $tanggalLahir, $angkatan, $nrpAwal);
        }

        // if ($stmt->execute()) {
        //     return true;
        // }

        return $stmt->execute();
        $stmt->close();
    }

    public function deleteMahasiswa($nrp)
    {
        $sql = "DELETE FROM mahasiswa WHERE nrp = ?";
        $stmt = $this->mysqli->prepare($sql);

        $stmt->bind_param('i', $nrp);

        return $stmt->execute();
        $stmt->close();
    }

    public function getMahasiswaByNRP($nrp)
    {
        $sql = "SELECT * FROM mahasiswa WHERE nrp = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $nrp);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function cariMahasiswa($prompt)
    {
        $sql = "SELECT 
                m.nrp AS id,
                m.nama,
                a.username,
                m.foto_extention
            FROM mahasiswa m
            INNER JOIN akun a ON m.nrp = a.nrp_mahasiswa
            WHERE m.nrp LIKE ? OR m.nama LIKE ?
            ORDER BY m.nama ASC";

        $stmt = $this->mysqli->prepare($sql);
        $keyword = "%" . $prompt . "%";
        $stmt->bind_param("ss", $keyword, $keyword);
        $stmt->execute();

        return $stmt->get_result();
    }
}
