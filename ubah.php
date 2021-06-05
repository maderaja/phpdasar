<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

//query data siswa berdasarkan id nya
$swa = query("SELECT * FROM siswa WHERE id = $id")[0];

// Cek apakah tombol submit sudah pernah di tekan atau belum
if (isset($_POST["submit"])) {
  // cek apakah data berhasil di ubah atau tidak
  if (ubah($_POST) > 0) {
    echo "
        <script>
        alert('DATA BERHASIL DIUBAH !');
        document.location.href = 'index.php';
        </script>
      ";
  } else {
    echo "
        <script>
        alert('DATA GAGAL DIUBAH !!');
        document.location.href = 'index.php';
        </script>
      ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Siswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    .container .card .text-black {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <h1 class="text-center">Ubah Data Siswa</h1>

  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-warning text-black text-center">
        Form Ubah Data Siswa
      </div>
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $swa["id"]; ?>">
          <input type="hidden" name="gambarLama" value="<?= $swa["gambar"]; ?>">

          <div class="form-group">
            <label for="nama">
              Nama :
            </label>
            <input type="text" name="nama" id="nama" required value="<?= $swa["nama"]; ?>" autocomplete="off" class="form-control">

          </div>

          <div class="form-group">
            <label for="nis">
              NIS :
            </label>
            <input type="text" name="nis" id="nis" required value="<?= $swa["nis"]; ?>" autocomplete="off" class="form-control">
          </div>

          <div class="form-group">
            <label for="email">
              Email :
            </label>
            <input type="email" name="email" id="email" required value="<?= $swa["email"]; ?>" autocomplete="off" class="form-control">
          </div>

          <div class="form-group">
            <label for="jurusan">
              Jurusan :
            </label>
            <input type="text" name="jurusan" id="jurusan" required value="<?= $swa["jurusan"]; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label for="gambar">
              Gambar : <br>
              <img src="img/<?= $swa['gambar']; ?>" width="70"> <br>
              <input type="file" name="gambar" id="gambar" class="form-control">
            </label>
          </div>

          <button type="submit" name="submit" class="btn btn-success">Ubah Data!</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>