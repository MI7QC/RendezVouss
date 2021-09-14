<?php
include 'database.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];


require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);


//recucpere donné dans les cells 0,4 = A4
// $name  = $objExcel->getActiveSheet()->getCellByColumnAndRow(0, 3)->getValue();
// $email = $objExcel->getActiveSheet()->getCellByColumnAndRow(1, 3)->getValue();

//recupere la cell
$name = $objExcel->getActiveSheet()->getCell('A1')->getValue();
$email = $objExcel->getActiveSheet()->getCell('B1')->getValue();



 $insertqry="INSERT INTO `user`( `username`, `email`) VALUES ('$name','$email')";
 $insertres=mysqli_query($con,$insertqry);



header('Location: index.php?message=Successfully...!');
?>
