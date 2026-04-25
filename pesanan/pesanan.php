<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: ../login.php");
include __DIR__ . '/../koneksi.php';

$q = mysqli_query($conn,"
SELECT pesanan.*, menu.nama_menu 
FROM pesanan 
JOIN menu ON pesanan.menu_id = menu.id
ORDER BY pesanan.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pesanan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body {
    background-color: #f5f7fb;
}

.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.table th {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.8rem;
}
</style>
</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<h4 class="mb-4">📦 Data Pesanan</h4>

<table class="table align-middle">
<thead>
<tr>
<th>Nama</th>
<th>Menu</th>
<th>Jumlah</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php while($r=mysqli_fetch_assoc($q)){ ?>
<tr>
<td><?= $r['nama_pelanggan']; ?></td>
<td><?= $r['nama_menu']; ?></td>
<td><?= $r['jumlah']; ?></td>
<td>Rp <?= number_format($r['total_harga']); ?></td>

<!-- STATUS -->
<td>
<span class="badge <?= $r['status']=='Selesai' ? 'bg-success' : 'bg-warning text-dark'; ?>">
<?= $r['status']; ?>
</span>
</td>

<!-- AKSI -->
<td>

<!-- Ubah Status -->
<a href="update_status.php?id=<?= $r['id']; ?>" 
class="btn btn-sm btn-success">
Selesai
</a>

<!-- Hapus -->
<button onclick="hapus(<?= $r['id']; ?>)" 
class="btn btn-sm btn-danger">
Hapus
</button>

</td>

</tr>
<?php } ?>
</tbody>

</table>

<a href="../dashboard.php" class="btn btn-secondary mt-3">Kembali</a>

</div>
</div>

<script>
function hapus(id){
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "hapus_pesanan.php?id=" + id;
        }
    });
}
</script>

</body>
</html>