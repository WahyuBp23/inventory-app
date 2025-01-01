<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
  <title>Data Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>

<body>
<div class="container">
			<section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <div class="row">
                    <div class="col-md-4" style="padding:5px; padding-left:10px;">
                      <i class="fas fa-table mr-1"></i>
                        <h3>Table Data Barang</h3>
                      </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    </button>
                    </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                 <div class="card-body">
                     <div class="col">
                        <form method="post" class="form-inline">
                            
                        </form>
                    </div>

                    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="1" style="background-color:#ffc107;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Jenis</th>
                          <th>Satuan</th>
                          <th>Merk</th>
                          <th>Stock</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php

                        if(isset($_POST['filter_tgl'])){
                            $mulai = $_POST['tgl-mulai'];
                            $selesai = $_POST['tgl-selesai'];

                        if($mulai!=null || $selesai!=null){
                            $ambilsemuadatabarang = mysqli_query($conn, "SELECT * FROM tb_databarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) order by idmasuk DESC");
                        } else {
                            $ambilsemuadatabarang = mysqli_query($conn, "SELECT * FROM tb_databarang order by idbarang DESC"); 
                        }
                    } else {
                        $ambilsemuadatabarang = mysqli_query($conn, "SELECT * FROM tb_databarang order by idbarang DESC"); 
                    }

                        
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambilsemuadatabarang)){
                          $idb = $data['idbarang'];
                          $namabarang = $data['namabarang'];
                          $kategoribarang = $data['kategori'];
                          $satuanbarang = $data['satuan'];
                          $merkbarang = $data['merk'];
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
                          <td style="border-bottom: 1px solid #dee2e6"><?=$idb;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$namabarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$kategoribarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$satuanbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$merkbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$stock;?></td>

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
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: ['print' , 'pdf'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
	

</body>

</html>