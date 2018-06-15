<h4>Tambah produk</h4>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama produk</label>
    <input type="text" class="form-control" name="nama">
  </div>
  <div class="form-group">
    <label>Harga produk (Rp)</label>
    <input type="number" name="harga" class="form-control">
  </div>
  <div class="form-group">
    <label>Berat produk (Gr)</label>
    <input type="number" name="berat" class="form-control">
  </div>
  <div class="form-group">
    <label>Deskripsi produk</label>
    <textarea name="deskripsi" rows="10" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label>Kategori</label>
    <input type="text" name="kategori" value="" class="form-control" placeholder="Herbal">
  </div>
  <div class="form-group">
    <label>Foto</label>
    <input type="file" name="foto" class="form-control">
  </div>
  <button name="save" class="btn btn-success">Simpan</button>
</form>


<?php
  if (isset($_POST['save']))
  {
      // move file gambar
      $nama = $_FILES['foto']['name'];
      $lokasi = $_FILES['foto']['tmp_name'];
      move_uploaded_file($lokasi, "../foto_produk/".$nama);

      // insert to database
      $conn->query("INSERT INTO products(product_name, product_price, product_weight, product_desc, product_category, product_picture)
      VALUES('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$_POST[deskripsi]', '$_POST[kategori]', '$nama')");

      echo "<div class='alert alert-info'> Data tersimpan </div>";
      echo "<meta http-equiv='refresh' content='1;url=index.php?pages=products'>";
  }

 ?>
