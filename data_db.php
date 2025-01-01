<?php
            include ('function.php');
?>
            
            <table id="example1" class="table table-bordered table-hover" style="width:100%">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s_kategori="";
                    $s_keyword="";
                    if (isset($_POST['kategori'])) {
                        $s_kategori = $_POST['kategori'];
                        $s_keyword = $_POST['keyword'];
                    }
                    
                    $search_kategori = '%'. $s_kategori .'%';
                    $search_keyword = '%'. $s_keyword .'%';
                    $no = 1;
                    $query = "SELECT * FROM tb_databarang WHERE kategori LIKE ? AND (namabarang LIKE ? OR kategori LIKE ? OR merk LIKE ? OR satuan LIKE ? OR idbarang LIKE ?) ORDER BY idbarang ASC LIMIT 100";
                    $dewan1 = $conn->prepare($query);
                    $dewan1->bind_param('ssssss', $search_kategori, $search_keyword, $search_keyword, $search_keyword, $search_keyword, $search_keyword);
                    $dewan1->execute();
                    $res1 = $dewan1->get_result();
                    
                    if ($res1->num_rows > 0) {
                        while ($row = $res1->fetch_assoc()) {
                    $idb = $row['idbarang'];
                    $namabarang = $row['namabarang'];
                    $kategori = $row['kategori'];
                    $satuanbarang = $row['satuan'];
                    $merkbarang = $row['merk'];
                    $stock = $row['stock'];

                     // cek ada gambar atau tidak
                            $gambar = $row['image']; //ambil gambar
                              if($gambar==null){
                                // jika tidak ada gambar
                                $img = 'No Photo';
                              } else {
                                // jika ada gambar
                                $img = '<img src="images/'.$gambar.'" class = "zoomable">';
                            }
            ?>
                      <tr>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$no++;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$img;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$idb;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$namabarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$kategori;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$merkbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$satuanbarang;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$stock;?></td>
                          <td style="border-bottom: 1px solid #dee2e6">
                            <!-- Button Edit -->
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>" style = "margin-right:10px;">
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
                                    <input type="text" name="idb" value="<?=$idb;?>" class="form-control" style="margin-bottom:15px;" readonly>
                                  <label>Nama Barang</label>
                                    <input type="text" name="namabarang" value="<?=$namabarang ;?>" class="form-control" style="margin-bottom:15px;" required>
                                  <label>Kategori Barang</label>
                                    <input type="text" name="kategori" value="<?=$kategori; ?>" class="form-control" style="margin-bottom:15px;">
                                    <label>Merk Barang</label>
                                      <input type="text" name="merk" value="<?=$merkbarang; ?>" class="form-control" style="margin-bottom:15px;">
                                  <label>Satuan Barang</label>
                                    <input type="text" name="satuan" value="<?=$satuanbarang; ?>" class="form-control" style="margin-bottom:15px;">
                                  <label>Upload Gambar</label>
                                    <input type="file" name="file" class="form-control" style="margin-bottom:15px;">
                                  <input type="text" name="idb" value="<?=$idb;?>">
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" name="editdatabarang">Simpan Perubahan <i class="fa-solid fa-check"></i></button>
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
                                  apakah kamu yakin ingin menghapus <?=$idb;?> ?
                                  <input type="text" name="idb" value="<?=$idb;?>">
                                  <br>
                                  <br>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <input type="submit" value="hapus" name="hapusbarang">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>