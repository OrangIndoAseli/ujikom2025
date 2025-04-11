<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login($post) {
        $username = $post['username'] ?? '';
        $password = $post['password'] ?? '';

        $user = $this->userModel->login($username, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: index.php?page=home");
        } else {
            $_SESSION['error'] = "Username atau password salah!";
            header("Location: index.php?page=login");
        }
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
