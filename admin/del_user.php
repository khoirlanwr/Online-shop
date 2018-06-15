<?php

  require_once('../config.php');

  $conn->query("DELETE FROM users WHERE user_id='$_GET[id]'");

  echo "<script>alert('user terhapus');</script>";
  echo "<script>location='index.php?pages=users';</script>";


 ?>
