<?php
include_once("funcions.php");

//capsalera
function capsalera(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Innovate PC</title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
</head>
<body>
	<div id="container">
		<!-- Precapcalera -->
		<div id="header-wrapper-top">
			<div id="header-top">
				<div id="user-access">
					<div class="register-btn"><a href="#" title="Registrarse">Registrarse</a></div>
					<div class="login-btn"><a href="#" title="Identificarse">Identificarse</a></div>
					<div class="clear"></div>
					<div id="login-dropdown">
						<form name="login" action="accio.php?accio=login" method="POST">
							<label for="email">E-mail:</label>
							<input name="email" class="field" /><br />
							<label for="password">Contrase&ntilde;a:</label>
							<input name="password" class="field" type="password" />
							<div class="rememberme"><a href="registrar.php">Registrarse</a></div>
							<input type="submit" name="enviar" class="submit button" value="Identif&iacute;cate" />
							<div class="clear"></div>
						</form>
					</div>
				</div>
				<div id="languages">
					<ul>
						<!--<li><a class="ca" href="#" title="Catal&aacute;"><span>CA</span></a></li>-->
						<li><a class="es" href="#" title="Espa&ntilde;ol"><span>ES</span></a></li>
						<!--<li><a class="en" href="#" title="English"><span>EN</span></a></li>-->
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- Capcalera -->
		<div id="header-wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="./" title="Volver al Inicio"><img src="images/logo.png" alt="Innovate PC" /><span class="ocult">Innovate PC</span></a></h1>
				</div>
				<div id="rightheader">
					<div id="searchbox">
						<form name="searchbox" action="#">
							<label for="cercar" class="ocult">Buscar</label>
							<input id="search" class="box" type="text" value="Buscar..." onblur="if(this.value=='') this.value='Buscar...';" onfocus="if(this.value=='Buscar...') this.value='';" />
							<input name="cercar" type="image" class="search" src="images/search.gif" />
						</form>
					</div>
					<div id="social-links">
						<a class="fb-ico" title="Facebook" href="Facebook">Facebook</a>
						<a class="tw-ico" title="Twitter" href="Twitter">Twitter</a>
						<a class="rss-ico" title="RSS" href="RSS">RSS</a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
<?php
}
function menu($pagina){
	$pagines=array("","","","","","");
	$pagines[$pagina]="active";
?>
		<!-- Menu -->
		<div id="menu-wrapper">
			<div id="menu-navigation">
				<div id="menu">
					<ul>
						<li class="<?php echo $pagines[0];?>"><a href="./" title="Volver al Inicio">Inicio</a></li>
<?php	
	/* LLISTAT MENU PRINCIPAL */
	$connexio=connectar();
	$sql="SELECT * FROM categoriapare ORDER BY id_catpare LIMIT 0,5";
	
	if($resultat=$connexio->query($sql))
	{
		$i=1;
		while($fila=mysqli_fetch_array($resultat))
		{
		   $id=$fila[0];
		   $nom=$fila[1];
		   echo '<li class="'.$pagines[$i].'"><a href="productos.php?c='.$id.'" title="'.$nom.'">'.$nom.'</a></li>';
		   $i++;
		}
		
	}
	else
	{
		echo "error a la connexio o consulta";
	}
	desconnectar($connexio);
?>				
						
					</ul>
				</div>
			</div>
		</div>
<?php
}
function cospag(){
?>
		<!-- Cos -->
		<div id="content-wrapper">
			<div id="content">
<?php
}

function cospagtanca(){
?>
				<div class="clear"></div>
			</div>
		</div>
<?php
}

function desplegable(){
?>
				<!-- Col1 -->
				<div id="leftCol">
					<div id="secondLevelMenu" class="box">
						<h3><span>Productos</span></h3>
						<?php menuVertical(); ?>
					</div>
<?php
}
function banner(){
?>
					<div class="box">
						<h3><span>Banners</span></h2>
						<div class="box-content">
							<a href="#" style="color:white;text-decoration:none;"><div style="background-color:#75B2DD;text-align:center;padding:45px 0px;height:10px;margin-bottom:20px;">Banner (198px x 100px)</div></a>
							<a href="#" style="color:white;text-decoration:none;"><div style="background-color:#75B2DD;text-align:center;padding:45px 0px;height:10px;margin-bottom:20px;">Banner (198px x 100px)</div></a>
							<a href="#" style="color:white;text-decoration:none;"><div style="background-color:#75B2DD;text-align:center;padding:45px 0px;height:10px;margin-bottom:20px;">Banner (198px x 100px)</div></a>
						</div>
					</div>
				</div>
<?php
}

//columna de 740px
function centercol(){
?>
				<!-- Col2 740px -->
				<div id="centerCol">
					<div id="product" class="box">
<?php
}


//columna de 490px
function centercolb(){
?>
				<!-- Col2 490px -->
				<div id="centerColb">
					<div id="product" class="box">
<?php
}

function centercoltanca(){
?>
					</div>
				</div>
<?php
}
function columnadreta(){
?>
				<!-- Col3 -->
				<div id="rightCol">
					<div class="box">
						<h3><span>Productos Relacionados</span></h2>
						<div id="related-products" class="box-content">
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver más información"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 ?<br /></div>
								<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
								<a class="info button" href="#" title="Ver más información"><span>+info</span></a>
							</div>
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver más información"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 ?<br /></div>
								<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
								<a class="info button" href="#" title="Ver más información"><span>+info</span></a>
							</div>
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver más información"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 ?<br /></div>
								<a class="add button" href="#" title="Añadir al carro"><span>Añadir al carro</span></a>
								<a class="info button" href="#" title="Ver más información"><span>+info</span></a>
							</div>
						</div>
					</div>
				</div>
<?php
}


//tancament contingut pagina
function cospaginatanca(){
?>
					</div>
					<div class="clear"></div>
				</div>
		</div>
	</div><!--/ container -->
	<div id="clear-footer"></div>	
<?php
}

function cospaginabtanca(){
?>
	</div><!--/ container -->
	<div id="clear-footer"></div>
<?php
}
//peu de la pagina
function peu(){
?>
	<!-- Peu -->
	<div id="footer-wrapper">
		<div id="footer">
			<div id="footer-left">
				<ul id="links">
					<li><a href="./" title="Volver al Inicio">Inicio</a> | </li>
					<li><a href="./acercade.php" title="Acerca de nosotros">Acerca de nosotros</a> | </li>
					<li><a href="./condiciones.php" title="Condiciones de uso">Condiciones de uso</a> | </li>
					<li><a href="./contacto.php" title="Contacto">Contacto</a></li>
					<div class="clear"></div>
				</ul>
				<div class="logoFooter"><a href="./" title="Volver al Inicio"><img src="images/logo.png" alt="Innovate PC" /></a></div>
			</div>
			<div id="footer-right">
				<p>Copyright &copy; 2013 Innovate PC. Todos los derechos reservados.<br /><a href="#" target="_blank">Designs & Web Technologies</a></p>
			</div>
		<div class="clear"></div>
		</div>
	</div>
<?php
}

function jquery(){
?>
<script type="text/javascript">
	$(document).ready(function () {
	  $("a[rel^='prettyPhoto']").prettyPhoto({
	  	social_tools:false
	  });
		$("#user-access .login-btn a").click(function() {
			$("#user-access .login-btn").toggleClass("active");
			$("#login-dropdown").toggle( "blind", 100 );
		});
		$("#dropdown-menu").accordion({ heightStyle: "content", collapsible: true, active: 0, icons: { "header": "arrow-right", "headerSelected": "arrow-down" }});
		$('#products').slides({
			preload: true,
			preloadImage: 'images/loading.gif',
			effect: 'slide, fade',
			crossfade: true,
			slideSpeed: 350,
			fadeSpeed: 500,
			generateNextPrev: false,
			generatePagination: false
		});
		//$("#conditions").tabs({ show: { effect: "blind", duration: 400 } });
	});
</script>
<?php	
}

function peutanca(){
?>
</body>
</html>
<?php
}
?>