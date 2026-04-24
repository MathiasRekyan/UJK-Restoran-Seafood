<?php 
session_start(); 
if(!isset($_SESSION['login'])) header("Location: ../login.php"); 
include '../koneksi.php';

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM menu WHERE id=$id"));

if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kat = $_POST['kategori'];
    $desk = $_POST['deskripsi'];

    if($_FILES['gambar']['name'] != ""){

        $fileName = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $size = $_FILES['gambar']['size'];

        // ambil ekstensi
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // validasi ekstensi
        $allowed = ['jpg','jpeg','png','webp'];
        if(!in_array($ext, $allowed)){
            echo "<script>alert('File harus berupa gambar (jpg, jpeg, png, webp)!');window.history.back();</script>";
            exit;
        }

        // validasi ukuran (max 2MB)
        if($size > 2 * 1024 * 1024){
            echo "<script>alert('Ukuran file terlalu besar! Maks 2MB');window.history.back();</script>";
            exit;
        }

        // rename file biar unik
        $newName = time() . "_" . uniqid() . "." . $ext;

        // upload file baru
        if(move_uploaded_file($tmp, "../uploads/" . $newName)){

            // hapus gambar lama jika ada
            if($d['gambar'] != "" && file_exists("../uploads/" . $d['gambar'])){
                unlink("../uploads/" . $d['gambar']);
            }

            // update database
            mysqli_query($conn,"UPDATE menu SET 
                nama_menu='$nama',
                harga='$harga',
                kategori='$kat',
                deskripsi='$desk',
                gambar='$newName'
                WHERE id=$id");

        } else {
            echo "<script>alert('Upload gagal!');window.history.back();</script>";
            exit;
        }

    } else {

        // kalau tidak upload gambar baru
        mysqli_query($conn,"UPDATE menu SET 
            nama_menu='$nama',
            harga='$harga',
            kategori='$kat',
            deskripsi='$desk'
            WHERE id=$id");
    }

    header("Location: ../dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Menu</title>
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
}
</style>
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card p-4">
                
                <h4 class="mb-3 fw-bold text-center">Edit Menu</h4>

                <form method="POST" enctype="multipart/form-data">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama" class="form-control" value="<?= $d['nama_menu']; ?>" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= $d['harga']; ?>" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Makanan" <?= $d['kategori']=='Makanan' ? 'selected' : '' ?>>Makanan</option>
                            <option value="Minuman" <?= $d['kategori']=='Minuman' ? 'selected' : '' ?>>Minuman</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= $d['deskripsi']; ?></textarea>
                    </div>

                    <!-- Gambar Lama -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="../uploads/<?= $d['gambar']; ?>" class="preview-img mb-2">
                    </div>

                    <!-- Upload Baru -->
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <!-- Preview Baru -->
                    <img id="preview" class="preview-img mb-3" style="display:none;"/>

                    <!-- Button -->
                    <div class="d-flex justify-content-between">
                        <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
