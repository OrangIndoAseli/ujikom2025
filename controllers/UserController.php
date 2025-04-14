<?php
require_once 'models/Users.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new Users(); 
    }
    
    public function index() {
        $users = $this->userModel->getAll();
        if ($users) {
            include_once 'views/content/users.php';
        }
    }
    public function show($id_user) {
        // Mendapatkan data pengguna berdasarkan id_user
        $users = $this->userModel->getById($id_user);
    
        // Jika pengguna ditemukan, kirim ke view
        if ($users) {
            include_once 'views/content/users.php';
        } else {
            // Jika tidak ditemukan, tampilkan pesan
            echo "User not found!";
        }
    }
    

    public function update($id_user, $data) {
        $id_user = $data['id_user'];
        $username = $data['username'];
        $password = $data['password'];
        $confirmPassword = $data['confirm_password'];
    
        // Validasi konfirmasi password
        if ($password !== $confirmPassword) {
            echo "Password dan konfirmasi password tidak cocok.";
            return;
        }
    
        // Update password di database
        $result = $this->userModel->updatePassword($id_user, $username,$password);
    
        if ($result) {
            // Menyimpan pesan ke session
            $_SESSION['success_message'] = "Password berhasil diganti.";
    
            // Redirect ke halaman user
            header("Location: index.php?page=users&action=show&id=$id_user");
            exit; // Pastikan tidak ada output lain yang dikirim setelah redirect
        } else {
            echo "Gagal memperbarui password!";
        }
    }
    
}
?>
