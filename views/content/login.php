<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GudangKu - Login</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="public/assets/login.css" />
</head>
<body>

<main class="d-flex align-items-center justify-content-center login-wrapper">
  <div class="login-box text-center">
    
    <!-- Logo dan Judul -->
    <img src="public/img/logo.png" alt="Logo GudangKu" class="brand-logo">
    <div class="brand-name mb-3">GudangKu</div>
    <p class="text-muted mb-4">Silakan login menggunakan akun Anda</p>

    <!-- Form Login -->
    <form action="index.php?page=login&action=login" method="POST">
      <div class="mb-3 text-start">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>

      <div class="d-grid mt-3">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</main>

</body>
</html>