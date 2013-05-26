<?php
include_once("funcions.php");
include_once("lang.php");

//capsalera
function capsalera(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Innovate PC</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<!-- Set iconos-font vectoriales -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
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
					<div class="register-btn"><a href="#" title="<?php echo lang('SIGN_UP'); ?>"><?php echo lang('SIGN_UP'); ?></a></div>
					<div class="login-btn"><a href="#" title="<?php echo lang('SIGN_IN'); ?>"><?php echo lang('SIGN_IN'); ?></a></div>
					<div class="clear"></div>
					<div id="login-dropdown">
						<form name="login" action="accio.php?accio=login" method="POST">
							<label for="email">E-mail:</label>
							<input name="email" class="field" /><br />
							<label for="password"><?php echo lang('PASSWORD'); ?>:</label>
							<input name="password" class="field" type="password" />
							<div class="rememberme"><a href="registrar.php"><?php echo lang('SIGN_UP'); ?></a></div>
							<input type="submit" name="enviar" class="submit button" value="<?php echo lang('SIGN_IN'); ?>" />
							<div class="clear"></div>
						</form>
					</div>
				</div>
				<div id="languages">
					<ul>
						<li <?php if($_SESSION['lang']=='ca') echo 'class="active"' ?>><a class="ca" href="accio.php?mode=idioma&lang=ca" title="Catal&agrave;"><span>CA</span></a></li>
						<li <?php if($_SESSION['lang']=='es') echo 'class="active"' ?>><a class="es" href="accio.php?mode=idioma&lang=es" title="Espa&ntilde;ol"><span>ES</span></a></li>
						<li <?php if($_SESSION['lang']=='en') echo 'class="active"' ?>><a class="en" href="accio.php?mode=idioma&lang=en" title="English"><span>EN</span></a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- Capcalera -->
		<div id="header-wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><img src="images/logo.png" alt="Innovate PC" /><span class="ocult">Innovate PC</span></a></h1>
				</div>
				<div id="rightheader">
					<div id="searchbox">
						<form name="searchbox" method="GET" action="./buscar.php">
							<label for="cercar" class="ocult"><?php echo lang('SEARCH'); ?></label>
							<input id="search" name="query" class="box" type="text" />
							<!--<input id="search" name="query" class="box" type="text" value="<?php echo lang('SEARCH'); ?>..." onblur="if(this.value=='') this.value='<?php echo lang('SEARCH'); ?>...';" onfocus="if(this.value=='<?php echo lang('SEARCH'); ?>...') this.value='';" />-->
							<button type="submit" name="cercar" type="image" class="search"></button>
							<!--<input name="cercar" type="image" class="search" src="images/search.gif" />-->
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
						<li class="<?php echo $pagines[0];?>"><a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><?php echo lang('HOME'); ?></a></li>
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
						<h3><span><?php echo lang('PRODUCTS'); ?></span></h3>
						<?php menuVertical(); ?>
					</div>
<?php
}
function banner(){
?>
					<div class="box">
						<h3><span><?php echo lang('MANUFACTURERS'); ?></span></h2>
						<div class="box-content">
							<a href="http://www.logitech.com/es-es" target="_blank"><img src="images/banner1.jpg" alt="Logitech" /></a>
							<a href="http://www.asus.es/" target="_blank"><img src="images/banner2.jpg" alt="Asus" /></a>
							<a href="http://www.intel.es/" target="_blank"><img src="images/banner3.jpg" alt="Intel" /></a>
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
						<h3><span><?php echo lang('RELATED_PRODUCTS'); ?></span></h2>
						<div id="related-products" class="box-content">
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver m&aacute;informaci&oacute;n"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 &euro;<br /></div>
								<a class="add button" href="#" title="A&ntilde;adir al carro"><span>A&ntilde;adir al carro</span></a>
								<a class="info button" href="#" title="Ver m&aacute;s informaci&oacute;n"><span>+info</span></a>
							</div>
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver m&aacute;informaci&oacute;n"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 &euro;<br /></div>
								<a class="add button" href="#" title="A&ntilde;adir al carro"><span>A&ntilde;adir al carro</span></a>
								<a class="info button" href="#" title="Ver m&aacute;s informaci&oacute;n"><span>+info</span></a>
							</div>
							<div class="related-item">
								<div class="title">B-Move Black Shark 2000dpi Verde</div>
								<div class="image"><a href="#" title="Ver m&aacute;informaci&oacute;n"><img src="images/gallery/B-Move-Black-Shark-verde.jpg" /></a></div>
								<div class="price">12.95 &euro;<br /></div>
								<a class="add button" href="#" title="A&ntilde;adir al carro"><span>A&ntilde;adir al carro</span></a>
								<a class="info button" href="#" title="Ver m&aacute;s informaci&oacute;n"><span>+info</span></a>
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
					<li><a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><?php echo lang('HOME'); ?></a> | </li>
					<li><a href="./acercade.php" title="<?php echo lang('ABOUT_US'); ?>"><?php echo lang('ABOUT_US'); ?></a> | </li>
					<li><a href="./condiciones.php" title="<?php echo lang('TERMS_OF_USE'); ?>"><?php echo lang('TERMS_OF_USE'); ?></a> | </li>
					<li><a href="./contacto.php" title="<?php echo lang('CONTACT'); ?>"><?php echo lang('CONTACT'); ?></a></li>
					<div class="clear"></div>
				</ul>
				<div class="logoFooter"><a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><img src="images/logo.png" alt="Innovate PC" /></a></div>
			</div>
			<div id="footer-right">
				<p><?php echo lang('COPYRIGHT'); ?><br /><a href="#" target="_blank">Designs & Web Technologies</a></p>
			</div>
		<div class="clear"></div>
		</div>
	</div>
<?php
}




function jQuery(){
?>
<script type="text/javascript">
	$(document).ready(function () {
<?php	
}

function jQueryTanca(){
?>
	});
</script>
<?php
}

function prettyPhoto(){
?>
	  $("a[rel^='prettyPhoto']").prettyPhoto({
	  	social_tools:false
	  });
<?php
}

function jQLogin(){
?>
		$("#user-access .login-btn a").click(function() {
			$("#user-access .login-btn").toggleClass("active");
			$("#login-dropdown").toggle( "blind", 100 );
		});
<?php
}

function jQSlides(){
?>
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
<?php
}


function jQDesplegable($item){
	if($item<=0){
		$item="false";
	}
	else{
		$item=$item-1;
	}
?>
		$("#dropdown-menu").accordion({
			heightStyle: "content",
			collapsible: true,
			active: <?php echo $item ?>,
			icons: { "header": "arrow-right", "headerSelected": "arrow-down" }
		});
<?php
}

function jQTabs(){
?>
		$("#conditions").tabs({ show: { effect: "blind", duration: 400 } });
<?php
}


function peutanca(){
?>
</body>
</html>
<?php
}



function carrito(){
?>
<div id="botoneraCart"><a class="carrito button" href="./carrito.php" title="<?php echo lang('VIEW_CART'); ?>"><span>(<?php echo totalItemsCarro(); ?>)</span></a></div>
<div class="clear"></div>
<?php
}

?>