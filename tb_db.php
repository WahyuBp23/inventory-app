<!DOCTYPE html>
<html>
<?php include('header.php');?>

<body>
	
	<div class="container">
        <div class="row mb-3">
		    <div class="col-sm-12"><label class="text-bold">Filer dan Cari :</label></div> <br>
		    <div class="col-sm-3">
		        <div class="form-group form-inline">
		            <label style = "padding-right:5px">Kategori</label>
		            <select name="s_kategori" id="s_kategori" class="form-control">
		                <option value="">-- Pilih Kategori --</option>
						<option value="Skincare">Skincare</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-4">
		        <div class="form-group form-inline">
		            <label style = "padding-right:5px">Keyword</label>
		            <input type="text" name="s_keyword" id="s_keyword" class="form-control">
		        </div>
		    </div>
		</div><hr>

		<div class="data"></div>
		
    </div>

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
    <script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			load_data();
			function load_data(kategori, keyword)
			{
				$.ajax({
					method:"POST",
					url:"data_db.php",
					data: {kategori: kategori, keyword:keyword},
					success:function(hasil)
					{
						$('.data').html(hasil);
					}
				});
		 	}
			$('#s_keyword').keyup(function(){
				var kategori = $("#s_kategori").val();
	    		var keyword = $("#s_keyword").val();
				load_data(kategori, keyword);
			});
			$('#s_kategori').change(function(){
				var kategori = $("#s_kategori").val();
	    		var keyword = $("#s_keyword").val();
				load_data(kategori, keyword);
			});
		});
	</script>
</body>
</html>