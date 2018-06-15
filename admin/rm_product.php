<?php

  
  $ambil = $conn->query("SELECT * FROM products WHERE product_id='$_GET[id]'");
  $pecah = $ambil->fetch_assoc();
  $foto_produk = $pecah['product_picture'];

  if (file_exists("../foto_produk/$foto_produk")) {
    unlink("../foto_produk/$foto_produk");
  }

  $conn->query("DELETE FROM products WHERE product_id='$_GET[id]'");

  echo "<script>alert('produk terhapus');</script>";
  echo "<script>location='index.php?pages=products';</script>";


 ?>
