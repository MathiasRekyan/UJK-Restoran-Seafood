<?php 
session_start(); 
include 'koneksi.php'; 

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if($kategori != ''){
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='$kategori'");
} else {
    // acak data 
    $query = mysqli_query($conn, "SELECT * FROM menu ORDER BY RAND()");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Menu Restoran</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-color: #f5f7fb;
}

.navbar {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    height: 200px;
    object-fit: cover;
}

.badge {
    font-size: 0.8rem;
}

.filter-btn .btn {
    border-radius: 20px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
<div class="container">
<span class="navbar-brand fw-bold">🍽️ Menu Restoran</span>
<div>
<?php if(isset($_SESSION['login'])): ?>
<a href="dashboard.php" class="btn btn-success btn-sm">Dashboard</a>
<a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
<?php else: ?>
<a href="login.php" class="btn btn-light btn-sm">Login</a>
<?php endif; ?>
</div>
</div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

    <!-- FILTER -->
    <div class="d-flex justify-content-center mb-4 filter-btn">
        <a href="index.php" class="btn btn-outline-dark mx-1 <?= $kategori==''?'active':'' ?>">Semua</a>
        <a href="?kategori=Makanan" class="btn btn-outline-primary mx-1 <?= $kategori=='Makanan'?'active':'' ?>">Makanan</a>
        <a href="?kategori=Minuman" class="btn btn-outline-success mx-1 <?= $kategori=='Minuman'?'active':'' ?>">Minuman</a>
    </div>

    <!-- GRID MENU -->
    <div class="row g-4">
        <?php while($r=mysqli_fetch_assoc($query)){ ?>
        <div class="col-md-4">

            <div class="card h-100">

                <!-- Gambar -->
                <img src="uploads/<?= $r['gambar'] ? $r['gambar'] : 'default.jpg'; ?>" class="card-img-top">

                <div class="card-body d-flex flex-column">

                    <!-- Nama -->
                    <h5 class="fw-bold"><?= $r['nama_menu']; ?></h5>

                    <!-- Kategori -->
                    <span class="badge 
                        <?= $r['kategori']=='Makanan' ? 'bg-primary' : 'bg-success'; ?>">
                        <?= $r['kategori']; ?>
                    </span>

                    <!-- Deskripsi -->
                    <p class="text-muted mt-2 flex-grow-1">
                        <?= $r['deskripsi']; ?>
                    </p>

                    <!-- Harga -->
                    <h6 class="fw-bold text-dark">
                        Rp <?= number_format($r['harga']); ?>
                    </h6>

                </div>

            </div>

        </div>
        <?php } ?>
    </div>

</div>

</body>
</html>