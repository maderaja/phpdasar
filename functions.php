<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $nis = htmlspecialchars($data["nis"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);


  // Upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }


  $query = "INSERT INTO siswa
            VALUES
            ('', '$nama', '$nis', '$email', '$jurusan', '$gambar')
  ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //Cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
             alert('PILIH GAMBAR TERLEBIH DAHULU!!')
          </script>";
    return false;
  }

  //Cek apakah yang di upload adalah gambar?
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
            alert('YANG ANDA UPLOAD BUKAN GAMBAR!')
          </script>";
    return false;
  }

  //Cek jika ukurannya terlalu besar
  if ($ukuranFile > 1500000) {
    echo "<script>
            alert('UKURAN GAMBAR TERLALU BESAR!')
          </script>";
    return false;
  }

  //Lolos pengecekan, gambar siap diupload
  //Generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;


  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
  return $namaFileBaru;
}


function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  global $conn;

  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $nis = htmlspecialchars($data["nis"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambarLama =  htmlspecialchars($data["gambarLama"]);


  //Cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }


  $query = "UPDATE siswa SET
            nama = '$nama',
            nis = '$nis',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'

           WHERE id = $id 
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $query = "SELECT * FROM siswa
            WHERE
            nama LIKE '%$keyword%' OR
            nis LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
  return query($query);
}

function register($data)
{
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('USERNAME SUDAH TERDAFTAR!');
      </script>
    ";
    return false;
  }

  // Cek konfirmasi password
  if ($password !== $password2) {
    echo "
      <script>
        alert('KONFIRMASI PASSWORD TIDAK SESUAI !');
      </script>
    ";
    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambah user baru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);
}
