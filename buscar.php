<?php
include_once("funcionsHTML.php");
include_once("funcions.php");
include_once("lang.php");

if(isset($_GET['query']) && $_GET['query']!=""){
	$cadena=$_GET['query'];
}
else{
	header('Location: ' . $_SERVER['HTTP_REFERER']); //tornem a la pagina on estavem
	$cadena="";
}

if($_SESSION['lang']=='es'){
	$idIdioma=1;
}
elseif($_SESSION['lang']=='ca'){
	$idIdioma=2;
}
elseif($_SESSION['lang']=='en'){
	$idIdioma=3;
}


/* NUMERO DE RESULTATS */
$connexio=connectar();

$sql='SELECT * FROM descproducte WHERE id_idioma='.$idIdioma.' AND (titol LIKE "%'.$cadena.'%" OR descripcio LIKE "%'.$cadena.'%")';
if($restotal=$connexio->query($sql)){
	if($filaid=mysqli_fetch_array($restotal)){
		$total_results = $filaid[0];
	}
	else{
		echo "error a la connexio o consulta";
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);



$sortidaProductes="";
/* CERCA PRODUCTES */
$connexio=connectar();
if($resultat=$connexio->query($sql)){
	while($row=mysqli_fetch_array($resultat)){
		$idprod=$row[0];
		$titol=$row[2];
		$descripcio=$row[3];
		
		
		$sql2='SELECT * FROM producte WHERE id_producte='.$idprod;
		$sql3='SELECT * FROM imatges WHERE fk_producte='.$idprod;
		
		/* INFORMACIO DEL PRODUCTE */
		if($resultat2=$connexio->query($sql2)){
			while($row2=mysqli_fetch_array($resultat2)){
				$preu=$row2[1];
				$stock=$row2[2];
				$pais=$row2[3];
				$anyfab=$row2[4];
				$marca=$row2[5];
				$oferta=$row2[6];
				$categoria=$row2[7];
			}
		}
		else{
			echo "error a la connexio o consulta";
		}


	  /* IMATGES DEL PRODUCTE */
		$sql3='SELECT * FROM imatges WHERE fk_producte='.$idprod;
		if($resultat3=$connexio->query($sql3)){
			if($row3=mysqli_fetch_array($resultat3)){ //nomes la primera imatge
				$id=$row3[0];
				$url=$row3[0].$row3[2];
			}
		}
		else{
			echo "error a la connexio o consulta";
		}
		if(!isset($titol)){
			$titol='<i>'.lang("INFO_NOT_AVAILABLE").'</i>';
		}
		if(!isset($url)){//si no hi ha imatge posem una per defecte
			$url="noimage.jpg";
		}
		$sortidaProductes .='<li class="item">
			<div class="title">'.$titol.'</div>
			<div class="image"><a href="./detalle_producto.php?p='.$idprod.'" title="Ver más información"><img src="images/gallery/'.$url.'" /></a></div>
			<div class="price">'.$preu.' &euro;<br /></div>
			<a class="add button" href="./accio.php?mode=add_item&item='.$idprod.'" title="'.lang("ADD_TO_CART").'"><span>'.lang("ADD_TO_CART").'</span></a>
			<a class="info button" href="./detalle_producto.php?p='.$idprod.'" title="'.lang("VIEW_MORE_INFO").'"><span>+info</span></a>
		</li>';
		














		
		//$sortida .= "<p><h2>".$titol."</h2>".$descripcio."</p>";
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);


capsalera();
menu(0);
cospag();
?>
<div id="breadcrums"><?php echo lang("YOU_ARE_HERE"); ?>: <a href="./" title="<?php echo lang("BACK_TO_INDEX"); ?>"><?php echo lang("HOME"); ?></a> &raquo; <?php echo lang('SEARCH'); ?></div>
<?php
carrito();
desplegable();
banner();
centercol();
?>
<h2><span><?php echo lang("SEARCH_RESULTS").' '.lang("FOR").': "'.$cadena.'"'; ?></span></h2>
<div id="product-list" class="box-content">
	<ul>
<?php
echo $sortidaProductes;
?>
	<div class="clear"></div>
	</ul>
	
							<!-- pagination -->
							<div id="pagination">
								<ul>
<?php
echo $pagination;
?>
									<div class="clear"></div>
								</ul>
							</div>
							<!--/ pagination-->
	</div>
</div>
<?php
cospaginatanca();
peu();

/* jQuerys */
jQuery();
prettyPhoto();
jQLogin();
jQDesplegable(0);
jQueryTanca();

peutanca();
?>
