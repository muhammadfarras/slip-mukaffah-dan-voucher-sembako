<?php
// $fileType = strtolower(pathinfo($_FILES['uploadedFile']['name'],PATHINFO_EXTENSION));
/**
 * 
 */
class FileControl
{
	
	protected $basename;
	protected $file;
	private $fileType;


	function __construct($file, string $namedForm = "uploadedFile")
	{
		$this->file = $file[$namedForm];
		$this->fileType = strtolower(pathinfo($file[$namedForm]['name'],PATHINFO_EXTENSION));
		$this->basename = strtolower(pathinfo($file[$namedForm]['name'],PATHINFO_FILENAME));
	}

	function isFileCsv (){
		if ($this->fileType == 'csv' or $this->fileType == 'xlsx'){
			return true;
		}
		return false;
	}

	function isFileValid () {
		$array = explode("-", $this->basename);
		// echo count($array);

		if (count($array) == 3){

			if ($array[0] == "add"){
				
				if ( ((int)$array[1] !== 0) && ((int)$array[2]) !== 0){
					return true;
				}

			}

			
		}
		return false;
	}

	function getBaseName (){
		return basename($this->file['name']);
	}

	function getNameOnly (){
		return explode(".",$this->file['name'])[0];
	}

	function getTempFile (){
		return $this->file['tmp_name'];
	}
}

?>