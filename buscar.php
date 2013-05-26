<?php
include_once("funcionsHTML.php");
include_once("funcions.php");
include_once("lang.php");

if(isset($_GET['query']) && $_GET['query']!=lang("SEARCH")."..."){
	$cadena=$_GET['query'];
}
else{
	$cadena="";
}

echo $cadena;

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
<h2><span><?php echo lang('SEARCH_RESULTS')." ".lang('FOR')." ".$cadena; ?></span></h2>
<div id="product-list" class="box-content">
<?php




?>
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
