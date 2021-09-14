<?php
include 'database.php';
require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';


// receives the 'someAction' value from the index page button.
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
{
	func();
}

function func()
{

	//calcul the number of folder in folder rdv
	$howManyFolder = count(glob('rdv/*', GLOB_ONLYDIR));

	$newest_file = "";
	//get the last file saved in one of the folders
	for ($i = 0; $i < $howManyFolder; $i++) {

		
		$files = scandir("rdv/100$i", SCANDIR_SORT_DESCENDING);

		
	
		echo "Recover all files in the folder 100" . $i . "<br>";
		print_r($files ); echo "<br>";
		echo "get the last file inserted in the folder at index 0 <br>";
		$newest_file = $files[0]; print_r($newest_file); echo "<br>";

		//give the path of the file
		$newest_file = dirname(__FILE__) . '/rdv/100' . $i . '/' . $newest_file;
		
		//load the file .xlsx 
		$objExcel=PHPExcel_IOFactory::load($newest_file);

		//get all value insinde the .xlsx file
		$dossier = $objExcel->getActiveSheet()->getCell('A3')->getValue();
		$facture = $objExcel->getActiveSheet()->getCell('B21')->getValue();
		$date = $objExcel->getActiveSheet()->getCell('Q1')->getValue(); //here is that value 41621 or 41631 ect... need convertion to date format
		
		//Excel date to gmdate
		$unix_date = ($date - 25569) * 86400;
		$date = 25569 + ($unix_date / 86400);
		$unix_date = ($date - 25569) * 86400;
		$unix_date = gmdate("Y-m-d", $unix_date);

	
		// echo "<br>";
		// echo " numero dossier "; print_r($dossier);
		// echo " numero facture "; print_r($facture);
		// echo " date "; print_r($unix_date);
		// echo "<br>";

		//call function to insert these values inside dataBase.
		insertInto($dossier, $facture, $unix_date);
	}
	header('Location: index.php?message=Successfully...!');
}		
?>




	//recupere tous les dossiers
	// $path = __DIR__ . DIRECTORY_SEPARATOR . "rdv/*";
	// $contents = glob($path, GLOB_ONLYDIR);
	// print_r($contents);

	// (A) OPEN FOLDER + READ ENTRIES -->

