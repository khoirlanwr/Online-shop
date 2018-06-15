<?php

  $sql_d = $conn->query("SELECT * FROM products WHERE product_id='$_GET[id]'");
  $data_ = $sql_d->fetch_assoc();

 ?>

 <h4>Update data produk</h4>
 <br>
 <form method="post" enctype="multipart/form-data">

   <div class="form-group">
     <label>Name</label>
     <input type="text" name="name" value="<?php echo $data_['product_name']; ?>" class="form-control">
   </div>

   <div class="form-group">
    <label>Harga (Rp)</label>
    <input type="number" name="harga" value="<?php echo $data_['product_price']; ?>" class="form-control">
   </div>

   <div class="form-group">
     <label>Berat (Gr)</label>
     <input type="number" name="berat" value="<?php echo $data_['product_weight']; ?>" class="form-control">
   </div>

   <div class="form-group">
     <label>Deskripsi</label>
     <textarea name="deskripsi" class="form-control" rows="10">
       <?php echo $data_['product_desc']; ?>
      </textarea>
   </div>

   <div class="form-group">
     <label>Kategori</label>
     <input type="text" name="kategori" value="<?php echo $data_['product_category']; ?>" class="form-control">
   </div>

   <div class="form-group">
     <img src="../foto_produk/<?php echo $data_['product_picture']; ?>" width="200">
   </div>

   <div class="form-group">
     <label>Foto</label>
     <input type="file" name="foto" class="form-control">
   </div>

   <button name="update" class="btn btn-success">Update</button>
 </form>


<?php
  if(isset($_POST['update']))
  {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    // jika foto diubah
    if(!empty($lokasifoto)) {

      move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

      $conn->query("UPDATE products SET product_name='$_POST[name]', product_price='$_POST[harga]', product_weight='$_POST[berat]',
      product_desc='$_POST[deskripsi]', product_category='$_POST[kategori]', product_picture='$namafoto' WHERE product_id='$_GET[id]'");

    } else {
      $conn->query("UPDATE products SET product_name='$_POST[name]', product_price='$_POST[harga]', product_weight='$_POST[berat]',
      product_desc='$_POST[deskripsi]', product_category='$_POST[kategori]' WHERE product_id='$_GET[id]'");

    }

    echo "<script>alert('Data produk diupdate!');</script>";
    echo "<script>location='index.php?pages=products';</script>";
  }


 ?>
