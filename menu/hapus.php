<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM menu WHERE id=$id");

$_SESSION['success'] = "Data berhasil dihapus!";
header("Location: ../dashboard.php");