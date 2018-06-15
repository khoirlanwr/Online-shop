<?php

  /* Hitung kolom produk */
  $sql_products = $conn->query("SELECT * FROM products");
  $rows_produtcs = $sql_products->num_rows;

  /* Hitung kolom user */
  $sql_users = $conn->query("SELECT * FROM users");
  $rows_users = $sql_users->num_rows;

  /* Hitung kolom transactions */
  $sql_trn = $conn->query("SELECT * FROM transactions");
  $rows_trn = $sql_trn->num_rows;



 ?>

 <pre>
   <?php print_r($_SESSION); ?>
 </pre>

                    <!-- Small boxes (Stat box) -->
                    <section class="content">

                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $rows_produtcs; ?>
                                        </h3>
                                        <p>
                                            Data Produk
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="index.php?pages=products" class="small-box-footer">
                                        Info selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>
                                          <?php echo $rows_trn; ?>
                                        </h3>
                                        <p>
                                            Data Pembelian
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="index.php?pages=transactions" class="small-box-footer">
                                        Info selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $rows_users ?>
                                        </h3>
                                        <p>
                                            User terdaftar
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="index.php?pages=users" class="small-box-footer">
                                        Info selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>
                                            Admin
                                        </h3>
                                        <p>
                                            1 logged Admin
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="index.php?pages=logout" class="small-box-footer">
                                        logout <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                        </div><!-- /.row -->
                    </section><!-- /.content -->
