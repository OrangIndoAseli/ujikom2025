<?php

require_once 'config/database.php';
require_once 'models/Distribusi.php';
require_once 'controllers/BarangController.php';

class DistribusiController {
    private $distribusiModel;

    public function __construct() {
        $this->distribusiModel = new Distribusi();
    }

    // Ambil semua distribusi dan tampilkan halaman
    public function index() {
        // Create BarangController without passing conn (it will create its own connection)
        $barangController = new BarangController();
        $distribusi_list = $this->distribusiModel->getAll();
        $barang = $barangController->getAllBarang();
        
        // Include view
        include 'views/content/distribusi.php';
    }

    // Ambil distribusi berdasarkan ID
    public function show($id) {
        return $this->distribusiModel->getById($id);
    }

    // Tambah distribusi baru
    public function store() {
        if (isset($_POST['barang_id'], $_POST['jumlah'], $_POST['tujuan'], $_POST['tanggal_distribusi'], $_POST['alamat'], $_POST['nomortlp'])) {
            $result = $this->distribusiModel->create(
                $_POST['barang_id'], 
                $_POST['jumlah'], 
                $_POST['tujuan'], 
                $_POST['tanggal_distribusi'],
                $_POST['alamat'],
                $_POST['nomortlp']
            );
            
            if (isset($result['success'])) {
                $_SESSION['message'] = $result['success'];
            } else {
                $_SESSION['message'] = $result['error'] ?? "Terjadi kesalahan";
            }
        } else {
            $_SESSION['message'] = "Data tidak lengkap";
        }
        
        // Redirect kembali ke halaman distribusi
        header("Location: index.php?page=distribusi");
        exit;
    }

    // Konfirmasi distribusi
    public function konfirmasi() {
        if (isset($_POST['id_distribusi'])) {
            $result = $this->distribusiModel->konfirmasi($_POST['id_distribusi']);

            if (isset($result['success'])) {
                $_SESSION['message'] = $result['success'];
            } else {
                $_SESSION['message'] = $result['error'] ?? "Terjadi kesalahan saat konfirmasi";
            }
        } else {
            $_SESSION['message'] = "ID distribusi tidak ditemukan untuk konfirmasi";
        }

        header("Location: index.php?page=distribusi");
        exit;
    }

    // Hapus distribusi
    public function destroy() {
        if (isset($_POST['id_distribusi'])) {
            $result = $this->distribusiModel->delete($_POST['id_distribusi']);
            
            if (isset($result['success'])) {
                $_SESSION['message'] = $result['success'];
            } else {
                $_SESSION['message'] = $result['error'] ?? "Terjadi kesalahan";
            }
        } else {
            $_SESSION['message'] = "ID distribusi tidak ditemukan";
        }
        
        // Redirect kembali ke halaman distribusi
        header("Location: index.php?page=distribusi");
        exit;
    }

    // Tambahan untuk mendapatkan daftar barang
    public function getAllBarang() {
        $barangController = new BarangController();
        return $barangController->getAllBarang();
    }
}
?>