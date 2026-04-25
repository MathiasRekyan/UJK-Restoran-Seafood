<?php
session_start();
include __DIR__ . '/../koneksi.php';

if(empty($_SESSION['cart'])){
    die("Keranjang kosong!");
}

$nama = "Customer"; // bisa kamu ubah jadi input nanti

foreach($_SESSION['cart'] as $id => $item){

    $total = $item['harga'] * $item['jumlah'];

    mysqli_query($conn, "
    INSERT INTO pesanan (nama_pelanggan, menu_id, jumlah, total_harga)
    VALUES ('$nama', '$id', '{$item['jumlah']}', '$total')
    ");
}

// kosongkan keranjang
unset($_SESSION['cart']);

header("Location: ../index.php?checkout=success");