<?php
include 'database.php';
require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$dt = new DateTime("now", new DateTimeZone('America/New_York'));

echo $dt->format('m/d/Y, H:i:s');

// receives the 'someAction' value from the index page button.
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
{
	func();
}

function func()
{
	//get the path to folder rdv
	$somePath = dirname(__FILE__) . '\rdv';
	//get all folder inside folder rdv
	$directories = glob($somePath . '\*' , GLOB_ONLYDIR);

	foreach ($directories as $t) {
		//retrieve the last folder name of the path
		$folderName = str_replace(dirname(__FILE__) . '\rdv\\', '', $t);
		//get only the name of each folder inside the path
		$files = scandir("rdv/" . $folderName, SCANDIR_SORT_DESCENDING);
		//get the last file inserted in the folder at index 0
		$newest_file = $files[0]; 
		//give the path of the file
		$newest_file = dirname(__FILE__) . '/rdv' . '/' . $folderName . '/' . $newest_file;
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
		//call function to insert data inside database
		insertInto($dossier, $facture, $unix_date);	
	}
	header('Location: index.php?message=Successfully...!');
}		
?>

