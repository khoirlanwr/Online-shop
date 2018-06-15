<?php
  session_start();

  require_once('config.php');


  echo "<pre>";
  print_r($_SESSION['keranjang']);
  echo "</pre>";


  if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
  {
      echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
      echo "<script>location='index.php'</script>";
  }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Keranjang</title>
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
   </head>
   <body>

    <?php include 'menu.php'; ?>

    <section class="konten">
      <div class="container">
        <h3>Keranjang Belanja</h3>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>No</td>
              <td>Produk</td>
              <td>Harga</td>
              <td>Jumlah</td>
              <td>Subharga</td>
              <td>Aksi</td>
            </tr>
          </thead>
          <tbody>

            <?php $nomor = 1; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_product => $jml): ?>
            <?php
              $sql_c = $conn->query("SELECT * FROM products WHERE product_id='$id_product'");
              $data_r = $sql_c->fetch_assoc();


              $total_h = $data_r['product_price'] * $jml;
             ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $data_r['product_name']; ?></td>
              <td>Rp <?php echo number_format($data_r['product_price']); ?></td>
              <td><?php echo $jml; ?></td>
              <td>Rp <?php echo number_format($total_h); ?></td>
              <td>
                <a href="hapuskeranjang.php?id=<?php echo $data_r['product_id']; ?>" class="btn btn-danger btn-xs">Hapus</a>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach; ?>

          </tbody>
        </table>

        <a href="index.php" class="btn btn-default">Lanjutkan belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>
    </section>

   </body>
 </html>
