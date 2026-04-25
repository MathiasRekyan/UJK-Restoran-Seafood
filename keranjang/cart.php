<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Keranjang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

<div class="card p-4 shadow">

<h4>🛒 Keranjang</h4>

<?php if(empty($_SESSION['cart'])): ?>
<p>Keranjang kosong</p>
<?php else: ?>

<form action="update.php" method="POST">

<table class="table">
<tr>
<th>Menu</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
<th>Aksi</th>
</tr>

<?php 
$total = 0;
foreach($_SESSION['cart'] as $id => $item): 
$sub = $item['harga'] * $item['jumlah'];
$total += $sub;
?>

<tr>
<td><?= $item['nama']; ?></td>
<td>Rp <?= number_format($item['harga']); ?></td>

<td>
<input type="number" name="jumlah[<?= $id ?>]" value="<?= $item['jumlah']; ?>" min="1">
</td>

<td>Rp <?= number_format($sub); ?></td>

<td>
<a href="hapus.php?id=<?= $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>

<?php endforeach; ?>

</table>

<h5>Total: Rp <?= number_format($total); ?></h5>

<button class="btn btn-primary">Update</button>
<a href="checkout.php" class="btn btn-success">Checkout</a>

</form>

<?php endif; ?>

<a href="../index.php" class="btn btn-secondary mt-3">Kembali</a>

</div>
</div>

</body>
</html>