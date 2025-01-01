<table id="example1" class="table table-bordered table-hover" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Supplier</th>
        <th>Nama</th>
        <th>Kontak</th>
        <th>Alamat</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
                require 'function.php';
                require 'cek.php';
            $s_alamat="";
            $s_keyword="";
            if (isset($_POST['alamat'])) {
                $s_alamat = $_POST['alamat'];
                $s_keyword = $_POST['keyword'];
            }
            
            $search_alamat = '%'. $s_alamat .'%';
            $search_keyword = '%'. $s_keyword .'%';
            $no = 1;
            $query = "SELECT * FROM tb_supplier WHERE alamat LIKE ? AND (idsupplier LIKE ? OR namasupplier LIKE ? OR alamat LIKE ?) ORDER BY idsupplier ASC LIMIT 100";
            $dewan1 = $conn->prepare($query);
            $dewan1->bind_param('ssss', $search_alamat, $search_keyword, $search_keyword, $search_keyword);
            $dewan1->execute();
            $res1 = $dewan1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                          $ids = $row['idsupplier'];
                          $namasupplier = $row['namasupplier'];
                          $alamat = $row['alamat'];
                          $kontak = $row['kontak'];
                
            ?>
                      <tr>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$no++;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$ids;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$namasupplier;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$kontak;?></td>
                          <td style="border-bottom: 1px solid #dee2e6"><?=$alamat;?></td>
                          <td style="border-bottom: 1px solid #dee2e6">
                            <!-- Button Edit -->
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$ids;?>" style = "margin-right:10px;">
                              <i class="fa-solid fa-pen-to-square"></i>
                              </button>
                                  <input type="hidden" name="idbarangygmaudihapus" value="<?=$ids;?>">
                                                    <!-- Button Delete -->
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$ids;?>">
                               <i class="fa-solid fa-trash"></i>
                                  </button></td>
                        </tr>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?=$ids;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              
                              <!-- Modal Header -->
                              <div class="modal-header" style="background-color:#ffc107;color:white;">
                                <h4 class="modal-title">Edit Data Supplier</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              
                              <!-- Modal body -->
                              <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                  <label>Kode Supplier</label>
                                  <input type="text" name="ids" value="<?=$ids;?>" class="form-control" style="margin-bottom:15px;" readonly>
                                  <label>Nama Supplier</label>
                                  <input type="text" name="namasupplier" value="<?=$namasupplier; ?>" class="form-control" style="margin-bottom:15px;" required>
                                  <label>Kontak</label>
                                  <input type="text" name="kontak" value="<?=$kontak; ?>" class="form-control" style="margin-bottom:15px;" required>
                                  <label>Alamat</label>
                                  <textarea type="text" name="alamat" class="form-control" rows="3" placeholder="Masukan Alamat" required><?=$alamat; ?></textarea>
                                  <input type="hidden" name="ids" value="<?=$ids;?>">
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button tpye="submit" class="btn btn-warning" name="editsupplier">Simpan Perubahan <i class="fa-solid fa-check"></i></button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Delete Modal -->
                        <div class="modal fade" id="delete<?=$ids;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              
                              <!-- Modal Header -->
                              <div class="modal-header" style="background-color:#dc3545;color:white;">
                                <h4 class="modal-title">Hapus Supplier</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              
                              <!-- Modal body -->
                              <form method="post">
                                <div class="modal-body">
                                  apakah kamu yakin ingin menghapus <?=$namasupplier;?> ?
                                  <input type="hidden" name="ids" value="<?=$ids;?>">
                                  <br>
                                  <br>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button tpye="submit" class="btn btn-danger" name="hapussupplier">Hapus</button>
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