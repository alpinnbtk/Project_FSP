<?php
require_once("parent.php");

class dosen extends orangtua
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDosen($keyword_judul, $offset = null, $limit = null)
    {
        $sql = "select * from dosen";

        if (!empty($keyword_judul)) {
            if (is_numeric($keyword_judul)) {
                $sql .= " where npk like ?";
            } else {
                $sql .= " where nama like ?";
            }
        }

        if (!is_null($offset)) $sql .= " limit ?,?";

        $stmt = $this->mysqli->prepare($sql);
        $modified_keyword = '%' . $keyword_judul . '%';

        if (!empty($keyword_judul) && !is_null($offset)) {
            $stmt->bind_param('sii', $modified_keyword, $offset, $limit);
        } else if (!empty($keyword_judul)) {
            $stmt->bind_param('s', $modified_keyword);
        } else if (empty($keyword_judul) && !is_null($offset)) {
            $stmt->bind_param('ii', $offset, $limit);
        }


        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }

    public function getTotalData($keyword_judul)
    {
        $res = $this->getDosen($keyword_judul);
        return $res->num_rows;
    }

    // function insertDosen($arr_col)
    // {
    //     $sql = "Insert Into movie (judul, rilis, serial, skor, sinopsis) Values (?,?,?,?,?)";
    //     $stmt = $this->mysqli->prepare($sql);
    //     $stmt->bind_param("ssids", $arr_col['judul'], $arr_col['rilis'], $arr_col['serial'], $arr_col['skor'], $arr_col['sinopsis']);
    //     $stmt->execute();
    //     return $stmt->insert_id;
    // }
}
