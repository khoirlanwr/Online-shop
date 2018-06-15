<h3>Data User</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Email</th>
      <th>Telepon</th>
      <th>Alamat</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $nomor = 1; ?>
    <?php $sql = $conn->query("SELECT * FROM users LIMIT 10"); ?>
    <?php while($data = $sql->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $data['user_fullname']; ?></td>
      <td><?php echo $data['user_email']; ?></td>
      <td><?php echo $data['user_phone']; ?></td>
      <td><?php echo $data['user_address']; ?></td>
      <td>
        <a href="del_user.php?id=<?php echo $data['user_id']; ?>" onclick="return confirm('Hapus data <?php echo $data['user_fullname']; ?>?');" class="btn btn-warning">Remove</a>
      </td>

    </tr>
  <?php $nomor++; }; ?>
  </tbody>
</table>

<script>
  function ConfirmDelete()
  {
    var x = confirm("Hapus data?");
    if (x)
      return true;
    else
      return false;
  }
</script>
