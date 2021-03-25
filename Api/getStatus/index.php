<?php

require_once(__DIR__."/../../control/DbControl.php");

$data = array();
$status = array('status' => '' , 'nilai' => $data);

if (!isset($_GET['id_sembako']) && empty($_GET['id_sembako'])) {
	$status['status'] = "Failed";
	print_r(json_encode($status));
	return;
}
$primaryKey = $_GET['id_sembako'];

$db = new DbControl();


if ($db->isExistInStatusSembako($primaryKey)){

// Id Sembako suda ada maka status Found
	$status['status'] = "Yes";

	$result = $db->selectStatusSembako ($primaryKey);

// Masukan semua data ke array result
	foreach ($result as $key => $value) {
		$status['nilai'] += array($key =>$value);
	}
}
else {
	$status['status'] = "No";
}











print_r(json_encode($status));
?>