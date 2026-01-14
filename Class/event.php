<?php
require_once("parent.php");

class event extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertEvent(array $data)
    {
        $sqlCek = "SELECT COUNT(*) FROM event WHERE judul = ? AND tanggal = ?";
        $stmtCek = $this->mysqli->prepare($sqlCek);
        $stmtCek->bind_param('ss', $data['judul'], $data['tanggal']);
        $stmtCek->execute();
        $stmtCek->bind_result($count);
        $stmtCek->fetch();
        $stmtCek->close();

        if ($count > 0) {
            return "duplicate";
        }

        $sqlInsert = "INSERT INTO event 
            (idgrup, judul, `judul-slug`, tanggal, keterangan, jenis, poster_extension)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->mysqli->prepare($sqlInsert);
        $stmt->bind_param(
            'sssssss',
            $data['idgrup'],
            $data['judul'],
            $data['slug'],
            $data['tanggal_event'],
            $data['keterangan'],
            $data['jenis'],
            $data['ext']
        );

        if ($stmt->execute()) {
            $idEvent = $stmt->insert_id;
            $stmt->close();
            return $idEvent;
        } else {
            $stmt->close();
            return "gagal";
        }
    }

    public function deleteEvent($idevent)
    {
        $sql = "DELETE FROM event WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idevent);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getEventById($idevent)
    {
        $sql = "SELECT * FROM event WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getEventByGroupId($idgroup)
    {
        $sql = "SELECT * FROM event WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgroup);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function updateEvent(
        $idevent,
        $judul,
        $judulSlug,
        $tanggalEvent,
        $keterangan,
        $jenis,
        $ext = null
    ) {
        if ($ext != null) {
            $sql = "UPDATE event 
                SET judul = ?, `judul-slug` = ?, tanggal = ?, keterangan = ?, jenis = ?, poster_extension = ?
                WHERE idevent = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param(
                'ssssssi',
                $judul,
                $judulSlug,
                $tanggalEvent,
                $keterangan,
                $jenis,
                $ext,
                $idevent
            );
        } else {
            $sql = "UPDATE event 
                SET judul = ?, `judul-slug` = ?, tanggal = ?, keterangan = ?, jenis = ?
                WHERE idevent = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param(
                'sssssi',
                $judul,
                $judulSlug,
                $tanggalEvent,
                $keterangan,
                $jenis,
                $idevent
            );
        }

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getEventsByGroup($idgroup, $search = "")
    {
        $sql = "SELECT * FROM event WHERE idgrup = ?";


        if (!empty($search)) {
        $sql .= " AND judul LIKE ?";
        }


        $stmt = $this->mysqli->prepare($sql);


        if (!empty($search)) {
        $searched = "%" . $search . "%";
        $stmt->bind_param("is", $idgroup, $searched);
        } else {
        $stmt->bind_param("i", $idgroup);
        }


        $stmt->execute();
        return $stmt->get_result();
    }
}
