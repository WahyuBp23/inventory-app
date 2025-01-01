<?php
  require 'function.php';
  require 'cek.php';

    $sql = mysqli_query($conn, "SELECT max(idbarang) as maxID FROM tb_databarang");
    $data = mysqli_fetch_array($sql);

    $kode = $data['maxID'];
    $urutan = (int)substr($kode, 4, 6);
 
    $urutan++;
    $ket = "BRG-"; 
    $kodeauto = $ket. sprintf("%03s", $urutan);

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
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="padding-left:15px;"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

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
         if($_SESSION['level_user'] == "pemilik" || $_SESSION['level_user'] == "admin") :?>
         <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['level_user'] == "admin") :?>
          <li class="nav-item">
            <a href="barang.php" class="nav-link active">
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
          <?php if($_SESSION['level_user'] == "admin") :?>
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
          <?php if($_SESSION['level_user'] == "pemilik") :?>
         <li class="nav-item">
            <a href="user.php" class="nav-link">
             <i class="nav-icon fa-solid fa-user-gear"></i>
                  <p>Managemen User</p>
              </p>
            </a>
          </li>
          <?php endif; ?>
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
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <div class="row">
                    <div class="col-md-4" style="padding:5px; padding-left:10px;">
                      <i class="fas fa-table mr-1"></i>
                        Table Data Barang
                      </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style ="margin-left:180px; margin-right:10px;">
                      Tambah Data <i class="fa-solid fa-plus" style="margin-left:5px"></i>
                    </button>
                    </div>
                    </div>
                  </div>
                  <?php
                        $ambildatastock = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE stock < 1");

                        while($fetch = mysqli_fetch_array($ambildatastock)){
                            $barang = $fetch['namabarang'];
                        
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Peringatan!</strong> Stock <?=$barang;?> Telah Habis.
                    </div>

                    <?php
                        };
                    ?>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table
                      id="example1"
                      class="table table-bordered table-hover"
                    >
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Gambar</th>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Kategori</th>
                          <th>Merk</th>
                          <th>Satuan</th>
                          <th>Stock</th>
                          <th>Harga</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                        $ambilsemuadatabarang = mysqli_query($conn, "SELECT * FROM tb_databarang");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambilsemuadatabarang)){
                          $idb = $data['idbarang'];
                          $namabarang = $data['namabarang'];
                          $kategori = $data['kategori'];
                          $satuanbarang = $data['satuan'];
                          $merkbarang = $data['merk'];
                          $hargabarang = $data['harga'];
                          $stock = $data['stock'];
                        
                          // cek ada gambar atau tidak
                            $gambar = $data['image']; //ambil gambar
                              if($gambar==null){
                                // jika tidak ada gambar
                                $img = 'No Photo';
                              } else {
                                // jika ada gambar
                                $img = '<img src="images/'.$gambar.'" class = "zoomable">';
                              }
                      ?>
                        <tr>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$i++;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$img;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$idb;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><strong><a href="detail.php?id=<?=$idb;?>"><?=$namabarang;?></a></strong></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$kategori;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$merkbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$satuanbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$stock;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$hargabarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6">
                            <!-- Button Edit -->
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>" style = "margin-right:10px; margin-bottom:8px">
                              <i class="fa-solid fa-pen-to-square"></i>
                              </button>
                                  <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                            <!-- Button Delete -->
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                               <i class="fa-solid fa-trash"></i>
                                  </button>
                          </td>
                        </tr>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?=$idb;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              
                              <!-- Modal Header -->
                               <div class="modal-header" style="background-color:#ffc107;color:white;">
                                <h4 class="modal-title">Edit Data Barang</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              
                              <!-- Modal body -->
                              <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                  <label>Kode Barang</label>
                                    <input type="text" name="idb" value="<?php echo $kodeauto;?>" class="form-control" style="margin-bottom:15px;" readonly>
                                  <label>Nama Barang</label>
                                    <input type="text" name="namabarang" value="<?=$namabarang ;?>" class="form-control" style="margin-bottom:15px;" required>
                                  <label>Kategori Barang</label>
                                    <input type="text" name="kategori" value="<?=$kategori; ?>" class="form-control" style="margin-bottom:15px;">
                                    <label>Merk Barang</label>
                                      <input type="text" name="merk" value="<?=$merkbarang; ?>" class="form-control" style="margin-bottom:15px;">
                                  <label>Satuan Barang</label>
                                    <input type="text" name="satuan" value="<?=$satuanbarang; ?>" class="form-control" style="margin-bottom:15px;">
                                  <label>Harga Barang</label>
                                    <input type="number" name="harga" value="<?=$hargabarang; ?>" class="form-control" style="margin-bottom:15px;">
                                  <label>Upload Gambar</label>
                                    <input type="file" name="file" class="form-control" style="margin-bottom:15px;">
                                  <input type="hidden" name="idb" value="<?=$idb;?>">
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button tpye="submit" class="btn btn-warning" name="editdatabarang">Simpan Perubahan <i class="fa-solid fa-check"></i></button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Delete Modal -->
                        <div class="modal fade" id="delete<?=$idb;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              
                              <!-- Modal Header -->
                              <div class="modal-header" style="background-color:#dc3545;color:white;">
                                <h4 class="modal-title">Hapus Barang</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              
                              <!-- Modal body -->
                              <form method="post">
                                <div class="modal-body">
                                  apakah kamu yakin ingin menghapus <?=$namabarang;?> ?
                                  <input type="hidden" name="idb" value="<?=$idb;?>">
                                  <br>
                                  <br>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button tpye="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      <?php
                        };
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <!-- <div class="float-right d-none d-sm-block"><b>Version</b> 3.2.0</div>
        <strong
          >Copyright &copy; 2014-2021 -->
          <!-- <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved. -->
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <!-- <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- Page specific script -->
    <script>
      $(function () {
        $("#example1")
          .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });
    </script>
  </body>
  
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
     <div class="modal-header" style="background-color:#007bff;color:white;">
        <h4 class="modal-title">Tambah Data Barang</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <form method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <label>Kode Barang</label>
          <input type="text" name="idb" value="<?php echo $kodeauto;?>" class="form-control" style="margin-bottom:15px;" readonly>
        <label>Nama Barang</label>
          <input type="text" name="namabarang" placeholder="Masukan Nama Barang" class="form-control" style="margin-bottom:15px;" required>
        <label>Kategori Barang</label>
          <input type="text" name="kategori" placeholder="Masukan Kategori Barang" class="form-control" style="margin-bottom:15px;">
        <label>Satuan Barang</label>
          <input type="text" name="satuan"  placeholder="Masukan Satuan Barang" class="form-control" style="margin-bottom:15px;">
        <label>Merk Barang</label>
          <input type="text" name="merk"  placeholder="Masukan Merk Barang" class="form-control" style="margin-bottom:15px;">
        <label>Harga Barang</label>
          <input type="number" name="harga"  placeholder="Masukan Harga Barang" class="form-control" style="margin-bottom:15px;">
        <label>Upload Gambar</label>
          <input type="file" name="file" class="form-control" style="margin-bottom:15px;">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button tpye="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

</html>
