<h3>Data Transaksi Pembelian</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Pelanggan</th>
      <th>Tanggal Pembelian</th>
      <th>Total Pembelian</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $nomor = 1; ?>
    <?php $sql = $conn->query("SELECT * FROM transactions JOIN users ON transactions.transaction_userId = users.user_id"); ?>
    <?php while($data = $sql->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $data['user_fullname']; ?></td>
      <td><?php echo $data['transaction_date']; ?></td>
      <td>Rp <?php echo number_format($data['transaction_total']); ?></td>
      <td>
        <a href="index.php?pages=detail&id=<?php echo $data['transaction_id']; ?>" class="btn btn-info">Detail</a>
      </td>
    </tr>
  <?php $nomor++; }; ?>
  </tbody>
</table>
