<?php
require_once 'config/database.php';

class Users {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect(); 
    }

    public function login($username, $password) {
        $password = md5($password); // Tetap gunakan hash md5 sesuai skema awal

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return ($result->num_rows > 0) ? $result->fetch_assoc() : false;
    }

    public function getAll() {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getById($id_user) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? $result->fetch_assoc() : null; // Kembalikan data pengguna atau null
    }

    public function updatePassword($id_user, $username, $password) {
        $password = md5($password); // Hash password dengan md5
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, password = ? WHERE id_user = ?");
        $stmt->bind_param("ssi", $username,$password, $id_user); // Menggunakan id_user yang dinamis
        return $stmt->execute(); // Periksa apakah query dijalankan dengan sukses
    }


    
    
}