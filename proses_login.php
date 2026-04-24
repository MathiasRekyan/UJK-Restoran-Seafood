<?php
session_start(); include 'koneksi.php';
$u=$_POST['username']; $p=$_POST['password'];
$q=mysqli_query($conn,"SELECT * FROM users WHERE username='$u'");
$d=mysqli_fetch_assoc($q);
if($d && password_verify($p,$d['password'])){
$_SESSION['login']=true; header("Location: dashboard.php");
}else{
$_SESSION['error']="Login gagal!"; header("Location: login.php");
}
?>