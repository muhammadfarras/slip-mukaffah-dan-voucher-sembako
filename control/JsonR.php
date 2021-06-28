<?php
require_once ("TypeResult.php");

/**
 * 
 */
class JsonR extends TypeResult
{
	
	function ResultCsv (int $errorCode, $number = "", array $rows = null){
		$number++;
		$result = null;
		switch ($errorCode) {

			case 0:
			$result = json_encode(array('status' => 'correct',
				'text' => parent::$ALL_ROW_IS_VALID."$number",
				'values' => $rows));
			break;
			case 1:
				$result = json_encode(array('status' => 'error',
					'text' => parent::$ERROR_CODE_IN_ROW."$number"));
				break;
		}

		return $result;
	}

	function ResultZip (int $errorCode,string $pathText ="" , string $errorText=""){
		$result = null;

		switch ($errorCode) {
			case 0:
				$result = json_encode(array('status' => 'correct',
				'text' => parent::$ZIP_IS_CREATED,
				'values' => $pathText));
				break;

			case 1:
				$result = json_encode(array('status' => 'correct',
				'text' => parent::$ZIP_IS_NOT_CREATED,
				'values' => $errorText));
				break;
			
			default:
				# code...
				break;
		}

		return $result;
	}


	function ResultDb (int $errorCode,string $errorText=""){

		$result = null;
		
		switch ($errorCode) {
			case 1045:
				$result = json_encode(
					array ('status' => 'error',
						'text' => parent::$ERROR_DB_ACCESS,
						'value' => $errorText
				));
				break;

			case 1049:
				$result = json_encode(
					array ('status' => 'error',
						'text' => parent::$ERROR_DB_NOT_FOUND,
						'value' => $errorText
				));
				break;


			case 0:
			$result = json_encode(
				array ('status'=> 'correct'));
			break;
	
			default:
				return $result;
				break;
		}

		return $result;
	}
}

?>