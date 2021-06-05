<?php
session_start();
require 'functions.php';

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // Ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // Cek username dan cookie
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}


if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // Cek username
  if (mysqli_num_rows($result) == 1) {

    // Cek password
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row["password"])) {
      // Set session
      $_SESSION["login"] = true;

      // Cek remember me
      if (isset($_POST["remember"])) {
        // buat cookie
        setcookie('id', $row['id'], time() + 120);
        setcookie('key', hash('sha256', $row['username']), time() + 120);
      }

      header("Location: index.php");
      exit;
    }
  }

  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Halaman Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/form.css" />
  <link rel="stylesheet" href="css/body.css" />
  <link rel="stylesheet" href="css/checkbox.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <link rel="stylesheet" href="icon/css/all.min.css" />
</head>

<body>


  <?php if (isset($error)) : ?>
    <script>
      alert('USERNAME ATAU PASSWORD SALAH !');
    </script>
  <?php endif; ?>

  <div class="container-fluid">
    <!-- Form Login -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-10 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">


              <!-- form control -->
              <div class="col-sm bg-cover2 position-relative rounded" style="overflow: hidden;">
                <img src="assets/bg-cover2.png" width="100%" class="position-absolute cover2" />

                <div class="position-relative">
                  <form form action="" method="POST">
                    <div class="row justify-content-center mt-5">
                      <div class="text-center mt-5">
                        <h1 class="h2 judul text-bold">USER LOGIN</h1>
                      </div>

                      <div class="col-lg-10 col-md-8 mt-5">
                        <div class="input-container">
                          <i class="far fa-user icon"></i>
                          <input class="input-field" type="text" placeholder="Username" name="username" id="username" required />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-lock icon"></i>
                          <input class="input-field" type="password" placeholder="Password" name="password" id="password" required />
                        </div>
                      </div>

                      <div class="col-lg-9 col-md-7">
                        <div class="d-flex justify-content-between">
                          <div class="form-group my-4">
                            <label class="container font-check">Remember me
                              <input type="checkbox" name="remember" />
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <button type="submit" class="btn btn-purple rounded-pill shadow mb-4" name="login"><i class="fas fa-lock"></i> LOGIN</button>
                      </div>

                      <div class="col-lg-12 mb-5">
                        <div class="d-flex justify-content-center"><span class="me-2 text-white">Not have account?</span><a href="registrasi.php" class="link">Register</a></div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>