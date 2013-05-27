<?php
include_once("funcionsHTML.php");
include_once("funcions.php");


/* OFERTES DESTACADES */
$connexio=connectar();
$sql='SELECT * FROM producte WHERE oferta>0 ORDER BY oferta DESC LIMIT 0,15';
if($resultat=$connexio->query($sql)){
	$ofertesresult="";
	while($fila1=mysqli_fetch_array($resultat)){
		$idproducte=$fila1[0];
		$preu=$fila1[1];
		$stock=$fila1[2];
		$preu=$fila1[6];
		
		$ofertesresult.='<li class="item"><div class="title">'.$idproducte.'</div></li>';
	}
}
else{
	echo "error a la connexio o consulta";
}
desconnectar($connexio);

















//capçalera
capsalera();
//menu principal
menu(0);
cospag();
?>
<div id="breadcrums"><?php echo lang('YOU_ARE_HERE'); ?>: <?php echo lang('HOME'); ?></div>
<?php
botonera();
//desplegable dels productes
desplegable();
//banner
banner();
//cos
centercol();
?>

						<h2><span><?php echo lang('OUTSTANDING_OFFERS'); ?></span></h2>
						<div id="product-list" class="box-content">
							<ul>
<?php
echo $ofertesresult;
?>
								<div class="clear"></div>
							</ul>
						<!--
							<ul>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<div class="clear"></div>
							</ul>
							-->
						</div>
					</div>
					
					<div id="description" class="box">
						<h3><span><?php echo lang('MOST_SOLD'); ?></span></h3>
						<div id="product-list" class="box-content">
						<!--
							<ul>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<li class="item">
									<div class="title">Logitech B110 optical USB mouse negro</div>
									<div class="image"><a href="./logitechb110.html" title="Ver más información"><img src="images/gallery/logitech-b110-negro.png" /></a></div>
									<div class="price">6.95 €<br /></div>
									<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
									<a class="info button" href="./logitechb110.html" title="Ver más información"><span>+info</span></a>
								</li>
								<div class="clear"></div>
							</ul>
						-->
						</div>
					</div>
<?php
cospaginatanca();
//peu
peu();

/* jQuerys */
jQuery();
jQLogin();
jQDesplegable(0);
jQueryTanca();

peutanca();
?>
