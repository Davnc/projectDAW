<?php

/*
if(!isset($_SESSION)){ 
    session_start(); 
}
*/

include_once("funcions.php");

//si no arriben parametres
/*
if(!isset($_GET['accio']) || $_GET['accio']!="" || !isset($_POST['enviar'])){
	echo 'falten parametres';
	//header("Location: admusuaris.php");
}
*/
if(isset($_GET['mode']))
$mode=$_GET['mode'];
else
$mode="";



if($mode=="login"){
	$email=$_POST["email"];
	$pass=sha1($_POST["password"]);
	$sql='SELECT login, passwd FROM login_user WHERE login="'.$email.'" AND passwd="'.$pass.'" AND actiu=1';
	$connexio=connectar();
	if($connexio->query($sql)){ //login correcte
		desconnectar($connexio);
		$_SESSION['sessio']=$login; //guardem en sessio el correu de l'usuari autenticat
		header("Location: index.php");
	}
	else{
		desconnectar($connexio);
		header("Location: index.php");
	}
}	
elseif($mode=="add_item"){
	$quantitat=0; //quantitat del producte seleccionat
	$idItem=0; //producte seleccionat
	if(!isset($_GET['quantitat'])) $quantitat=1;
	else $quantitat=$_GET['quantitat'];

	$idItem=$_GET["item"];
	
	//Si l'usuari no esta autenticat
	if(!isset($_SESSION['id_usuari'])){
		//afegim un nou usuari temporal
		$sql='INSERT INTO user_id VALUES("dummy")';
		$connexio=connectar();
		if($connexio->query($sql)){
			desconnectar($connexio);
			//obtenim el id de usuari que acabem de crear i creem la sessio amb el id d'usuari
			$connexio=connectar();
			if($resultado = $connexio->query("SELECT MAX(id) FROM user_id")) {
				if($fila = $resultado->fetch_row()) {
					$_SESSION['id_usuari']= $fila[0];
				}
			}
			desconnectar($connexio);
		}
	}
	//si es el primer producte primer creem el carrito
	if(!isset($_SESSION['carrito'])){
		$connexio=connectar();
		if($connexio->query("INSERT INTO carrito VALUES('dummy', NULL, NOW(), NULL, ".$_SESSION['id_usuari'].", NULL, NULL, NULL, NULL)")) {
			$_SESSION['carrito']=$connexio->insert_id; //obtenim el id del carrito que acabem de crear
		}
		desconnectar($connexio);
	}
	//afegim el producte a la linia de comanda
	$connexio=connectar();
	if($connexio->query("INSERT INTO liniacomanda VALUES('dummy', ".$quantitat.", ".$idItem.", ".$_SESSION['carrito'].")")) {
		desconnectar($connexio);
		//header('Location: ' . $_SERVER['HTTP_REFERER']); //tornem a la pagina on estavem
		header('Location: carrito.php?msg=1');
	}
	desconnectar($connexio);
}

elseif($mode=="del_item"){
	if(!isset($_GET['p']))
	$idItem=0;
	else
	$idItem=$_GET['p'];
	
	$connexio=connectar();
	if($connexio->query("DELETE FROM liniacomanda WHERE fk_producte=".$idItem)){
		desconnectar($connexio);
		header('Location: carrito.php?msg=2');
	}
	desconnectar($connexio);
}


elseif($mode=="empty_cart"){
	$connexio=connectar();
	if($connexio->query("DELETE FROM liniacomanda WHERE fk_carro=".$_SESSION['carrito'])){
		desconnectar($connexio);
		header('Location: carrito.php?msg=3');
	}
	desconnectar($connexio);
}



elseif($mode=="idioma"){
	$idioma=$_GET['lang'];
	$_SESSION['lang']=$idioma;
	header('Location: ' . $_SERVER['HTTP_REFERER']); //tornem a la pagina on estavem
}

?>