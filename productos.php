<?php
include_once("funcionsHTML.php");
include_once("funcions.php");

/*
if(!isset($_GET['c']) || $_GET['c']==''){
	header("Location: index.php");
}
else{
	$categoria=$_GET['c'];
}
*/
$categoria=$_GET['c'];


if(!isset($_GET['pag']) || $_GET['pag']=='' || $_GET['pag']==0){
	$numpag=1;
}
else{
	$numpag=$_GET['pag']; //numero de pagina
}



/* TOTAL DE RESULTATS */
$connexio=connectar();
$query = "SELECT COUNT(*) FROM producte WHERE fk_categoria=".$categoria;
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


	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	$desti = "productos.php"; 	//your file name  (the name of this file)
	$limit = 9; 								//how many items to show per page
	if($numpag) 
		$start = ($numpag - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
		
		
	/* Setup page vars for display. */
	if ($numpag == 0) $numpag = 1;					//if no page var is given, default to 1.
	$prev = $numpag - 1;							//previous page is page - 1
	$next = $numpag + 1;							//next page is page + 1
	$lastpage = ceil($total_results/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1


	$pagination = "";
	if($lastpage > 1)
	{	
		//Boto Anterior
		if ($numpag > 1) 
			$pagination.= '<li class="prev"><a href="'.$desti.'?c='.$categoria.'&pag='.$prev.'">&laquo; Anterior</a></li>';
		else
			$pagination.= '<li class="prev disabled">&laquo; Anterior</li>';	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $numpag)
					$pagination.= '<li class="active">'.$counter.'</li>';
				else
					$pagination.= '<li><a href="'.$desti.'?c='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($numpag < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'?c='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
				}
				$pagination.= '...';
				$pagination.= '<li><a href="'.$desti.'?c='.$categoria.'&pag='.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$desti.'?c='.$categoria.'&pag='.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $numpag && $numpag > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=1\">1</a>";
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=2\">2</a>";
				$pagination.= "...";
				for ($counter = $numpag - $adjacents; $counter <= $numpag + $adjacents; $counter++)
				{
					if ($counter == $numpag)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=1\">1</a>";
				$pagination.= "<a href=\"$desti?c='.$categoria.'&pag=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $numpag)
						$pagination.= '<li class="active">'.$counter.'</li>';
					else
						$pagination.= '<li><a href="'.$desti.'?c='.$categoria.'&pag='.$counter.'">'.$counter.'</a></li>';					
				}
			}
		}
		
		//Boto Seguent
		if ($numpag < $counter - 1) 
			$pagination.= '<li class="next"><a href="'.$desti.'?c='.$categoria.'&pag='.$next.'">Siguiente &raquo;</a></li>';
		else
			$pagination.= '<li class="next disabled">Siguiente &raquo;</li>';
		$pagination.= "</div>\n";		
	}
	






//capçalera
capsalera();
//menu principal
menu($categoria);
cospag();

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
?>
<div id="breadcrums">Est&aacute;s aqu&iacute;: <a href="./" title="Volver al Inicio">Inicio</a> &raquo; <?php echo $nomCat;?></div>
<?php
//desplegable dels productes
desplegable();
//banner
banner();
//cos
centercol();
?>
<h2><span><?php echo $nomCat;?></span></h2>
<div id="product-list" class="box-content">
	<ul>
<?php

/* LLISTAT PRODUCTES SEGONS CATEGORIA */
$connexio=connectar();
$sql='SELECT * FROM producte WHERE fk_categoria='.$categoria.' LIMIT '.$start.','.$limit;

if($resultat=$connexio->query($sql))
{

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
			}
		}
		else{
			echo "error a la connexio o consulta";
		}
		
		
		echo '<li class="item">
			<div class="title">'.$fila2[2].'</div>
			<div class="image"><a href="./detalle_producto.php?c='.$categoria.'&p='.$idProd.'" title="Ver más información"><img src="images/gallery/'.$fila3[0].$fila3[2].'" /></a></div>
			<div class="price">'.$preu.' €<br /></div>
			<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
			<a class="info button" href="./detalle_producto.php?c='.$categoria.'&p='.$idProd.'" title="Ver más información"><span>+info</span></a>
		</li>';
	}
	
}
else
{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);
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
							
							
							
							<!-- pagination -->
<!--
							<div id="pagination">
								<ul>
									<li class="prev disabled">« Anterior</li>
									<li class="active">1</li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li class="next"><a href="#">Siguiente »</a></li>
									<div class="clear"></div>
								</ul>
							</div>
-->
							<!--/ pagination-->
	</div>
</div>
<?php
cospaginatanca();
//peu
peu();
jquery();
peutanca();
?>
