<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:linear-gradient(135deg,#667eea,#764ba2);}
.card{max-width:400px;margin:auto;margin-top:10%;padding:30px;border-radius:15px;}
</style>
</head>
<body>
<div class="card">
<h3 class="text-center">Login</h3>
<?php if(isset($_SESSION['error'])){ ?>
<div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
<?php unset($_SESSION['error']); } ?>
<form action="proses_login.php" method="POST">
<input name="username" class="form-control mb-2" placeholder="Username">
<input type="password" name="password" class="form-control mb-2" placeholder="Password">
<button class="btn btn-primary w-100">Login</button>
</form>
</div>
</body>
</html>