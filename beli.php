<?php
  session_start();
  // get id product
  $id_product = $_GET['id'];

  if(isset($_SESSION['keranjang'][$id_product]))
  {
    $_SESSION['keranjang'][$id_product] += 1;
  } else
  {
    $_SESSION['keranjang'][$id_product] = 1;
  }


  // redirect to keranjang
  echo "<script>alert('Produk telah ditambahkan ke keranjang');</script>";
  echo "<script>location='keranjang.php'</script>";

 ?>
