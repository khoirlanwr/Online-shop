<?php

  session_start();
  require_once('config.php');

  /*
  echo "<pre>";
  print_r($_SESSION["user"]);
  echo "</pre>";
  */

    if(!isset($_SESSION["user"]))
    {
      echo "<script>alert('Anda harus login terlebih dulu!');</script>";
      echo "<script>location='login.php';</script>";
    }

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
     <title>Checkout</title>
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
                         </tr>
                       </thead>
                       <tbody>

                         <?php $nomor = 1; ?>
                         <?php $total_b = 0; ?>
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
                         </tr>
                         <?php $nomor++; ?>
                         <?php $total_b += $total_h; ?>
                         <?php endforeach; ?>

                       </tbody>
                       <tfoot>
                         <th colspan="4">Total belanja</th>
                         <th>Rp <?php echo number_format($total_b); ?></th>
                       </tfoot>
                     </table>

                     <form method="post">
                       <div class="row">

                         <div class="col-md-4">
                           <div class="form-group">
                             <input type="text" readonly value="<?php echo $_SESSION["user"]['user_fullname'];?>" class="form-control">
                           </div>
                         </div>

                         <div class="col-md-4">
                           <div class="form-group">
                             <input type="text" readonly value="<?php echo $_SESSION["user"]['user_phone'];?>" class="form-control">
                           </div>
                         </div>

                         <div class="col-md-4">
                           <select class="form-control" name="id_ongkir">
                             <option value="" required>Pilih ongkos kirim</option>
                             <?php $sql_t = $conn->query("SELECT * FROM ongkir"); ?>
                             <?php while($data_o = $sql_t->fetch_assoc()) { ?>
                               <option value="<?php echo $data_o['ongkir_id']; ?>">
                                 <?php echo $data_o['ongkir_kota']; ?> -
                                 Rp <?php echo number_format($data_o['ongkir_tarif']); ?>
                               </option>
                             <?php } ?>
                           </select>
                         </div>

                       </div>
                       <div class="form-group">
                         <label>Alamat lengkap</label>
                         <textarea name="alamat_pengiriman" rows="10" class="form-control" placeholder="Alamat pengiriman barang" required></textarea>
                       </div>
                       <button name="checkout" class="btn btn-primary">Checkout</button>
                       <hr>
                     </form>

                     <?php

                     if(isset($_POST["checkout"]) OR !empty($_POST['checkout']))
                     {
                       $id_pelanggan = $_SESSION["user"]["user_id"];
                       $id_ongkir =  $_POST["id_ongkir"];
                       $tanggal_pembelian = date("Y-m-d");
                       $alamat_pengiriman = $_POST["alamat_pengiriman"];

                       $data_ong = $conn->query("SELECT * FROM ongkir WHERE ongkir_id='$id_ongkir'");
                       $array_ong = $data_ong->fetch_assoc();
                       $tarif = $array_ong["ongkir_tarif"];
                       $kota = $array_ong["ongkir_kota"];

                       $total_pembelian = $total_b + $tarif;


                         // insert into table transactions
                         $query_ = $conn->query("INSERT INTO transactions (transaction_userId, transaction_ongkirId, transaction_date, transaction_total,
                         transaction_kotaOngkir, transaction_tarifOngkir, alamat_pengiriman)
                         VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$kota', '$tarif', '$alamat_pengiriman')");

                         // insert into table product_transaction
                         $id_pembelian_br = $conn->insert_id;
                         foreach ($_SESSION["keranjang"] as $id_product => $jml) {

                           $sql_pr = $conn->query("SELECT * FROM products WHERE product_id='$id_product'");
                           $data_pr = $sql_pr->fetch_assoc();

                           $nama = $data_pr['product_name'];
                           $berat = $data_pr['product_weight'];
                           $harga = $data_pr['product_price'];

                           $subberat = $data_pr['product_weight'] * $jml;
                           $subharga = $data_pr['product_price'] * $jml;

                           $conn->query("INSERT INTO product_transaction (productTransaction_productId, productTransaction_transactionId, productTransaction_count,
                           productTransaction_name, productTransaction_weight, productTransaction_price, productTransaction_subWeight, productTransaction_subPrice)
                           VALUES('$id_product', '$id_pembelian_br', '$jml', '$nama', '$berat', '$harga', '$subberat', '$subharga')");
                         }


                         // empty the keranjang
                         unset($_SESSION["keranjang"]);

                        echo "<script>alert('Checkout berhasil!');</script>";
                        echo "<script>location='nota.php?id=$id_pembelian_br';</script>";

                       }



                      ?>

                   </div>
                 </section>

                 <pre>
                <?php echo print_r($_SESSION["user"]); ?>
                <?php echo print_r($_SESSION["keranjang"]); ?>
                </pre>


   </body>
 </html>
