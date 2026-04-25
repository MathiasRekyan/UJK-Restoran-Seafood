<?php 
session_start(); 
if(!isset($_SESSION['login'])) header("Location: login.php"); 
include 'koneksi.php'; 

// statistik
$total_menu = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM menu"))['total'];
$total_pesanan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM pesanan"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-color: #f5f7fb;
}

.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.table th {
    background-color: #f1f3f6;
}

.navbar {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">Admin Panel</span>
        <div>
            <a href="pesanan/pesanan.php" class="btn btn-info btn-sm">📦 Pesanan</a>
            <a href="index.php" class="btn btn-outline-light btn-sm">👀 Lihat Menu</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

    <!-- STAT CARD -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="text-muted">Total Menu</h6>
                <h3><?= $total_menu; ?></h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="text-muted">Total Pesanan</h6>
                <h3><?= $total_pesanan; ?></h3>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Manajemen Menu</h4>
        <a href="menu/tambah.php" class="btn btn-primary">
            + Tambah Menu
        </a>
    </div>

    <!-- TABLE MENU -->
    <div class="card p-3 mb-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $q=mysqli_query($conn,"SELECT * FROM menu");
                while($r=mysqli_fetch_assoc($q)){ 
                ?>
                <tr>
                    <td>
                        <img src="uploads/<?= $r['gambar']; ?>" 
                        style="width:70px; height:70px; object-fit:cover; border-radius:10px;">
                    </td>

                    <td class="fw-semibold"><?= $r['nama_menu']; ?></td>

                    <td>
                        <span class="badge bg-success p-2">
                            Rp <?= number_format($r['harga']); ?>
                        </span>
                    </td>

                    <td class="text-center">
                        <a href="menu/edit.php?id=<?= $r['id']; ?>" 
                        class="btn btn-warning btn-sm">Edit</a>

                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $r['id']; ?>)">
                            Hapus
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- RECENT ORDER -->
    <div class="card p-3">
        <h5 class="mb-3">🕒 Pesanan Terbaru</h5>

        <table class="table">
            <tr>
                <th>Nama</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>

            <?php 
            $q2 = mysqli_query($conn,"
            SELECT pesanan.*, menu.nama_menu 
            FROM pesanan 
            JOIN menu ON pesanan.menu_id = menu.id
            ORDER BY pesanan.id DESC LIMIT 5
            ");

            while($p=mysqli_fetch_assoc($q2)){
            ?>
            <tr>
                <td><?= $p['nama_pelanggan']; ?></td>
                <td><?= $p['nama_menu']; ?></td>
                <td><?= $p['jumlah']; ?></td>
                <td>Rp <?= number_format($p['total_harga']); ?></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

<!-- SCRIPT -->
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin hapus data?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "menu/hapus.php?id=" + id;
        }
    });
}
</script>

<?php if(isset($_SESSION['success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $_SESSION['success']; ?>',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['success']); endif; ?>

</body>
</html>