<?php
require_once "control/CSVControl.php";
require_once "control/JsonR.php";
require_once "control/DbControl.php";


/*----------Test Unit --------------*/
// $file = "aset/uploaded/another2.csv";
// $fileName = "add-072-2021.csv"; // dirubah sesukanya

/*----------Production --------------*/
$file = "aset/uploaded/".$_GET['path'];
$fileName = $_GET['file-name'];



$csvControl = new CSVControl($file,$fileName);


$delimiters = array('coma' => ",",
	'semiCollon' => ";",
	'pipe' => "|"
 );
$choosenDelimiter = ","; // default


// $handle = fopen($file,"r"); 

$matrix = array();


// check delimiter from csv file
foreach ($delimiters as $key ) {
	$csvControl->open();
	// Only 1st row
	$firstRow = fgetcsv($csvControl->getFileOpen(),1000,$key);

	if($csvControl->findDelimiter ($firstRow,$key)){
		$choosenDelimiter = $csvControl->delimiter;
		$csvControl->close();
		break;
	}
	else {
		$csvControl->close();
	}
	

}


/*------------ Unit Test -----------------*/
// echo "The delimiter is ".$choosenDelimiter;
// die();
/*------------ Unit Test -----------------*/




// Jika delimiter sudah ketemu makan pakai delimiter tersebut
while (($row = fgetcsv($csvControl->getFileOpen(), 1000, $choosenDelimiter)) !== FALSE)
{

	if (!$csvControl->isCodeValid($row)){
		// Jika ada kode yang tidak valid maka akan break dan akan berhenti loop
		break;
	}

	$matrix[] = $row;
}

$jsonResult = new JsonR ();

// jika tidak ada data yang sinkron antara semua row dan row valid kode maka berhenti die();
if ($csvControl->isSumRowValid()){

	// Jika berhasil maka return json encode
	$result = $jsonResult->ResultCsv(0,$csvControl->getTrueLine (),$matrix);
	print_r ($result);
}
else {
	echo $jsonResult->ResultCsv(1,$csvControl->getErrorFile ());
	die();
}

// print_r ($matrix);


?>