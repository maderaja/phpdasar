<?php

require 'functions.php';

if (isset($_POST["register"])) {
  if (register($_POST) > 0) {
    echo "
        <script>
        alert('USER BARU BERHASIL DITAMBAH !');
        </script>
      ";
  } else {
    echo mysqli_error($conn);
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Halaman Registrasi</title>
  <link rel="icon" href="assets/rt2.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/body.css">
  <link rel="stylesheet" href="css/checkbox.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="icon/css/all.min.css">
</head>

<body>


  <div class="container-fluid">

    <!-- Form Register -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-10 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">


              <!-- form control -->
              <div class="col-sm bg-cover2 position-relative rounded " style="overflow: hidden;">
                <img src="assets/bg-cover2.png" width="100%" class="position-absolute cover2">

                <div class="position-relative">

                  <form action="" method="POST">
                    <div class="row justify-content-center mt-5">

                      <div class="text-center mt-5">
                        <h1 class="h2 judul text-bold">CREATE ACCOUNT</h1>
                      </div>

                      <div class="col-lg-10 col-md-8 mt-5">
                        <div class="input-container">
                          <i class="far fa-user icon"></i>
                          <input class="input-field" type="text" placeholder="Username" name="username" id="username" required>
                        </div>
                      </div>

                      <!-- <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="far fa-envelope icon"></i>
                          <input class="input-field" type="email" placeholder="Email" name="email" required>
                        </div>
                      </div> -->

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-lock icon"></i>
                          <input class="input-field" type="password" placeholder="Password " name="password" id="password" required>
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-lock icon"></i>
                          <input class="input-field" type="password" placeholder="Confirm password" name="password2" id="password2" required>
                        </div>
                      </div>


                      <div class="col-lg-10 col-md-8">
                        <button type="submit" class="btn btn-purple rounded-pill shadow mb-4" name="register"><i class="fas fa-paper-plane"></i> REGISTER</button>
                      </div>

                      <div class="col-lg-12 mb-5">
                        <div class="d-flex justify-content-center">
                          <span class="me-2 text-white">Have account?</span><a href="login.php" class="link">Login</a>
                        </div>
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