<?php 
session_start(); 
if(!isset($_SESSION['login'])) header("Location: ../login.php"); 
include '../koneksi.php';

if(isset($_POST['submit'])){
    $nama=$_POST['nama'];
    $harga=$_POST['harga'];
    $kat=$_POST['kategori'];
    $desk=$_POST['deskripsi'];

    $file=time()."_".$_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'],"../uploads/".$file);

    mysqli_query($conn,"INSERT INTO menu VALUES('', '$nama','$harga','$kat','$desk','$file')");
    header("Location: ../dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Menu</title>
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

.preview-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    display: none;
}
</style>
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card p-4">
                
                <h4 class="mb-3 fw-bold text-center">Tambah Menu</h4>

                <form method="POST" enctype="multipart/form-data">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Menu</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)" required>
                    </div>

                    <!-- Preview -->
                    <img id="preview" class="preview-img mb-3"/>

                    <!-- Button -->
                    <div class="d-flex justify-content-between">
                        <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = "block";
}
</script>

</body>
</html>