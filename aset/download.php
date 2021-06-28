<?php
//download.php 
/*
  All your verification code will go here
*/      
// header("Pragma: public");
// header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
// header("Content-Type: application/force-download");
// header("Content-Type: application/octet-stream");
// header("Content-Type: application/download");
// header("Content-Disposition: attachment;filename=".$_GET['file']);
// header("Content-Transfer-Encoding: binary ");


$file = $_GET['file'];

$namaFile = "add-[bulan]-[tahun].csv";
if (basename($file) == "SetRegional.bat"){
	$namaFile = basename($file);
}

// Quick check to verify that the file exists
if (!file_exists($file)) die("File not found");




// Force the download
header("Content-Disposition: attachment; filename=".$namaFile."");
header("Content-Length: " . filesize($file));
header("Content-Type: application/octet-stream;");
readfile($file);