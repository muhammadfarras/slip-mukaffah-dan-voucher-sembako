<?php
error_reporting(E_ERROR);
require_once __DIR__."\..\aset\Configuration.php";
require_once __DIR__."\JsonR.php";

require '../vendor/autoload.php';




/**
 * 
 */
class DbControl
{
	public $mysqli;
	public $isConnect;
	


	// check apakah koneksi berhasil atau tidak kedalam database
	function __construct()
	{
		
		$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/..");
		$dotenv->load();


		$this->mysqli = new mysqli (
			$_ENV['HOST'],
			$_ENV['USERNAME'],
			$_ENV['PASSWORD'],
			$_ENV['DB']);

		// check connection

		if ($this->mysqli->connect_errno){
			
			$this->isConnect = false;
			
		}
		else {
			$this->isConnect = true;
			// echo $this->jsonR->ResultDb($this->mysqli->connect_errno,strval($this->mysqli->connect_error));
		}

		// print_r ($this->mysqli);
	}

	function isExistInStatusSembako($primaryKey){
		$query = "SELECT * FROM status_sembako WHERE idSembako = '$primaryKey'";

		$result = $this->mysqli -> query ($query);
		// print_r ($result);
		// var_dump($result->num_rows);

		if ($result->num_rows > 0){

			return true;
		}
		else {

			return false;
		}
	}

	function statusCountSembakoTaken ($primaryKey){
		$query = "SELECT * FROM status_sembako 	WHERE idSembako LIKE '%$primaryKey%' AND statusPengambilan = 'Sudah'";
		$result = $this->mysqli -> query ($query);
		$hasilSudah = $result->num_rows;

		$query = "SELECT * FROM status_sembako 	WHERE idSembako LIKE '%$primaryKey%' AND statusPengambilan = 'Belum'";
		$result = $this->mysqli -> query ($query);
		$hasilBelum = $result->num_rows;

		return array('Sudah' => $hasilSudah, 'Belum' => $hasilBelum);

	}

	function selectStatusSembako ($primaryKey){
		$query = "SELECT * FROM status_sembako WHERE idSembako = '$primaryKey'";
		$result = $this->mysqli -> query ($query);

		return $result->fetch_assoc();
	}


	function selectBarangSembako ($primaryKey){
		$query = "SELECT * FROM daftar_sembako WHERE kodeSembako = '$primaryKey'";
		$result = $this->mysqli -> query ($query);

		return $result;
	}


	function selectSembakoTaken ($kodeSembako){
		$query = "SELECT * FROM status_sembako WHERE idSembako LIKE '%$kodeSembako%' AND statusPengambilan = 'Sudah'";
		$result = $this->mysqli -> query ($query);

		return $result;
	}


	function selectSembakoNoTaken ($kodeSembako){
		$query = "SELECT * FROM status_sembako WHERE idSembako LIKE '%$kodeSembako%' AND statusPengambilan = 'Belum'";
		$result = $this->mysqli -> query ($query);

		return $result;
	}





	function insertNewData ($primaryKey,$namaPegawai,$niyPegawai){

		$namaPegawai = $this->mysqli->real_escape_string ($namaPegawai);
		$query = "INSERT INTO status_sembako (`idSembako`, `namaPegawai`, `niyPegawai`) VALUES ('$primaryKey','$namaPegawai','$niyPegawai')";	

		if ($this->mysqli -> query ($query)) {
			return true;
		}
		else {
			return false;
		}
	}

	function updateData ($primaryKey,$namaPegawai,$niyPegawai){
		$namaPegawai = $this->mysqli->real_escape_string ($namaPegawai);
		$query = "UPDATE status_sembako SET `statusPengambilan`= 'Belum' ,`namaPegawai`='$namaPegawai',`niyPegawai`='$niyPegawai'  WHERE idSembako = '$primaryKey'";


		// var_dump($this->mysqli -> query ($query));
		if ($this->mysqli -> query ($query)) {
			return true;
		}
		else {
			return false;
		}
	}


	function updateTakenSembako ($primaryKey,$waktuPengambilan){
		$query = "UPDATE status_sembako SET statusPengambilan = 'Sudah' , waktuPengambilan = '$waktuPengambilan' WHERE idSembako = '$primaryKey'";
		if ($this->mysqli -> query ($query)) {
			return true;
		}
		else {
			return false;
		}
	}

	function deleteDaftarSembako ($primaryKey){
		$query = "DELETE FROM daftar_sembako WHERE kodeSembako = '$primaryKey'";

		$result = $this->mysqli -> query ($query);
		// print_r ($result);
		// var_dump($result->num_rows);

		// if ($result->num_rows > 0){

		// 	return true;
		// }
		// else {

		// 	return false;
		// }
	}

	function insertDaftarSembako ($primaryKey,$barang){
		$barang = $this->mysqli->real_escape_string ($barang);
		$query = "INSERT INTO daftar_sembako (`kodeSembako`, `ketBarang`) VALUES ('$primaryKey','$barang')";

		if ($this->mysqli -> query ($query)) {
			return true;
		}
		else {
			return false;
		}
	}
}

?>