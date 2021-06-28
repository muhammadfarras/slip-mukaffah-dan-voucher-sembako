<?php

require_once(__DIR__."/../../control/DbControl.php");

$data = array();
$status = array('status' => '' ,'text' => '' , 'data' => $data);

if (!isset($_GET['kode_sembako']) && empty($_GET['kode_sembako'])) {
	$status['status'] = "Failed";
	$status['text'] = "Kesalahan pada data yang dikirim . . . .";
	print_r(json_encode($status));
	return;
}
$primaryKey = $_GET['kode_sembako'];

$db = new DbControl();


$result = $db->statusCountSembakoTaken ($primaryKey);

if ($result['Sudah'] >= 0 && $result['Belum'] >=0 ){
	$status['status'] = "Yes";
	$status['text'] = "Data berhasil diambil";
	$status['data'] = $result;
}
else {
	$status['status'] = "Failed";
	$status['text'] = "Kesalahan pada basis data . . . .";
}

print_r(json_encode($status));
?>