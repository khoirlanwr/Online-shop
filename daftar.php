<?php

  session_start();
  require_once('config.php');

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Daftar</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
  </head>
  <body>

    <?php include 'menu.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Daftar pelanggan</h3>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" method="post">

                <div class="form-group">
                  <label class="control-label col-md-3">Nama</label>
                  <div class="col-md-7">
                    <input type="text" name="nama" class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-7">
                    <input type="email" name="email" class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Password</label>
                  <div class="col-md-7">
                    <input type="password" name="password" class="form-control" required>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3">Alamat</label>
                  <div class="col-md-7">
                    <textarea name="alamat" class="form-control" required></textarea>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3">Telepon</label>
                  <div class="col-md-7">
                    <input type="text" name="telepon" class="form-control" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-md-7 col-md-offset-3">
                    <button name="daftar" class="btn btn-primary">Daftar</button>
                  </div>
                </div>

              </form>

              <?php

              if(isset($_POST["daftar"]))
              {
                // set variable
                $n_ = $_POST["nama"];
                $e_ = $_POST["email"];
                $passwd = $_POST["password"];
                $telp_ = $_POST["telepon"];
                $al_ = $_POST["alamat"];

                // validasi email
                $sql_ve = $conn->query("SELECT * FROM users WHERE user_email='$e_'");
                $re = $sql_ve->num_rows;
                

                if($re == 1) {
                  // failed
                  echo "<script>alert('Daftar gagal, email sudah digunakan!');</script>";
                  echo "<script>location='daftar.php'</script>";
                } else {
                  // continue
                  $conn->query("INSERT INTO users(user_email, user_fullname, user_passwd, user_phone, user_address)
                  VALUES('$e_', '$n_', '$passwd', '$telp_', '$al_')");

                  echo "<script>alert('Daftar berhasil, silahkan login');</script>";
                  echo "<script>location='login.php'</script>";
                }

              }


               ?>

            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
