<?php
ob_start();

require_once (dirname(__FILE__)."/../control/FileControl.php");
require_once (dirname(__FILE__)."/../control/DirControl.php");

$fileName = md5(time());
$targetFile = "../aset/uploaded/".$fileName;
$fileObject = new FileControl ($_FILES);
$dirObject = new DirControl("../aset/pdf/".$fileObject->getNameOnly()."");


// Check apakah file ekstensinya adalah csv atau tidak
if ($fileObject->isFileCsv()){


	$namaFileAsli =  ($fileObject->getBaseName());

	// Apakah penamaan file tersebut valid atau tidak.... 
	if ($fileObject->isFileValid()){

		// Apakah folder telah tersedia di pdf atau tidak
		// Jika tidak buat folder tersebut
		if (!$dirObject->isDirExist()){
			$dirObject->createDir();
		}
		// Jika folder telah ada maka Upload File
		if (move_uploaded_file($fileObject->getTempFile(), $targetFile)){

		}

	}
	else {
		echo "Nama File tidak sesuai";
		die();
	}
		

}
else {
	echo "File Bukan CSV";
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <script src="../src/js/popper.min.js"></script> -->
	<link href="../src/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
	<script defer src="ajax.js" type="module"></script>
</head>
<body class="bg-white">
	<div class="mt-5 container-sm card shadow rounded p-3">
		

		<h3 class="text-center">Slip Mukafaah & Sembako Minimart Anak Shalih Bogor</h3>
		<p id="header_notif" class="lead muted">
			Mohon mengukuti proses sesuai dengan arahan . . .
		</p>

		<!-- <div id="alert-danger" class="toast alert alert-danger" role="alert">
		  A simple danger alert—check it out!
		</div> -->



		<div class="collapse" id="alert-danger">
		  <div class="card card-body alert-danger mb-3">
		    File tidak sesuai dengan format, lihat log untuk mengetahui kesalahan.
		  </div>

		  <button id="btn_reupload" type="button" class="btn btn-danger">Upload Ulang</button>
		</div>

		<div class="collapse" id="alert-info">
		  <div class="card card-body alert-info">
		    Alhamdulillah file sesuai dengan format, tekan tombol dibawah untuk menaljutkan proses.
		    <br>
		    <b>MOHON UNTUK TIDAK ME-REFRESH HALAMAN ATAU MEMATIKAN KOMPUTER ANDA SAMPAI PROSES SELESAI.</b>
		    <hr>
		    <i>Jazakumullahu Khairan</i>
		  </div>
		</div>


		<div class="collapse" id="alert-info-db">
		  <div class="card card-body alert-info">
		    File telah di download, mohon untuk mengecheck beberapa file untuk memastikan tidak ada kesalahan.
		    Jika dirasa sudah cukup dapat menekan tombol dibawah ini untuk proses selanjutnya
		    <br>
		    <b>MOHON UNTUK TIDAK ME-REFRESH HALAMAN ATAU MEMATIKAN KOMPUTER ANDA SAMPAI PROSES SELESAI.</b>
		    <hr>
		    <i>Jazakumullahu Khairan</i>
		  </div>
		</div>

		<div class="collapse" id="alert-info-email">
		  <div class="card card-body alert-info">
		    Email sedang dkirim . . . . .
		    <br>
		    <b>MOHON UNTUK TIDAK ME-REFRESH HALAMAN ATAU MEMATIKAN KOMPUTER ANDA SAMPAI PROSES SELESAI.</b>
		    <hr>
		    <i>Jazakumullahu Khairan</i>
		  </div>
		</div>


		<div class="collapse" id="alert-info-final">
		  <div class="card card-body alert-info">
		    Alhamdulillah proses telah selesai . . . . . 


		    <button id="btn_proses_final" type="button" class="btn btn-success mt-3">
				<span>Selesai</span>
			</button>

		  </div>
		</div>

		
		<p id="path" class="d-none text-center"><?php echo $fileName;?></p>
		<p id="file-name" class="d-none text-center"><?php echo $namaFileAsli;?></p>
		<p id="dir_pdf_path" class="d-none text-center"><?php echo $dirObject->rootPath;?></p>
		<p id="base_name" class="d-none text-center"><?php echo explode(".",$fileObject->getBaseName())[0];?></p>

		<div id="btn-and-progress" class="collapse mt-3 mb-3">
			<button id="btn_proses" type="button" class="btn btn-success">
				<span>Proses</span>
				<span id="muter" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
				
			</button>


			<p class="muted mt-4">Generate PDF</p>
			<div class="progress">
			  <div id="progressbar" class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>


		<!-- Button dan proses db loading page -->
		<div id="btn-and-progress-db" class="collapse mt-3 mb-3">
			<button id="btn_proses_db" type="button" class="btn btn-success">
				<span>Proses</span>
				<span id="muterDb" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
				
			</button>


			<p class="muted mt-4">Check Database</p>
			<div class="progress">
			  <div id="progressbarDb" class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>


		<!-- Button dan proses email loading page -->
		<div id="btn-and-progress-email" class="collapse mt-3 mb-3">
			<button id="btn_proses_email" type="button" class="btn btn-success">
				<span>Proses</span>
				<span id="muterEmail" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
				
			</button>


			<p class="muted mt-4">Mengirim Email</p>
			<div class="progress">
			  <div id="progressbarEmail" class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>


		
	</div>

	<div class="mt-5 container-sm card shadow rounded p-3">
		<h1 class="display-6">Log</h1>
		<hr>
		
		<div id="log">
			
		</div>
	</div>

	
	<p class="d-none" id="server-name"><?php echo $_SERVER['SERVER_NAME']; ?></p>
	<p class="d-none" id="server-port"><?php echo $_SERVER['SERVER_PORT']; ?></p>
	<p class="d-none" id="request-scheme"><?php echo $_SERVER['REQUEST_SCHEME']; ?></p>

	<script type="module">
		
	</script>
</body>
</html>