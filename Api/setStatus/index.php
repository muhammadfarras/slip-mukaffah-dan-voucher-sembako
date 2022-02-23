<?php
ob_start();
require_once(dirname(__FILE__)."/../../control/DbControl.php");

// Waktu diganti untuk mengisi waktu pengambilan
date_default_timezone_set ("Asia/Jakarta");
$timeNow = date("Y-m-d H:i:s");



$status = array('status' => '' , 'text' => '');

if (!isset($_POST['id_sembako']) && empty($_POST['id_sembako'])) {
	$status['status'] = "Failed";
	$status['text'] = "Kesalahan pada data yang dikirim . . . ";
	print_r(json_encode($status));
	return;
}




$primaryKey = $_POST['id_sembako'];

$db = new DbControl();

if ($db->updateTakenSembako ($primaryKey,$timeNow)){
	$status['status'] = "Yes";
	$status['text'] = "Data berhasil diubah didalam database . . .";
	print_r(json_encode($status));
}
else {
	$status['status'] = "Failed";
	$status['text'] = "Kesalahan update data . . . ";
	print_r(json_encode($status));
}

?>