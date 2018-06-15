<?php
  session_start();
  require_once('config.php');

  $id = $_GET['id'];
  $sql_p = $conn->query("SELECT * FROM products WHERE product_id='$id'");
  $data_p = $sql_p->fetch_assoc();

  /*
  echo "<pre>";
  print_r($data_p);
  echo "</pre>";
  */
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detail produk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
  </head>
  <body>

    <?php include 'menu.php'; ?>


  <section class="konten">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="foto_produk/<?php echo $data_p['product_picture']; ?>" alt="" class="img-responsive">
        </div>
        <div class="col-md-6">
          <h3><?php echo $data_p['product_name']; ?></h3>
          <h4>Rp <?php echo number_format($data_p['product_price']); ?></h4>

        <form method="post">
          <div class="form-group">
            <div class="input-group">
              <input type="number" name="jumlah" min="1" class="form-control">
              <div class="input-group-btn">
                <button name="beli" class="btn btn-primary">Beli</button>
              </div>
            </div>
          </div>
        </form>

        <?php

        if(isset($_POST['beli']))
        {
            $jml_beli = $_POST['jumlah'];

            // insert to keranjang
            if(isset($_SESSION["keranjang"][$id])) {
              $_SESSION["keranjang"][$id] += $jml_beli;
            } else {
              $_SESSION["keranjang"][$id] = $jml_beli;
            }

            echo "<script>alert('Produk telah ditambahkan ke keranjang'); </script>";
            echo "<script>location='keranjang.php';</script>";
        }

         ?>

          <p><?php echo $data_p['product_desc'] ?></p>
        </div>
      </div>


    </div>
  </section>

  </body>
</html>
