<?php
ob_start();
require_once "../control/JsonR.php";

$jsonR = new JsonR (); 


$pathGet = $_GET['path'];


$pathZip = "../aset/compressed/".$pathGet.".zip";

// Get real path for our folder
$rootPath = realpath("../aset/pdf/".$pathGet);


// echo $rootPath;

// Initialize archive object
$zip = new ZipArchive();
$zip->open($pathZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();


if (file_exists($pathZip)){
	print_r($jsonR->ResultZip(0,$pathZip));

	// download file nya
}
else {
	print_r($jsonR->ResultZip(1,"","Gagal Membuat Zip"));
	// echo "Gagal membuat zip";
}



?>