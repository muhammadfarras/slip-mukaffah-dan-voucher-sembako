<?php

/**
 * 
 */
class CSVControl 
{
	private $file;
	private $fileOpen;
	private $result;
	private $fileName;

	// Jumlah seluruh row
	private $countAll = 0;
	
	// jumlah row dari scv yg sesuai dengan kode tujuannya untuk validasi setiap row
	private $countTrue = 0;

	// Right Delimiter
	public $delimiter;



	public function __construct($file,$fileName)
	{
		$this->file =$file;
		$this->fileName = explode(".",$fileName)[0];
	}

	// explode(".",$fileName)[0]

	public function close(){
		// fclose($this->file);
	}

	public function open(){
		$this->fileOpen = fOpen($this->file,"r");
	}

	public function getTrueLine (){
		return $this->countTrue;
	}

	public function getAllLine(){
		return $this->countAll;
	}

	
	function getFileOpen (){
		return $this->fileOpen;
	}



	private function countAllLine (){
		$this->countAll++;
	}

	private function countTrueLine (){
		$this->countTrue++;
	}



	function isCodeValid ($row){

		// pastika mempunyai header dari table pertama


		$kode =  explode("-", $row[0]);

		try {

			if ($this->fileName == $row[0]){

				if (count($kode) !== 3){
					$this->countAllLine();
					return false;
				}


				if (strtolower($kode[0]) !== "add"){
					$this->countAllLine();
					return false;
				}

				// count both of them if kode is true
				$this->countAllLine();
				$this->countTrueLine();
				return true;


			}
			else {
				$this->countAllLine();
				return false;
			}
			

		}
		catch (Exception $e){

		}
	}


	function findDelimiter ($row,$currentDelimiter){
		$muchElement = count($row);

		if ($muchElement >= 4){
			$this->delimiter = $currentDelimiter;
			return true;
		}

		return false;

	}



	function isSumRowValid (){

		if ($this->countAll !== $this->countTrue){
			return false;
		}
		return true;
	}

	function getErrorFile (){
		if (!$this->isSumRowValid()){
			return $this->countTrue;
		}
		return "";
	}

	

	
}

?>