<?php
session_start();

foreach($_POST['jumlah'] as $id => $jumlah){
    $_SESSION['cart'][$id]['jumlah'] = intval($jumlah);
}

header("Location: cart.php");