<?php
session_start();
include __DIR__ . '/../koneksi.php';

$id = intval($_GET['id']);

$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM menu WHERE id=$id"));

if(!$data){
    die("Menu tidak ditemukan!");
}

// kalau belum ada cart
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// kalau item sudah ada → tambah jumlah
if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['jumlah'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        'nama' => $data['nama_menu'],
        'harga' => $data['harga'],
        'jumlah' => 1
    ];
}

header("Location: cart.php");