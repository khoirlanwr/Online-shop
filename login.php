<?php
  session_start();
  require_once('config.php');



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login user</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
  </head>
  <body>


    <?php include 'menu.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-md-4">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Login user</h3>
            </div>
            <div class="panel-body">
              <form method="post">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <button class="btn btn-primary" name="login">Login</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

  </body>
</html>

<?php
  if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $passwd = $_POST['password'];

    $sql_q = $conn->query("SELECT * FROM users WHERE user_email='$email' AND user_passwd='$passwd'");
    $c_ = $sql_q->num_rows;

    if($c_ == 1) {
      // login dilanjutkan
      $acc = $sql_q->fetch_assoc();
      $_SESSION["user"] = $acc;
      echo "<script>alert('Login berhasil');</script>";
      echo "<script>location='checkout.php';</script>";
    }else {
      // login gagal
      echo "<script>alert('Login gagal!');</script>";
      echo "<script>location='login.php';</script>";
    }


  }
 ?>
