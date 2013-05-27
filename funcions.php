<?php
session_start();

function connectar (){
	$connect=mysqli_connect("localhost","root","","botiga");
	$connect->query("SET NAMES 'utf8'");
	return $connect;
}

function desconnectar ($connect){
	mysqli_close($connect);
}

function menuVertical(){

if(!isset($_GET['cat'])){$pcategoria="";}
else{$pcategoria=$_GET['cat'];}

/* CATEGORIES PRINCIPALS */
$connexio=connectar();
$sqlcatpare='SELECT * FROM categoriapare ORDER BY id_catpare';
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
				
				if($idcategoria==$pcategoria){
					echo '<li class="active"><a href="./productos.php?c='.$idcatpare.'&cat='.$idcategoria.'" title="'.$nomcategoria.'">'.$nomcategoria.'</a></li>';
				}
				else{
					echo '<li><a href="./productos.php?c='.$idcatpare.'&cat='.$idcategoria.'" title="'.$nomcategoria.'">'.$nomcategoria.'</a></li>';
				}
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




function totalItemsCarro(){
	if(isset($_SESSION['carrito'])){
		$idCarrito=$_SESSION['carrito'];
		$connexio=connectar();
		if($resultado = $connexio->query("SELECT SUM(quantitat) FROM liniacomanda WHERE fk_carro=".$_SESSION['carrito']." GROUP BY fk_carro")) {
			if($fila = $resultado->fetch_row()) {
				$total= $fila[0];
				desconnectar($connexio);
				return $total;
			}
			else
				return 0;
		}
	}
	else
	return 0;
}



function listProductsCarro(){
		$connexio=connectar();
		if($resultado = $connexio->query("SELECT fk_producte, SUM(quantitat) FROM liniacomanda WHERE fk_carro=".$_SESSION['carrito']." GROUP BY fk_carro, fk_producte")) {
?>
	<!-- Lista de productes del carrito -->
	<table>
	    <thead>
		      <tr>
		          <th><?php echo lang("IMAGE") ?></th>
		          <th><?php echo lang("PRODUCT") ?></th>
		          <th><?php echo lang("PRICE") ?></th>
		          <th><?php echo lang("QUANTITY") ?></th>
		          <th><?php echo lang("TOTAL") ?></th>
		          <th><?php echo lang("DISCOUNT") ?></th>
		          <th><?php echo lang("ACTION") ?></th>
		      </tr>
	    </thead>
	    <tbody>
<?php
			$total=0;
			while($fila = $resultado->fetch_row()) {
				$idproducte=$fila[0];
				$quantitat=$fila[1];
				
				$totalperitem=0;
				if($detallproducte = $connexio->query("SELECT preu, oferta FROM producte WHERE id_producte=".$idproducte)) {
					while($fila1 = $detallproducte->fetch_row()) {
						$oferta=$fila1[1];
						$preu=$fila1[0];
						$preuoferta=$preu-$preu*$oferta/100;
						$totalperitem+=$totalperitem+$preuoferta*$quantitat;
					}
				}
				
				if($detallproducte2 = $connexio->query("SELECT titol FROM descproducte WHERE id_prod=".$idproducte)) {
					while($fila2 = $detallproducte2->fetch_row()) {
						$titol=$fila2[0];
					}
				}
				
				if($detallproducte3 = $connexio->query("SELECT id_imatge, url FROM imatges WHERE fk_producte=".$idproducte." LIMIT 0,1")) {
					while($fila3 = $detallproducte3->fetch_row()) {
						$idimatge=$fila3[0];
						$url=$fila3[0].$fila3[1];
					}
				}
				$total+=$totalperitem;
				echo '<tr><td><a rel="prettyPhoto" href="images/gallery/'.$url.'" title="Ampliar"><img src="images/gallery/'.$url.'" height="50" alt="'.$titol.'" /></a></td><td><a href="./detalle_producto.php?p='.$idproducte.'" title="'.$titol.'">'.$titol.'</a></td>';
				if(!$oferta)
				echo '<td>'.$preuoferta.' &euro;</td><td>'.$quantitat.'</td><td>'.$totalperitem.' &euro;</td><td></td><td><a class="button delete" href="./accio.php?mode=del_item&p='.$idproducte.'"><span>'.lang("DELETE").'</span></a></td></tr>';
				else
				echo '<td><s>'.$preu.'</s> &euro; <br />'.$preuoferta.' &euro;</td><td>'.$quantitat.'</td><td>'.$totalperitem.' &euro;</td><td>'.$oferta.'%</td><td><a class="button delete" href="./accio.php?mode=del_item&p='.$idproducte.'"><span>'.lang("DELETE").'</span></a></td></tr>';
			}
			echo '<tr><td colspan="6">Total: '.$total.' &euro;</td><td><a class="button" href="./accio.php?mode=empty_cart">'.lang("EMPTY_CART").'</a> <a class="button" href="#">'.lang("CHECK_OUT").'</a></td></tr>';
			desconnectar($connexio);
?>
	    </tbody>
	 </table>
<?php
		}
}

?>