<?php
include 'database.php';

$uploadfile=$_FILES['file-upload-Solo']['tmp_name'];


require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);


//recucpere donné dans les cells 0,4 = A4
// $name  = $objExcel->getActiveSheet()->getCellByColumnAndRow(0, 3)->getValue();
// $email = $objExcel->getActiveSheet()->getCellByColumnAndRow(1, 3)->getValue();

//recupere la cell
$dossier = $objExcel->getActiveSheet()->getCell('A3')->getValue();
$facture = $objExcel->getActiveSheet()->getCell('B21')->getValue();
$date = $objExcel->getActiveSheet()->getCell('Q1')->getValue();

//Excel date to gmdate
$unix_date = ($date - 25569) * 86400;
$date = 25569 + ($unix_date / 86400);
$unix_date = ($date - 25569) * 86400;
$unix_date = gmdate("Y-m-d", $unix_date);

insertInto($dossier, $facture, $unix_date);
 



header('Location: index.php?message=Successfully...!');
?>
