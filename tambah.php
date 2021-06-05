<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// Cek apakah tombol submit sudah pernah di tekan atau belum
if (isset($_POST["submit"])) {
  // cek apakah data berhasil di tambah atau tidak
  if (tambah($_POST) > 0) {
    echo "
        <script>
        alert('DATA BERHASIL DITAMBAH !');
        document.location.href = 'index.php';
        </script>
      ";
  } else {
    echo "
        <script>
        alert('DATA GAGAL DITAMBAH !!');
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
  <title>Tambah Data Siswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    .container .card .text-white {
      font-weight: bold;
    }
  </style>

  </style>
</head>

<body>
  <h1 class="text-center">Tambah Data Siswa</h1>

  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-primary text-white text-center">
        Form Input Data Siswa
      </div>
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">
              Nama :
            </label>
            <input type="text" name="nama" id="nama" required autocomplete="off" class="form-control" placeholder="Input Nama Siswa">

          </div>

          <div class="form-group">
            <label for="nis">
              NIS :
            </label>
            <input type="text" name="nis" id="nis" required autocomplete="off" class="form-control" placeholder="Input NIS Siswa">

          </div>

          <div class="form-group">
            <label for="email">
              Email :
            </label>
            <input type="email" name="email" id="email" required autocomplete="off" class="form-control" placeholder="Input e-mail Siswa">

          </div>

          <div class="form-group">
            <label for="jurusan">
              Jurusan
            </label> :
            <input type="text" name="jurusan" id="jurusan" required class="form-control" placeholder="Input Jurusan Siswa">

          </div>

          <div class="form-group">
            <label for="gambar">
              Gambar :
              <input type="file" name="gambar" id="gambar" autocomplete="off" class="form-control">
            </label>
          </div>

          <button type="submit" name="submit" class="btn btn-success">Tambah Data!</button>

        </form>
      </div>
    </div>
  </div>
</body>

</html>