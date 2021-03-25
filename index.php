<?php
ob_start();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Sembako YPI Imam Ahmad Bin Hanbal</title>
	<link href="src/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="src/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
	<script defer src="javascript.js" type="text/javascript"></script>
</head>
<body>


	<div class="mt-5 container card shadow rounded p-3">
		<h3>
	  		Sembako Minimart Anak Shalih
	  		<small class="text-muted">Trial</small>
		</h3>
		<p>Sistem ini bertugas untuk meyimpan data, mengkonversi data tersebut kedalam file pdf beserta barcode, dan mengirimkan file pdf tersebut kepada setiap pegawai via <i>Email</i>. Data yang diproses oleh sistem adalah file ekstensi <mark>CSV</mark> yang berisi data 
			<ol>
				<li>Kode verifikasi ex : add-[bulan]-[tahun]</li>
				<li>Nama Pegawai</li>
				<li>Nomor Induk Yayasan</li>
				<li>Unit</li>
				<li>Nama barang | Satuan Jenis</li>
				<li>Jumlah barang</li>
				<li>Nama barang | Satuan Jenis & Jumlah Barang dapat dibuat seterusnya sesuai kebutuhan</li>
			</ol>
		</p>

		<div>
		<h4>
	  		<small class="text-muted">Pengaturan File CSV</small>
		  	</h4>
	  		<p>File yang diupload harus berekstensi <mark>CSV</mark>.

	  		</p>
	  		<p>
	  			<button id="dwn_csv_sc" type="button" class="btn btn-info btn-sm">Contoh file csv delimiter Semi Collon</button> untuk mendownload contoh file. <small class="text-muted"></small>
	  		</p>
	  		<!-- <p>
	  			<button id="dwn_csv_c" type="button" class="btn btn-info btn-sm">Contoh file csv delimiter Comma</button> untuk mendownload contoh file. <small class="text-muted"></small>
	  		</p> -->

	  		<small class="text-muted"><b>Pilih salah satu file yang sesuai dengan pengaturan delimiter komputer antum.</b> Untuk mengetahui delimiter kompoter antum dapat mendowload file dibawah ini.</small>
	  		<p>
	  			<button id="dwn_bat" type="button" class="btn btn-success btn-sm mt-3">BAT Setting Regional</button>
	  		</p>
		</div>
		
  		

	</div>


	<div class="mt-5 container card shadow rounded p-3">
		<form class="mt-3" action="Upload/index.php" method="post" enctype="multipart/form-data">
		<input class="form-control" type="file" name="uploadedFile" id="uploadedFile">

		<input class="btn btn-primary mt-3" type="submit" name="submit" value="Upload File Sembako">
	</form>
	</div>

	



</body>
</html>