<?php
require_once __DIR__."\JsonR.php";
/**
 * 
 */
class DirControl 
{
	public $rootPath;
	protected $jsonR;
	
	function __construct($path)
	{
		$this->jsonR = new JsonR ();
		$this->rootPath = $path;
	}

	function isDirExist (){
		return is_dir($this->rootPath);
	}

	function createDir (){
		return mkdir($this->rootPath);
	}
}

?>