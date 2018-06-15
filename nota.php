<?php
  session_start();
  require_once 'config.php';



 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Nota</title>
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
   </head>
   <body>

     <?php include 'menu.php'; ?>

     <section class="konten">
      <div class="container">


        <h3>Detail Pembelian</h3>
        <?php

          $sql = $conn->query("SELECT * FROM transactions JOIN users ON transactions.transaction_userId=users.user_id
          WHERE transactions.transaction_id='$_GET[id]'");
          $data_i = $sql->fetch_assoc();

         ?>
        <!--- <pre> <?php //print_r($data_i); ?></pre> -->


        <div class="row">
          <div class="col-md-4">
            <h3>Pembelian</h3>
            <strong>No. Pembelian: <?php echo $data_i['transaction_id']; ?></strong><br>
            Tanggal: <?php echo $data_i['transaction_date']; ?> <br>
            Total: Rp <?php echo number_format($data_i['transaction_total']); ?>
          </div>
          <div class="col-md-4">
            <h3>Pelanggan</h3>
            <strong><?php echo $data_i['user_fullname']; ?></strong> <br>
            <p>
              Telepon : <?php echo $data_i['user_phone']; ?> <br>
              Email   : <?php echo $data_i['user_email']; ?> <br>
            </p>

          </div>
          <div class="col-md-4">
            <h3>Pengiriman</h3>
            <strong><?php echo $data_i['transaction_kotaOngkir']; ?></strong> <br>
            Ongkos kirim: Rp <?php echo number_format($data_i['transaction_tarifOngkir']); ?> <br>
            Alamat: <?php echo $data_i['alamat_pengiriman']; ?>

          </div>
        </div>

        <hr>
        <table class="table table bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama produk</th>
              <th>Harga produk</th>
              <th>Berat produk</th>
              <th>Jumlah</th>
              <th>Sub Berat</th>
              <th>Sub total</th>
            </tr>
          </thead>

          <tbody>
            <?php $nomor = 1; ?>
            <?php $sql = $conn->query("SELECT * FROM product_transaction WHERE productTransaction_transactionId='$_GET[id]'"); ?>
            <?php while($data = $sql->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $data['productTransaction_name']; ?></td>
              <td>Rp <?php echo number_format($data['productTransaction_price']); ?></td>
              <td><?php echo $data['productTransaction_weight']; ?> Gr</td>
              <td><?php echo $data['productTransaction_count']; ?></td>
              <td><?php echo $data['productTransaction_subWeight']; ?> Gr</td>
              <td>Rp <?php echo number_format($data['productTransaction_subPrice']); ?></td>
            </tr>
            <?php $nomor++; }; ?>
          </tbody>
        </table>

        <div class="row">
          <div class="col-md-7">
            <div class="alert alert-info">
              <p>
                Silahkan melakukan pembayaran sebesar Rp <?php echo number_format($data_i['transaction_total']); ?> ke
                <br>
                <strong>Bank Mandiri 137-221017-1000 a.n Toko Herbal NOW</strong>.
              </p>
            </div>
          </div>
        </div>

      </div>
     </section>

   </body>
 </html>
