<?php
function insertInto($dossier, $facture, $date){

    $con = mysqli_connect('localhost','root','','rdv');
	if(mysqli_connect_errno()){echo 'Failed to connect to dataBase' .mysqli_connect_error();}

	$verifyDossier = "SELECT * FROM rdv WHERE dossier='$dossier'";
	$res = mysqli_query($con, $verifyDossier);
   
	if(mysqli_num_rows($res) < 1) {
		$insertqry= mysqli_query($con, "INSERT INTO `rdv`( `dossier`, `facture`, `date`) VALUES ('$dossier','$facture','$date')");	
	}	
};
?>