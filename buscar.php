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

if(!isset($_GET['pag']) || $_GET['pag']=='' || $_GET['pag']==0){
	$numpag=1;
}
else{
	$numpag=$_GET['pag']; //numero de pagina
}


/* NUMERO DE RESULTATS */
$connexio=connectar();

$sqlTotal='SELECT COUNT(*) FROM descproducte WHERE id_idioma='.$idIdioma.' AND (titol LIKE "%'.$cadena.'%" OR descripcio LIKE "%'.$cadena.'%")';
if($restotal=$connexio->query($sqlTotal)){
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




$adjacents = 3;//num de pagines adjacents
$desti = "buscar.php?query=".$cadena."&";
$limit = 9;//elements per pagina
if($numpag) 
	$start = ($numpag - 1) * $limit;//primer item
else
	$start = 0;//si no sespecifica el numero de pagina establim a 0





$sortidaProductes="";
/* CERCA PRODUCTES */
$sql='SELECT * FROM descproducte WHERE id_idioma='.$idIdioma.' AND (titol LIKE "%'.$cadena.'%" OR descripcio LIKE "%'.$cadena.'%") LIMIT '.$start.','.$limit;
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
			<div class="image"><a href="./detalle_producto.php?p='.$idprod.'" title="'.lang("VIEW_MORE_INFO").'"><img src="images/gallery/'.$url.'" /></a></div>
			<div class="price">'.$preu.' &euro;<br /></div>
			<a class="add button" href="./accio.php?mode=add_item&item='.$idprod.'" title="'.lang("ADD_TO_CART").'"><span>'.lang("ADD_TO_CART").'</span></a>
			<a class="info button" href="./detalle_producto.php?p='.$idprod.'" title="'.lang("VIEW_MORE_INFO").'"><span>+info</span></a>
		</li>';
		
		//$sortida .= "<p><h2>".$titol."</h2>".$descripcio."</p>";
	}
	
	
	
	
	
	
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
			$pagination.= '<li class="prev"><a href="'.$desti.'pag='.$prev.'">&laquo; '.lang("PREV").'</a></li>';
		else
			$pagination.= '<li class="prev disabled">&laquo; '.lang("PREV").'</li>';	
		
		//Pagines
		if ($lastpage < 7 + ($adjacents * 2)){	//not enough pages to bother breaking it up	
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if ($counter == $numpag)
					$pagination.= '<li class="active">'.$counter.'</li>';
				else
					$pagination.= '<li><a href="'.$desti.'pag='.$counter.'">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2)){	//enough pages to hide some
			//close to beginning; only hide later pages
			if($numpag < 1 + ($adjacents * 2)){
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'pag='.$counter.'">'.$counter.'</a></li>';					
				}
				$pagination.= '<li><a href="#">...</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag='.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag='.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $numpag && $numpag > ($adjacents * 2)){
				$pagination.= '<li><a href="'.$desti.'pag=1">1</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag=2">2</a></li>';
				$pagination.= '<li><a href="#">...</a></li>';
				for ($counter = $numpag - $adjacents; $counter <= $numpag + $adjacents; $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'pag='.$counter.'">'.$counter.'</a></li>';					
				}
				$pagination.= '<li><a href="#">...</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag='.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag='.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			//close to end; only hide early pages
			else{
				$pagination.= '<li><a href="'.$desti.'pag=1">1</a></li>';
				$pagination.= '<li><a href="'.$desti.'pag=2">2</a>';
				$pagination.= '<li><a href="#">...</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'pag='.$counter.'">'.$counter.'</a></li>';					
				}
			}
		}
		
		//Boto Seguent
		if ($numpag < $counter - 1) 
			$pagination.= '<li class="next"><a href="'.$desti.'pag='.$next.'">'.lang("NEXT").' &raquo;</a></li>';
		else
			$pagination.= '<li class="next disabled">'.lang("NEXT").' &raquo;</li>';
	
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
<div id="breadcrums"><?php echo lang("YOU_ARE_HERE"); ?>: <a href="./" title="<?php echo lang("BACK_TO_INDEX"); ?>"><?php echo lang("HOME"); ?></a> &raquo; <?php echo lang('SEARCH_RESULTS'); ?></div>
<?php
botonera();
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
