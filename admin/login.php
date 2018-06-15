<?php

  session_start();
  require_once('../config.php');


 ?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Login</div>
            <form method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password"/>
                    </div>
                </div>
                <div class="footer">
                    <button name="login" class="btn bg-olive btn-block">Login</button>
                </div>
            </form>
            <?php

              if(isset($_POST['login']))
              {
                $sql = $conn->query("SELECT * FROM admin WHERE username='$_POST[username]' AND password='$_POST[password]'");
                $data_r = $sql->num_rows;

                if($data_r == 1) {
                  $_SESSION['admin'] = $sql->fetch_assoc();
                  echo "<script>alert('Login berhasil!');</script>";
                  echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                } else {
                  echo "<script>alert('Login gagal!');</script>";
                  echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
              }

             ?>

        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
