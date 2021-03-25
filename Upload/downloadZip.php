<?php
ob_start();
$namaFile = $_GET['path'];

// print_r ($namaFile);

// die();
// Force the download
header("Content-Disposition: attachment; filename=".$namaFile."");
// header("Content-Length: " . filesize($namaFile));
header("Content-Type: application/octet-stream;");
readfile($namaFile);

// Delete compresed langsung agar tidak full memori
unlink($namaFile);
?>