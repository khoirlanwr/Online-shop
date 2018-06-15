<h3>Detail Pembelian</h3>
<?php

  $sql = $conn->query("SELECT * FROM transactions JOIN users ON transactions.transaction_userId=users.user_id
  WHERE transactions.transaction_id='$_GET[id]'");
  $data = $sql->fetch_assoc();

 ?>
<pre><?php print_r($data); ?></pre>

<strong><?php echo $data['user_fullname']; ?></strong> <br>
<p>
  Telepon : <?php echo $data['user_phone']; ?> <br>
  Email   : <?php echo $data['user_email']; ?> <br>
</p>

<p>
  Tanggal : <?php echo $data['transaction_date']; ?> <br>
  Total   : Rp <?php echo $data['transaction_total']; ?> <br>
</p>

<table class="table table bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama produk</th>
      <th>Harga produk</th>
      <th>Jumlah</th>
      <th>Sub total</th>
    </tr>
  </thead>

  <tbody>
    <?php $nomor = 1; ?>
    <?php $sql = $conn->query("SELECT * FROM product_transaction JOIN products
      ON product_transaction.productTransaction_productId = products.product_id
      WHERE product_transaction.productTransaction_transactionId='$_GET[id]'"); ?>
    <?php while($data = $sql->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $data['product_name']; ?></td>
      <td>Rp <?php echo number_format($data['product_price']); ?></td>
      <td><?php echo $data['productTransaction_count']; ?></td>
      <td>Rp <?php echo number_format($data['product_price'] * $data['productTransaction_count']); ?></td>
    </tr>
    <?php $nomor++; }; ?>
  </tbody>
</table>
