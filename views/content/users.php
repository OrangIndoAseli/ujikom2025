<?php
// Pastikan $users adalah array yang valid
$users = $users ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Kelola Akun</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center; /* Center vertically */
            background-color: #f0f2f5; /* Light background color */
            margin: 0; /* Remove default margin */
        }
        .container {
            flex: 1; /* Allow the container to grow and fill the space */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            padding: 20px; /* Add some padding */
        }
        .card {
            width: 100%;
            max-width: 800px; /* Set a max width for the card to make it wider */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div>
        <h2 class="mb-4 text-center" style="color: #007bff;">Kelola Akun</h2>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($users['username'])): // Cek jika username ada di dalam $users ?>
            <div class="card mb-4" style="background-color: #f8f9fa;">
                <div class="card-body" style="padding: 40px;">
                    <h5 class="card-title text-center" style="color: #007bff; font-weight: bold;">Update Password untuk <?= htmlspecialchars($users['username']); ?></h5>

                    <!-- Form untuk update password -->
                    <form method="POST" action="index.php?page=users&action=update">

                        <!-- ID User -->
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($users['id_user']); ?>">

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($users['username']); ?>">
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password baru">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Show</button>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Konfirmasi password baru">
                                <button type="button" class="btn btn-outline-secondary" onclick="toggleConfirmPassword()">Show</button>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #007bff; border-color: #007bff; padding: 12px;">Update Password</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                User tidak ditemukan atau data tidak valid!
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordButton = event.target;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordButton.textContent = "Hide";
        } else {
            passwordField.type = "password";
            passwordButton.textContent = "Show";
        }
    }

    function toggleConfirmPassword() {
        var confirmPasswordField = document.getElementById('confirm_password');
        var confirmPasswordButton = event.target;
        if (confirmPasswordField.type === "password") {
            confirmPasswordField.type = "text";
            confirmPasswordButton.textContent = "Hide";
        } else {
            confirmPasswordField.type = "password";
            confirmPasswordButton.textContent = "Show";
        }
    }
</script>