<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// Pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$siswa = query("SELECT * FROM siswa LIMIT $awalData, $jumlahDataPerHalaman");

//Tombol cari diklik
if (isset($_POST["cari"])) {
  $siswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    html {
      min-height: 1000px;
    }


    .container .card .text-white {
      font-weight: bold;
    }

    .search {
      display: inline;
    }

    .search_tambah {
      display: flex;
      justify-content: space-between;
    }

    .logout {
      margin: auto;
      width: 100%;

    }
  </style>
</head>

<body>

  <div class="container">
    <h1 class="text-center">Sekolah Teknik Segala Teknik</h1>
    <br>

    <!-- SEARCH BAR -->
    <div class="search_tambah">
      <form action="" method="POST" class="search">
        <label>
          Search :
          <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
          <button type="submit" name="cari" class=" btn-primary">Cari!</button>
        </label>
      </form>
      <a href="tambah.php" class="btn btn-primary">Tambah Data Siswa</a>
    </div>
    <br>

    <!-- NAVIGASI PAGINATION -->
    <?php if ($halamanAktif > 1) : ?>
      <a href="?halaman=<?= $halamanAktif - 1; ?>"> &laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
      <?php if ($i == $halamanAktif) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: black;" class="btn btn-warning"><?= $i; ?></a>
      <?php else : ?>
        <a href="?halaman=<?= $i; ?>" class="btn btn-primary"><?= $i; ?></a>
      <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jumlahHalaman) : ?>
      <a href="?halaman=<?= $halamanAktif + 1; ?>"> &raquo;</a>
    <?php endif; ?>

    <!-- TABEL DATA -->
    <div class="card mt-3">
      <div class="card-header bg-success text-white text-center">
        Daftar Siswa
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">

          <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Email</th>
            <th>Jurusan</th>
          </tr>

          <?php $i = 1; ?>
          <?php foreach ($siswa as $row) : ?>
            <tr>
              <td><?= $i ?></td>
              <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-warning">ubah</a>
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('anda yakin akan menghapus data ini?');" class="btn btn-danger">hapus</a>
              </td>
              <td><img src="img/<?= $row["gambar"] ?>" width="70"></td>
              <td><?= $row["nama"]; ?></td>
              <td><?= $row["nis"]; ?></td>
              <td><?= $row["email"]; ?></td>
              <td><?= $row["jurusan"]; ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </table>
      </div>

      <!-- BUTTON LOGOUT -->
      <div class="logout">
        <a href="logout.php" class="btn btn-danger " style="width: 100%;">Logout</a>
      </div>
    </div>

</body>

</html>