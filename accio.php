<?php
session_start();
include_once("funcions.php");

//si no arriben parametres
if(!isset($_GET['accio']) || $_GET['accio']!="" || !isset($_POST['enviar'])){
	echo 'falten parametres';
	//header("Location: admusuaris.php");
}

if($mode=="login"){
	$email=$_POST["email"];
	$pass=sha1($_POST["password"]);
	$sql='SELECT login, passwd FROM login_user WHERE login="'.$email.'" AND passwd="'.$pass.'" AND actiu=1';
	$connexio=connectar();
	if($connexio->query($sql)){
		//correcte
		desconnectar($connexio);
		$_SESSION['sessio']=$login; //guardem en sessio el correu de l'usuari autenticat
		header("Location: index.php");
	}
	else{
		//incorrecte
		desconnectar($connexio);
		header("Location: index.php");
	}
}	

?>