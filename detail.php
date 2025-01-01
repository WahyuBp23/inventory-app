<?php
  require 'function.php';
  require 'cek.php';

    // dapetin id barangnya yang di pasing sebelumnya 
    $idbarang = $_GET['id']; // get id barang
    // get informasi barang berdasarkan data bases
    $get = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang='$idbarang'");
    $fetch = mysqli_fetch_assoc($get);
    // set variabel
    $idbarang = $fetch['idbarang'];
    $namabarang = $fetch['namabarang'];
    $kategori = $fetch['kategori'];
    $merk = $fetch['merk'];
    $stock = $fetch['stock'];
    $satuan = $fetch['satuan'];


    // cek ada gambar atau tidak
    $gambar = $fetch['image']; //ambil gambar
        if($gambar==null){
        // jika tidak ada gambar
            $img = 'No Photo';
        } else {
        // jika ada gambar
            $img = '<img src="images/'.$gambar.'" class = "zoomable">';
        }

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include('header.php');?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="padding-left:15px;"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
        <?php
         if($_SESSION['level_user'] == "pemilik"){

         ?>
         <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li>
        <div class="user-panel d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Pemilik</a>
        </div>
         <?php
         }
         ?>
          <?php
         if($_SESSION['level_user'] == "admin"){

         ?>
         <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li>
        <div class="user-panel d-flex">
        <div class="image">
          <img src="dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
         <?php
         }

         ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/logok.png" alt="Elec.Co. Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="padding-right:20px">GUDANG BEAUTYQU</span>
    </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-header" style="color:white;">MENU</li>
         <?php
         $ambildatausr = mysqli_query($conn, "SELECT * FROM tb_user where id_user = id_user");
         $data = mysqli_fetch_assoc($ambildatausr);
         $level =  $data['level_user'];
         if($_SESSION['level_user'] == "pemilik" ||  $_SESSION['level_user'] == "admin") :?>
         <li class="nav-item">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['level_user'] == "admin") :?>
          <li class="nav-item">
            <a href="barang.php" class="nav-link">
              <i class="nav-icon fa-solid fa-box"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          <?php endif; ?>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-box"></i>
              <p>
                Master Barang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="jenis.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="satuan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="merk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="barang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
            </ul>
          </li> -->
          <?php if( $_SESSION['level_user'] == "admin") :?>
          <li class="nav-item">
            <a href="supplier.php" class="nav-link">
              <i class="nav-icon fa-solid fa-people-carry-box"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['level_user'] == "admin") :?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-repeat"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="masuk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="keluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['level_user'] == "pemilik") :?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-print"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lap_db.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap Stock Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="lap_bm.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="lap_bk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          </li>
          <?php endif; ?>
          <li class="nav-header">Other</li>
          <?php 
          if($_SESSION['level_user'] == "pemilik") :
          ?>
         <li class="nav-item">
            <a href="user.php" class="nav-link">
             <i class="nav-icon fa-solid fa-user-gear"></i>
                  <p>Managemen User</p>
              </p>
            </a>
          </li>
          <?php endif; 
          ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Menu</a></li>
              <li class="breadcrumb-item active">Detail Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card mb-4">
            <div class="card-header">
                <h2><?=$namabarang;?></h2>
            <div class="card-body">
                <div class="row">
            <div class="col"><?=$img;?></div>
        </div>
            <div class="row">
                <div class="col-3">Kode Barang</div>
                <div class="col">: <?=$idbarang?></div>
            </div>
            <div class="row">
                <div class="col-3">Kategori</div>
                <div class="col">: <?=$kategori?></div>
            </div>
                <div class="row">
                    <div class="col-3">Merk Barang</div>
                    <div class="col">: <?=$merk?></div>
            </div>
                <div class="row">
                    <div class="col-3">Stock Barang</div>
                    <div class="col">: <?=$stock?> <?=$satuan?></div>
            </div>
            <br>
             <div class="table-responsive">
                <h3>Barang Masuk</h3>
               <table
                    id="example1"
                    class="table table-bordered table-hover"
                >
                    <thead>
                        <tr style="background-color:#566573; color:white;">
                            <th>Tanggal Masuk</th>
                            <th>Kode Barang Masuk</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                            $ambilsemuadatabarang = mysqli_query($conn, "SELECT * FROM tb_barangmasuk WHERE idbarang ='$idbarang'"); 
                        $i = 1;

                        while ($data=mysqli_fetch_array($ambilsemuadatabarang)) {
                        // while ($datas=mysqli_fetch_array($ambilsemuadatasupplier)) {
                        // while ($datass=mysqli_fetch_array($ambilsemuadatamasuk)) {
                            $idb = $data['idbarang'];
                            $idm = $data['idmasuk'];
                            $tanggal = $data['tanggalmasuk'];
                            $qty = $data['qty'];

                    ?>

                        <tr>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$tanggal;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$idm;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$qty;?></td>
                        </tr>
                    <?php
                        };
                    ?>
                </tbody>
                    </table>
            <div class="table-responsive">
                <h3>Barang Keluar</h3>
               <table
                    id="example1"
                    class="table table-bordered table-hover"
                >
                    <thead>
                        <tr style="background-color:#566573; color:white;">
                            <th>Tanggal Keluar</th>
                            <th>Alamat Tujuan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                        $ambilsemuadatamasuk = mysqli_query($conn, "SELECT * FROM tb_barangkeluar WHERE idbarang ='$idbarang'");
                        while ($fetch=mysqli_fetch_array($ambilsemuadatamasuk)) {
                                $tanggal = $fetch['tanggalkeluar'];
                                $qty = $fetch['qty'];
                                $alamat = $fetch['alamattujuan'];
                    ?>
                        <tr style="background-color:white;">
                            <td><?=$tanggal?></td>
                            <td><?=$alamat?></td>
                            <td><?=$qty?></td>
                        </tr>
                    <?php
                        };
                    ?>
                </tbody>
                    </table>
                        <br>
                            <a href="barang.php"><button tpye="submit" class="btn btn-success">Kembali</button></a>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved. -->
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- footer -->
<?php include('footer.php'); ?>
</body>
</html>
