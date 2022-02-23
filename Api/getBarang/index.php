<?php

require_once(dirname(__FILE__)."/../../control/DbControl.php");

$daftar = array();
$barang = array('daftar' => $daftar);

if (!isset($_GET['id_sembako']) && empty($_GET['id_sembako'])) {
	$status['status'] = "Failed";
	print_r(json_encode($status));
	return;
}
$primaryKey = $_GET['id_sembako'];

// echo "<pre>";
$db = new DbControl();

$result = $db->selectBarangSembako ($primaryKey);


while ($row = $result->fetch_assoc()) {
	array_push($barang['daftar'],$row['ketBarang']);
}











print_r(json_encode($barang));
?>