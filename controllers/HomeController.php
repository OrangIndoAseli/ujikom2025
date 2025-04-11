<?php
require_once 'models/Barang.php';
require_once 'models/DetailDistribusi.php';
require_once 'models/Supplier.php';

class HomeController {
    private $barangModel;
    private $distribusiModel;
    private $supplierModel;

    public function __construct($db) {
        $this->barangModel = new Barang($db);
        $this->distribusiModel = new Distribusi($db);
        $this->supplierModel = new Supplier($db);
    }

    public function index() {
        $dataBarang = $this->barangModel->getAll();
        $jumlahBarang = count($dataBarang);

        $distribusiBarang = $this->distribusiModel->getAll();
        $jumlahDistribusi = count($distribusiBarang);

        $dataSupplier = $this->supplierModel->getAll();
        $jumlahSupplier = count($dataSupplier);

        // variabel ini akan tersedia di view
        include 'views/content/home.php';
    }
}
