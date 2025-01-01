<?php

include ('koneksi.php');

// Menambah User
if(isset($_POST['addnewuser'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namalengkap = $_POST['namalengkap'];
    $leveluser = $_POST['leveluser'];

   // soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang di enkripsi dengan ekstensinya
 
    // validasi udah ada atau belum barangnya
    $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE nama_lengkap='$namalengkap'");
    $hitung = mysqli_num_rows($cek);

    if($hitung<1){
        // jika belum ada

        // proses upload gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            // validasi ukuran filenya
            if($ukuran <15000000) {
                move_uploaded_file($file_tmp, 'images/'.$image);
                        
                $addtotable = mysqli_query($conn, "INSERT INTO tb_user (nama_lengkap, username, password, level_user, image) VALUE ('$namalengkap','$username','$password','$leveluser','$image')");
                if($addtotable){
                    header('location:user.php');
                } else {
                    echo "Tambah Data Gagal";
                    header('location:user.php');
                }
            } else {
                // kalau filenya lebih dari 1.5mb
                 echo '
                <script>
                    alert("Ukuran file terlalu besar");
                    window.location.href="user.php";
                </script>
                ';
            }
        } else {
            // kalau filenya tidak png / jpg
             echo '
            <script>
                alert("File harus png/jpg");
                window.location.href="user.php";
            </script>
            ';
        }

    } else {
        // jika sudah ada
         echo '
        <script>
            alert("Nama barang sudah terdaftar");
            window.location.href="user.php";
        </script>
        ';
    }
}

// Update User
if(isset($_POST['edituser'])){
    $idu = $_POST['idu'];
    $username = $_POST['username'];
    $password = $_POST['password'];

     // soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang di enkripsi dengan ekstensinya

    $gambar = mysqli_query($conn, "SELECT * FROM tb_user where id_user = '$idu'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];

    if($ukuran==0){
        // jika tidak ingin upload
        $update = mysqli_query($conn, "UPDATE tb_user set username='$username', password='$password' WHERE id_user='$idu'"); 
        if($update){
            header('location:user.php');
        } else {
            echo "Edit Data Gagal";
            header('location:user.php');
        }
    } else {
        // jika ingin apload
        unlink($img);
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn, "UPDATE tb_user set username='$username', password='$password', image='$image' WHERE id_user='$idu'"); 
        if($update){
            header('location:barang.php');
        } else {
            echo "Edit Data Gagal";
            header('location:user.php');
        }
    }
};

// Delete User
if(isset($_POST['hapususer'])){
    $idu = $_POST['idu'];

    $gambar = mysqli_query($conn, "SELECT * FROM tb_user where id_user = '$idu'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE from tb_user where id_user='$idu'");
    if($hapus){
        header('location:user.php');
    } else {
        echo "Edit Data Gagal";
        header('location:user.php');
    }
};


// add data barang
if(isset($_POST['addnewbarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $kategoribarang = $_POST['kategori'];
    $satuanbarang = $_POST['satuan'];
    $merkbarang = $_POST['merk'];
    $hargabarang = $_POST['harga'];
    $qty = $_POST['qty'];

 // soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang di enkripsi dengan ekstensinya
 
    // validasi udah ada atau belum barangnya
    $cek = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if($hitung<1){
        // jika belum ada

        // proses upload gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            // validasi ukuran filenya
            if($ukuran <15000000) {
                move_uploaded_file($file_tmp, 'images/'.$image);
                        
                $addtotable = mysqli_query($conn, "INSERT INTO tb_databarang (idbarang, namabarang, kategori, satuan, merk, harga, image) VALUE ('$idb','$namabarang','$kategoribarang','$satuanbarang','$merkbarang','$hargabarang' ,'$image')");
                if($addtotable){
                    header('location:barang.php');
                } else {
                    echo "Tambah Data Gagal";
                    header('location:barang.php');
                }
            } else {
                // kalau filenya lebih dari 1.5mb
                 echo '
                <script>
                    alert("Ukuran file terlalu besar");
                    window.location.href="barang.php";
                </script>
                ';
            }
        } else {
            // kalau filenya tidak png / jpg
             echo '
            <script>
                alert("File harus png/jpg");
                window.location.href="barang.php";
            </script>
            ';
        }

    } else {
        // jika sudah ada
         echo '
        <script>
            alert("Nama barang sudah terdaftar");
            window.location.href="barang.php";
        </script>
        ';
    }
}

// update Data Barang
if(isset($_POST['editdatabarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $kategoribarang = $_POST['kategori'];
    $satuanbarang = $_POST['satuan'];
    $merkbarang = $_POST['merk'];
    $hargabarang = $_POST['harga'];

     // soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang di enkripsi dengan ekstensinya

    $gambar = mysqli_query($conn, "SELECT * FROM tb_databarang where idbarang = '$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];

    if($ukuran==0){
        // jika tidak ingin upload
        $update = mysqli_query($conn, "UPDATE tb_databarang set namabarang='$namabarang', kategori='$kategoribarang', satuan='$satuanbarang', merk='$merkbarang', harga='$hargabarang' WHERE idbarang='$idb'"); 
        if($update){
            header('location:barang.php');
        } else {
            echo "Edit Data Gagal";
            header('location:barang.php');
        }
    } else {
        // jika ingin apload
        unlink($img);
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn, "UPDATE tb_databarang set namabarang='$namabarang', kategori='$kategoribarang', satuan='$satuanbarang', merk='$merkbarang', harga='$hargabarang', image='$image' WHERE idbarang='$idb'"); 
        if($update){
            header('location:barang.php');
        } else {
            echo "Edit Data Gagal";
            header('location:barang.php');
        }
    }
}

// Hapus Stock Barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $gambar = mysqli_query($conn, "SELECT * FROM tb_databarang where idbarang = '$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE from tb_databarang where idbarang='$idb'");
    if($hapus){
        header('location:barang.php');
    } else {
        echo "Edit Data Gagal";
        header('location:barang.php');
    }
}


// Menambah supplier
if(isset($_POST['addnewsupplier'])){
    $ids = $_POST['ids'];
    $namasupplier = $_POST['namasupplier'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];
    
    $addtosupplier = mysqli_query($conn, "INSERT INTO tb_supplier (idsupplier, namasupplier, kontak, alamat) VALUES ('ids','$namasupplier', '$kontak', '$alamat')" );

    if($addtosupplier){
        header('location:supplier.php');
    } else {
        echo "Tambah Data Gagal";
        header('location:supplier.php');
    }
}


// Edit Supplier
if(isset($_POST['editsupplier'])){
    $namasupplier = $_POST['namasupplier'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];
    $ids = $_POST['ids'];

    $queryupdate = mysqli_query($conn, "UPDATE tb_supplier SET namasupplier='$namasupplier', kontak='$kontak', alamat='$alamat' WHERE idsupplier='$ids'");
    if($queryupdate){
        
        header('location:supplier.php');
    } else {
        echo "Edit User Gagal";
        header('location:supplier.php');
    }
}


// Delete supplier
if(isset($_POST['hapussupplier'])){
    $id = $_POST['ids'];

    $querydelete = mysqli_query($conn, "DELETE FROM tb_supplier WHERE idsupplier='$id'");
    if($querydelete){
        header('location:supplier.php');
    } else {
        echo "Edit User Gagal";
        header('location:supplier.php');
    }
};


// Menambah barang masuk
if(isset($_POST['addnewmasuk'])){
    $idm = $_POST['idm'];
    $barang = $_POST['namabarang'];
    $supplier = $_POST['supplier'];
    $qty = $_POST['qty'];

    if($qty > 0){
        $cekstockbarang = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang='$barang'");
        $ambildatanya = mysqli_fetch_array($cekstockbarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangndenganquantity = $stocksekarang + $qty;


        $addtomasuk = mysqli_query($conn, "INSERT INTO tb_barangmasuk (idmasuk, idbarang, idsupplier, qty) VALUES ('$idm', '$barang', '$supplier', '$qty')" );
        $updatestokmasuk = mysqli_query($conn, "UPDATE tb_databarang set stock = '$tambahkanstocksekarangndenganquantity' WHERE idbarang = '$barang'");

        if($addtomasuk && $updatestokmasuk){
            header('location:masuk.php');
        } else {
            echo "Tambah Data Gagal";
            header('location:masuk.php');
        }
    } else {
        // jika qty kurang dari 0
         echo '
        <script>
            alert("Jumlah Barang masuk harus lebih dari 0");
            window.location.href="masuk.php";
        </script>
        ';
    }
}

// Edit Barang Masuk 
if(isset($_POST['editmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm']; 
    $supplier = $_POST['supplier'];
    $qty = $_POST['qty'];

    if($qty > 0){
        $lihatstock = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang = '$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];
        
        $qtyskrg = mysqli_query($conn, "SELECT * FROM tb_barangmasuk WHERE idmasuk = '$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];
        
        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg + $selisih;
            $kuranginstocknya = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$kurangin' WHERE idbarang ='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE tb_barangmasuk SET qty='$qty', idsupplier='$supplier' WHERE idmasuk='$idm'");
            if($kuranginstocknya && $updatenya){
                header('location:masuk.php');
            } else {
                echo "Edit Data Gagal";
                header('location:masuk.php');
            }
        } else {
            $selisih = $qtyskrg-$qty;
            $tambahin =$stockskrg - $selisih;
            $tambahinstocknya = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$tambahin' WHERE idbarang ='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE tb_barangmasuk SET qty='$qty', idsupplier='$supplier' WHERE idmasuk='$idm'");
            if($tambahinstocknya && $updatenya){
                header('location:masuk.php');
            } else {
                echo "Edit Data Gagal";
                header('location:masuk.php');
            }
        }
    } else {
        // jika qty kurang dari 0
         echo '
        <script>
            alert("Jumlah Barang masuk harus lebih dari 0");
            window.location.href="masuk.php";
        </script>
        ';
    }
}


// menghapus barang masuk
if(isset($_POST['hapusmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm']; 

    $getdatastock = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $count = $stok - $qty;
    
    $update = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$count' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM tb_barangmasuk WHERE idmasuk = '$idm'");

    if($update && $hapusdata){
           header('location:masuk.php');
        } else {
             echo "Edit Data Gagal";
            header('location:masuk.php');
        }
    } 


// Menambah barang keluar
if(isset($_POST['addnewkeluar'])){
    $idk = $_POST['idk'];
    $barangnya = $_POST['namabarang'];
    $tujuan = $_POST['tujuan'];
    $qty = $_POST['qty'];

    if($qty > 0){
        $cekstockbarang = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstockbarang);
        
        $stocksekarang = $ambildatanya['stock'];
        
        if($stocksekarang >= $qty){
            // kalau barangnya cukup
            $kurangistocksekarangndenganquantity = $stocksekarang - $qty;
            

        $addtokeluar = mysqli_query($conn, "INSERT INTO tb_barangkeluar (idkeluar, idbarang, alamattujuan, qty) VALUES ('$idk', '$barangnya', '$tujuan', '$qty')" );
        $updatestokkeluar = mysqli_query($conn, "UPDATE tb_databarang set stock = '$kurangistocksekarangndenganquantity' WHERE idbarang = '$barangnya'");

        if($addtokeluar && $updatestokkeluar){
            header('location:keluar.php');
        } else {
            echo "Tambah Data Gagal";
            header('location:keluar.php');
        }
    } else {
        // kalau barangnya tidak cukup
        echo '
        <script>
        alert("Stock saat ini tidak mencukupi");
        window.location.href="keluar.php";
        </script>
        ';
    }
 } else {
        // jika qty kurang dari 0
         echo '
        <script>
            alert("Jumlah Barang keluar harus lebih dari 0");
            window.location.href="keluar.php";
        </script>
        ';
    }
    
}


// Edit Barang Keluar
if(isset($_POST['editkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk']; 
    $tujuan = $_POST['tujuan'];
    $qty = $_POST['qty'];

    if($qty > 0 ){
        $lihatstock = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang = '$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];
        
        $qtyskrg = mysqli_query($conn, "SELECT * FROM tb_barangkeluar WHERE idkeluar = '$idk'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];
        
        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
        $kurangin =$stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$kurangin' WHERE idbarang ='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE tb_barangkeluar SET qty='$qty', alamattujuan='$tujuan' WHERE idkeluar='$idk'");
        if($kuranginstocknya && $updatenya){
           header('location:keluar.php');
        } else {
            echo "Edit Data Gagal";
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtyskrg-$qty;
        $tambahin =$stockskrg + $selisih;
        $tambahinstocknya = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$tambahin' WHERE idbarang ='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE tb_barangkeluar SET qty='$qty', alamattujuan='$tujuan' WHERE idkeluar='$idk'");
        if($tambahinstocknya && $updatenya){
            header('location:keluar.php');
        } else {
            echo "Edit Data Gagal";
            header('location:keluar.php');
        }
    }
 } else {
        // jika qty kurang dari 0
         echo '
        <script>
            alert("Jumlah Barang keluar harus lebih dari 0");
            window.location.href="keluar.php";
        </script>
        ';
    }
}


// menghapus barang masuk
if(isset($_POST['hapuskeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk']; 

    $getdatastock = mysqli_query($conn, "SELECT * FROM tb_databarang WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $count = $stok + $qty;

    $update = mysqli_query($conn, "UPDATE tb_databarang SET stock = '$count' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM tb_barangkeluar WHERE idkeluar = '$idk'");

    if($update && $hapusdata){
           header('location:keluar.php');
        } else {
             echo "Edit Data Gagal";
            header('location:keluar.php');
        }
    } 

?>