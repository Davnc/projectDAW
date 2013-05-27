<?php
include_once("funcionsHTML.php");
include_once("funcions.php");


$idproducto=$_GET['p'];


/* INFORMACIO DEL PRODUCTE */
$connexio=connectar();
$sqlproducte='SELECT * FROM producte WHERE id_producte='.$idproducto;
if($resprod=$connexio->query($sqlproducte)){
	while($fila1=mysqli_fetch_array($resprod)){
		$idProd=$fila1[0];
		$preu=$fila1[1];
		$idcategoria=$fila1[7];
		$idsubcategoria=$fila1[8];
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


/* INFORMACIO DE LA CATEGORIA */
$connexio=connectar();
$sqlcat='SELECT * FROM categoria WHERE id_cat='.$idcategoria;
if($rescateg=$connexio->query($sqlcat)){
	while($reg1=mysqli_fetch_array($rescateg)){
		$nomcat=$reg1[1];
		$idcatpare=$reg1[2];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);



/* INFORMACIO DE LA CATEGORIA PARE */
$connexio=connectar();
$sqlcatpare='SELECT nom FROM categoriapare WHERE id_catpare='.$idcatpare;
if($rescategpare=$connexio->query($sqlcatpare)){
	while($reg2=mysqli_fetch_array($rescategpare)){
		$nomcatpare=$reg2[0];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);





capsalera();
menu($idcatpare);
cospag();
?>	
				<div id="breadcrums"><?php echo lang("YOU_ARE_HERE"); ?>: 
					<a href="./" title="<?php echo lang("BACK_TO_INDEX"); ?>"><?php echo lang("HOME"); ?></a> &raquo; 
					<a href="./productos.php?c=<?php echo $idcatpare; ?>" title="<?php echo $nomcatpare; ?>"><?php echo $nomcatpare; ?></a> &raquo; 
					<a href="./productos.php?c=<?php echo $idcatpare; ?>&cat=<?php echo $idcategoria; ?>" title="<?php echo $nomcat; ?>"><?php echo $nomcat; ?></a> &raquo; 
					<?php echo $nomProd; ?></div>
<?php
botonera();
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
								<form id="actions-cart" method="GET" action="accio.php">
									<input type="hidden" name="mode" value="add_item" />
									<input type="hidden" name="item" value="<?php echo $idproducto; ?>" />
									<input type="text" class="quantity field" name="quantitat" value="1" size="3" maxlength="3" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
									<button type="submit" class="button add"><span><?php echo lang("ADD_TO_CART"); ?></span></button>
								</form>
								<div class="clear"></div>
							</div>
						</div>
					</div>

					<div id="description" class="box">
						<h3><span><?php echo lang("PRODUCT_DESC"); ?></span></h3>
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
jQDesplegable($idcatpare);
jQSlides();
jQueryTanca();

peutanca();
?>