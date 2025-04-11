<?php
require_once "config/database.php";
class DetailDistribusi{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->Connect();
    }

    public function getallDetail(){
        $query = "SELECT * FROM detail_distribusi";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getallBarang(){
        $query = "SELECT id_barang, nama FROM barang";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAll() {
        $query = "SELECT d.id_detail_distribusi, d.distribusi_id, d.barang_id, b.nama AS nama_barang, d.jumlah, d.harga, d.tujuan, d.tanggal_distribusi, d.keterangan, d.alamat, d.nomortlp
                  FROM detail_distribusi d
                  JOIN barang b ON d.barang_id = b.id_barang";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}