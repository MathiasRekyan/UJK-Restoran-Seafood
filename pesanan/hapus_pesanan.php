<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pesanan WHERE id=$id");

header("Location: pesanan.php");