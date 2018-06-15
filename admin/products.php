<h3>Data Produk</h3>

<table class="table table-bordered">
  <a href="index.php?pages=add_product" class="btn btn-primary">Tambah item</a> <br> <br>
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Harga</th>
      <th>Berat</th>
      <th>Deskripsi</th>
      <th>Kategori</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <?php
        $batas = 2;
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
        while ($data = $sql->fetch_assoc()) {
      ?>
      <td><?php echo $data['product_id']; ?></td>
      <td><?php echo $data['product_name']; ?></td>
      <td>Rp <?php echo $data['product_price']; ?></td>
      <td><?php echo $data['product_weight']; ?></td>
      <td><?php echo $data['product_desc']; ?></td>
      <td><?php echo $data['product_category']; ?></td>
      <td>
          <img src="../foto_produk/<?php echo $data['product_picture']; ?>" width="100">
      </td>
      <td>
        <a href="index.php?pages=remove_product&id=<?php echo $data['product_id']; ?>" onclick="return confirm('Hapus data <?php echo $data['product_name']; ?>?');" class="btn btn-warning">Remove</a>
        <a href="index.php?pages=update_product&id=<?php echo $data['product_id']; ?>" class="btn btn-success">Edit</a>
      </td>
    </tr>
  <?php
    $no++; };
   ?>
  </tbody>
</table>

<?php

  $sql_c = $conn->query("SELECT * FROM products");
  $num_r = $sql_c->num_rows;

  $page_c = ceil($num_r / $batas);

  for ($i=1; $i<=$page_c; $i++) {
    if ($i != $halaman) {
      echo "<a href='index.php?pages=products&paging=$i'>".$i."</a> | ";
    } else {
      echo "<b> $i </b> | ";
    }
  }
 ?>
