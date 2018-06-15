<?php

  session_start();
  require_once('config.php');


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Toko Herbal Now!</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
  </head>
  <body>

    <?php include 'menu.php'; ?>

    <section class="konten">
      <div class="container">

<!-- Search form -->
        <form method="get">
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="query_s" class="form-control" placeholder="Cari produk">
              <div class="input-group-btn">
                <button name="search" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </div>
        </form>


        <h2>Produk Terbaru</h2>

        <div class="row">

          <?php
            $batas = 4;
            if(!isset($_GET['paging']))
            {
              $posisi = 0;
              $halaman = 1;
            } else
            {
              $halaman = $_GET['paging'];
              $posisi = ($halaman - 1) * $batas;
            }

            $no = 1;
            $sql = $conn->query("SELECT * FROM products LIMIT $posisi, $batas");

            if(isset($_GET["search"])) {
              $query_s = $_GET["query_s"];

              $sql = $conn->query("SELECT * FROM products WHERE (`product_name` LIKE '%".$query_s."%')");

            }

            while ($data_r = $sql->fetch_assoc()) {
          ?>

          <div class="col-md-3">
            <div class="thumbnail">
              <img src="foto_produk/<?php echo $data_r['product_picture']; ?>" alt="">
              <div class="caption">
                <h3><?php echo $data_r['product_name']; ?></h3>
                <h5>Rp <?php echo number_format($data_r['product_price']); ?></h5>
                <a href="beli.php?id=<?php echo $data_r['product_id']; ?>" class="btn btn-primary">Beli</a>
                <a href="detail.php?id=<?php echo $data_r['product_id']; ?>" class="btn btn-default">Detail</a>
              </div>
            </div>
          </div>
        <?php }; ?>

        </div>

        <?php

          $sql_c = $conn->query("SELECT * FROM products");
          $num_r = $sql_c->num_rows;

          $page_c = ceil($num_r / $batas);

          for ($i=1; $i<=$page_c; $i++) {
            if ($i != $halaman) {
              echo "<a href='index.php?paging=$i'>".$i."</a> | ";
            } else {
              echo "<b> $i </b> | ";
            }
          }
         ?>

      </div>
    </section>

  </body>
</html>
