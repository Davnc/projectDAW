<?php
include_once("funcionsHTML.php");
include_once("funcions.php");

/*
if(!isset($_GET['c']) && $_GET['c']==''){
	header("Location: index.php");
}
else{
	$categoria=$_GET['c'];
}
*/
$categoria=$_GET['c'];
$producto=$_GET['p'];

/* INFORMACIO DE LA CATEGORIA PARE */
$connexio=connectar();
$sqlcatpare='SELECT * FROM categoriapare WHERE id_catpare='.$categoria;
if($rescategpare=$connexio->query($sqlcatpare)){
	while($reg=mysqli_fetch_array($rescategpare)){
		$nomCat=$reg[1];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);

/* INFORMACIO DEL PRODUCTE */
$connexio=connectar();
$sqlproducte='SELECT * FROM producte WHERE id_producte='.$producto;
if($resprod=$connexio->query($sqlproducte)){
	while($fila1=mysqli_fetch_array($resprod)){
		$idProd=$fila1[0];
		$preu=$fila1[1];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);

/* DESCRIPCIO DEL PRODUCTE */
$connexio=connectar();
$sql2='SELECT * FROM descproducte WHERE id_prod='.$idProd;
if($resultat2=$connexio->query($sql2)){
	while($fila2=mysqli_fetch_array($resultat2)){
		$nomProd=$fila2[2];
		$descripcio=$fila2[3];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);



capsalera();
menu($categoria);
cospag();
?>	
				<div id="breadcrums">Est&aacute;s aqu&iacute;: <a href="./" title="Volver al Inicio">Inicio</a> &raquo; <a href="./productos.php?c=<?php echo $categoria;?>" title="<?php echo $nomCat?>"><?php echo $nomCat;?></a> &raquo; <?php echo $nomProd;?></div>
<?php
//Columna Esquerra
desplegable();
banner();

//Columna Central
centercolb();
?>
						<h2><span><?php echo $nomProd;?></span></h2>
						<div id="products" class="box-content">
							<div class="slides_container">
							
							
<?php
/* IMATGES DEL PRODUCTE */
$sql3='SELECT * FROM imatges WHERE fk_producte='.$idProd;
$connexio=connectar();
if($resultat3=$connexio->query($sql3)){
	while($fila3=mysqli_fetch_array($resultat3)){
		$id=$fila3[0];
		$url=$fila3[0].$fila3[2];
		
		echo '<a rel="prettyPhoto[gal]" href="images/gallery/'.$url.'"><img src="images/gallery/'.$url.'" width="200" alt="'.$nomProd.'" /></a>';
	}
	echo '</div>';
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);

$connexio=connectar();
if($resultat3=$connexio->query($sql3)){
	echo '<ul class="pagination">';
	while($fila3=mysqli_fetch_array($resultat3)){
		$id=$fila3[0];
		$url=$fila3[0].$fila3[2];
		
		echo '<li><a href="#"><img src="images/gallery/'.$url.'" width="50" alt="'.$nomProd.'"></a></li>';
	}
	echo '</ul>';
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);
?>
							<div class="clear"></div>
							<div class="details">
								<div class="price">
									<span><?php echo $preu;?> &euro;</span><br />*IVA incluido
								</div>
								<form id="actions-cart">
									<input type="text" class="quantity field" name="quantity" value="1" size="3" maxlength="3" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
									<a href="#" class="button add"><span>Añadir al carro</span></a>
								</form>
								<div class="clear"></div>
							</div>
						</div>
					</div>

					<div id="description" class="box">
						<h3><span>Descripción del producto</span></h3>
						<div class="box-content">
						<?php echo $descripcio;?>
					</div>
<?php
centercoltanca();

//Columna Dreta
columnadreta();
cospagtanca();
cospaginabtanca();

peu();

/*jQuerys */
jQuery();
prettyPhoto();
jQLogin();
jQDesplegable($categoria);
jQSlides();
jQueryTanca();

peutanca();
?>