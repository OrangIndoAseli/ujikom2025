<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="public/img/gudang.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Di bagian head -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="public/assets/style.css">
</head>
<body>

   <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" >
    <div class="container-fluid justify-content-between">
        <!-- Kiri: Toggle + Inventory -->
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-light me-2" id="toggleSidebar">☰</button>
            <a class="navbar-brand mb-0 h1" href="#">Inventory</a>
        </div>

        <!-- Kanan: Sapaan Admin -->
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Hi, Admin</span>
            <!-- Jika ingin dropdown nanti bisa ditambahkan di sini -->
        </div>
    </div>
</nav>



    <div class="content" id="mainContent"> 
        <!-- Konten utama akan dimuat di sini -->
