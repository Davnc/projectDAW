<?php
//Recollida de parametres
if(!isset($_GET['c'])){
	header("Location: index.php");
}

$catpare=$_GET['c'];

if(!isset($_GET['cat'])){
	$categoria=false;
}
else{
	$categoria=$_GET['cat'];
}

if(!isset($_GET['pag']) || $_GET['pag']=='' || $_GET['pag']==0){
	$numpag=1;
}
else{
	$numpag=$_GET['pag']; //numero de pagina
}

include_once("funcionsHTML.php");
include_once("funcions.php");


/* INFORMACIO DE LA CATEGORIA PARE */
$connexio=connectar();
$sqlcatpare='SELECT * FROM categoriapare WHERE id_catpare='.$catpare;
if($rescategpare=$connexio->query($sqlcatpare)){
	while($reg=mysqli_fetch_array($rescategpare)){
		$nomcatpare=$reg[1];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);

/* INFORMACIO DE LA CATEGORIA */
if(!$categoria){
}
else{
$connexio=connectar();
$sqlcat='SELECT * FROM categoria WHERE id_cat='.$categoria;
if($rescategpare=$connexio->query($sqlcat)){
	while($reg=mysqli_fetch_array($rescategpare)){
		$nomcat=$reg[1];
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);
}




/* NUMERO DE RESULTATS */
$connexio=connectar();
if(!$categoria){
	$query = 'SELECT COUNT(*) FROM producte WHERE fk_categoria IN(SELECT id_cat FROM categoria WHERE fk_pare='.$catpare.')';
}
else{
	$query = 'SELECT COUNT(*) FROM producte WHERE fk_categoria='.$categoria;
}

if($restotal=$connexio->query($query)){
	if($row=mysqli_fetch_array($restotal)){
		$total_results = $row[0];
	}
	else{
		echo "error a la connexio o consulta";
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);



$adjacents = 3;//num de pagines adjacents
$desti = "productos.php";
$limit = 9;//elements per pagina
if($numpag) 
	$start = ($numpag - 1) * $limit;//primer item
else
	$start = 0;//si no sespecifica el numero de pagina establim a 0




/* LLISTAT PRODUCTES SEGONS CATEGORIA */
$sortidaProductes="";
$connexio=connectar();
if(!$categoria){ //si no hi ha categoria mostrem tots els que pertanyen a la categoria pare
	$sql='SELECT * FROM producte WHERE fk_categoria IN(SELECT id_cat FROM categoria WHERE fk_pare='.$catpare.')';
}
else{
	$sql='SELECT * FROM producte WHERE fk_categoria='.$categoria;
}
$sql .=' LIMIT '.$start.','.$limit;

if($resultat=$connexio->query($sql))
{
	if($resultat->num_rows>0){
		while($fila=mysqli_fetch_array($resultat))
		{
			$idProd=$fila[0];
			$preu=$fila[1];
			$stock=$fila[2];
			$pais=$fila[3];
			$anyfab=$fila[4];
			$marca=$fila[5];
			$oferta=$fila[6];
		   
			/* DESCRIPCIO DEL PRODUCTE */
			$sql2='SELECT * FROM descproducte WHERE id_prod='.$idProd;
			if($resultat2=$connexio->query($sql2)){
				while($fila2=mysqli_fetch_array($resultat2)){
					$nomprod=$fila2[2];
					$descripcio=$fila2[3];
				}
			}
			else{
				echo "error a la connexio o consulta";
			}
	
	
		  /* IMATGES DEL PRODUCTE */
			$sql3='SELECT * FROM imatges WHERE fk_producte='.$idProd;
			if($resultat3=$connexio->query($sql3)){
				if($fila3=mysqli_fetch_array($resultat3)){ //nomes la primera imatge
					$id=$fila3[0];
					$url=$fila3[0].$fila3[2];
				}
			}
			else{
				echo "error a la connexio o consulta";
			}
			if(!isset($nomprod)){
				$nomprod='<i>'.lang("INFO_NOT_AVAILABLE").'</i>';
			}
			if(!isset($url)){//si no hi ha imatge posem una per defecte
				$url="noimage.jpg";
			}
			$sortidaProductes .='<li class="item">
				<div class="title">'.$nomprod.'</div>
				<div class="image"><a href="./detalle_producto.php?p='.$idProd.'" title="Ver más información"><img src="images/gallery/'.$url.'" /></a></div>
				<div class="price">'.$preu.' &euro;<br /></div>
				<a class="add button" href="./accio.php?mode=add_item&item='.$idProd.'" title="'.lang("ADD_TO_CART").'"><span>'.lang("ADD_TO_CART").'</span></a>
				<a class="info button" href="./detalle_producto.php?p='.$idProd.'" title="'.lang("VIEW_MORE_INFO").'"><span>+info</span></a>
			</li>';
		}
	}
	else{ //no hi ha resultats
		$sortidaProductes='<li><span class="info">'.lang("PRODUCTS_NOT_AVAILABLE_FOR_THIS_CATEGORY").'</span></li>';
	}
	
}
else
{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);


/* PAGINACIO */

	if ($numpag == 0) $numpag = 1;//si el numero de pagina es 0 el posem a 1
	$prev = $numpag - 1;//pagina anterior
	$next = $numpag + 1;//pagina seguent
	$lastpage = ceil($total_results/$limit);//numero maxim de pagines
	$lpm1 = $lastpage - 1;//darrera pagina menys 1
	$pagination = "";

	if($lastpage > 1){	
		//Boto Anterior
		if ($numpag > 1) 
			$pagination.= '<li class="prev"><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$prev.'">&laquo; '.lang("PREV").'</a></li>';
		else
			$pagination.= '<li class="prev disabled">&laquo; '.lang("PREV").'</li>';	
		
		//Pagines
		if ($lastpage < 7 + ($adjacents * 2)){	//not enough pages to bother breaking it up	
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if ($counter == $numpag)
					$pagination.= '<li class="active">'.$counter.'</li>';
				else
					$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2)){	//enough pages to hide some
			//close to beginning; only hide later pages
			if($numpag < 1 + ($adjacents * 2)){
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
				}
				$pagination.= '<li><a href="#">...</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $numpag && $numpag > ($adjacents * 2)){
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag=1">1</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag=2">2</a></li>';
				$pagination.= '<li><a href="#">...</a></li>';
				for ($counter = $numpag - $adjacents; $counter <= $numpag + $adjacents; $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
				}
				$pagination.= '<li><a href="#">...</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			//close to end; only hide early pages
			else{
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag=1">1</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag=2">2</a>';
				$pagination.= '<li><a href="#">...</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
				}
			}
		}
		
		//Boto Seguent
		if ($numpag < $counter - 1) 
			$pagination.= '<li class="next"><a href="'.$desti.'?c='.$catpare.'&cat='.$categoria.'&pag='.$next.'">'.lang("NEXT").' &raquo;</a></li>';
		else
			$pagination.= '<li class="next disabled">'.lang("NEXT").' &raquo;</li>';
	
	}
	
	
	
	
capsalera();
menu($catpare);
cospag();


if(!$categoria){
	echo '<div id="breadcrums">'.lang("YOU_ARE_HERE").': <a href="./" title="'.lang("BACK_TO_INDEX").'">'.lang("HOME").'</a> &raquo; '.$nomcatpare.'</div>';
}
else{
	echo '<div id="breadcrums">'.lang("YOU_ARE_HERE").': <a href="./" title="'.lang("BACK_TO_INDEX").'">'.lang("HOME").'</a> &raquo; <a href="./productos.php?c='.$catpare.'" title="'.$nomcatpare.'">'.$nomcatpare.'</a> &raquo; '.$nomcat.'</div>';
}
carrito();
desplegable();
banner();
centercol();
?>
<h2><span>
	<?php if(!$categoria){echo $nomcatpare;}else{echo $nomcat;}?>
</span></h2>
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
//peu
peu();

/* jQuerys */
jQuery();
prettyPhoto();
jQLogin();
jQDesplegable($catpare);
jQueryTanca();

peutanca();
?>
