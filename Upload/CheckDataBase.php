<?php
require_once "../control/DbControl.php";
require_once __DIR__."/../control/KodeControl.php";
// echo "<pre>";
$item = json_decode($_GET['data'],true);
$primaryKey = $item[0]."|".$item[2];
$namaPegawai = $item[1];
$niyPegawai = $item[2];
$email = $item[4];


// echo $primaryKey;

// print_r ($item); -> Yang ke 5

$banyakDataSDM = KodeControl::$BANYAK_DATA_SDM;
$adaSembako = false;

if ($item[$banyakDataSDM] !== "") {

	$adaSembako = true;
	$barang = array_slice($item, 59);
	$tempArray = array();
	$resultBarang = array();
	for ($i = 0 ; $i< count($barang) ; $i++){


	    if (count($tempArray) != 2){

	        array_push($tempArray, $barang[$i]);

	        if (count($tempArray) == 2){
	            array_push($resultBarang, implode("|",$tempArray));
	            // hapus temp array
	            $tempArray = array();

	        }
	    }
	}

}

// print_r ($resultBarang);

$arrStat = array('eksekusi' => 0,
	'eksis' => 0 ,
	'tidak_eksis' => 0,
	'dimasukan' => 0,
	'diupdate' => 0,
	'tidak_dimasukan' => 0
);

$db = new DbControl();
$jsonR = new JsonR ();

// var_dump($db->isConnect);

if (!$db->isConnect){
	echo ($jsonR->ResultDb($db->mysqli->connect_errno,$db->mysqli->connect_error));
}
else {
	$arrStat['eksekusi'] ++;

	// Primary Key => kode dan NIY
	// Check apakah file sudah tersedia atau belum didalam data base.
	// Jika belum makan create database
	// Jika sudah maka update

	if ($db->isExistInStatusSembako($primaryKey)){
		// Data sudah ada
		$arrStat['eksis'] ++;

		// maka update
		if ($db->updateData ($primaryKey,$namaPegawai,$niyPegawai)){
			$arrStat['diupdate'] ++;

		}

	}
	else {
		// Data tidak ada
		$arrStat['tidak_eksis'] ++;

		
		if ($adaSembako) {
			// Maka insert
			if ($db->insertNewData ($primaryKey,$namaPegawai,$niyPegawai)){
				$arrStat['dimasukan'] ++;
			}
		}
		else {
			$arrStat['tidak_dimasukan']++;
		}
		


	}

	// Ada atau tidak ada datanya-masukan barang-barang sembako kedalam db
	// Hapus semua data terlebih dahulu
	// $resultBarang
	$db->deleteDaftarSembako ($primaryKey);

	if ($adaSembako){

		foreach ($resultBarang as $key => $value) {

			if ($value != "|"){

				// explode barang, memisahkan nama barang dan jumlah barang
				$expBarang = explode("|", $value);

				// check apakah jumlah sembakonya kosong atau nol
				// jika tidak kosong atau tidak nol maka masukan nilai kedalam basis data

				if ($expBarang[1] != "" && $expBarang[1] != 0){
					$db->insertDaftarSembako ($primaryKey,$value);
				}	

			}
		}
	}

	


}


// Hasil
echo (json_encode($arrStat));



?>