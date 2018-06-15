<?php

  session_start();
  $id_product = $_GET['id'];
  // unset session  kernajang id dari url
  unset($_SESSION["keranjang"][$id_product]);

  echo "<script>alert('produk dihapus dari keranjang');</script>";
  echo "<script>location='keranjang.php';</script>";

 ?>
