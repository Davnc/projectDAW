<?php

function connectar (){
	$connect=mysqli_connect("localhost","root","","botiga");
	$connect->query("SET NAMES 'utf8'");
	return $connect;
}

function desconnectar ($connect){
	mysqli_close($connect);
}

function menuVertical(){
	
/* CATEGORIES PRINCIPALS */
$connexio=connectar();
$sqlcatpare='SELECT * FROM categoriapare';
if($rescategpare=$connexio->query($sqlcatpare)){

echo '<div class="box-content"><ul id="dropdown-menu" class="first-level">';
							
	while($fila=mysqli_fetch_array($rescategpare)){
		$idcatpare=$fila[0];
		$nomcatpare=$fila[1];

		echo '<li><a href="./productos.php?c='.$idcatpare.'" title="'.$nomcatpare.'">'.$nomcatpare.'</a>';

		/* CATEGORIA */
		$connexio=connectar();
		$sqlcategoria='SELECT * FROM categoria WHERE fk_pare='.$idcatpare;
		if($rescategoria=$connexio->query($sqlcategoria)){
			echo '<ul class="second-level">';
			while($fila2=mysqli_fetch_array($rescategoria)){
				$idcategoria=$fila2[0];
				$nomcategoria=$fila2[1];
				
				echo '<li><a href="./productos.php?c='.$idcatpare.'&cat='.$idcategoria.'" title="'.$nomcategoria.'">'.$nomcategoria.'</a></li>';
			}
			echo '</ul></li>';
		}
		else{
			echo "error a la connexio o consulta";
		}
		//desconnectar($connexio);
	}
echo '</ul></div>';

}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);
}




/* PAGINACIO ELEMENTS */
function paginacio($categoria, $total_results){

	
}

?>





