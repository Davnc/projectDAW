<?php
include_once("funcionsHTML.php");
include_once("funcions.php");

//capçalera
capsalera();
//menu principal
menu(0);
cospag();
?>
<div id="breadcrums"><?php echo lang('YOU_ARE_HERE'); ?>: <a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><?php echo lang('HOME'); ?></a> &raquo; <?php echo lang('ABOUT_US'); ?></div>
<?php
carrito();
//desplegable dels productes
desplegable();
//banner
banner();
//cos
centercol();
?>
						<h2><span><?php echo lang('ABOUT_US'); ?></span></h2>
						<div class="box-content">
							<p><a rel="prettyPhoto[gal]" href="./images/people.jpg" class="imgleft"><img src="./images/people.jpg" alt="" width="200" /></a>InnovatePC es un proveedor de comercio de hardware, software y de electrónica de consumo, a nivel español.</p>
							<p>La historia empresarial empieza en 1991, en España: Se crea la compañía “InnovatePC”, con un puñado de colaboradores entusiasmados y una idea de negocio ingeniosa. En aquella época “pre-internet” los pedidos aún se efectúan de forma tradicional, vía fax y teléfono o en tienda física. El éxito no se hace esperar: InnovatePC se conoce poco a poco como proveedor de Hardware. InnovatePC fue una de las primeras empresas del sector ubicada en Lleida.<div class="clear"></div></p>
							<p><a rel="prettyPhoto[gal]" href="./images/local.jpg" class="imgright"><img src="./images/local.jpg" alt="" width="200" /></a>Actualmente queriendo aprovechar todas las ventajas que ofrece Internet hemos querido expandir nuestro negocio para convertirlo también en un negocio electrónico. En 2012 la empresa inicio un proyecto para realizar una completa tienda online, con vistas a expandirnos más allá del territorio nacional.</p>
							<div class="clear"></div>
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
