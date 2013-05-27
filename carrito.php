<?php
include_once("funcionsHTML.php");
include_once("funcions.php");
include_once("lang.php");

if(isset($_GET['msg'])){
	if($_GET['msg']==1)
	$missatge='<span class="correct">'.lang("PRODUCT_ADDED_TO_CART").'</span>';
	elseif($_GET['msg']==2)
	$missatge='<span class="correct">'.lang("PRODUCT_DELETED_FROM_CART").'</span>';
	elseif($_GET['msg']==3)
	$missatge='<span class="correct">'.lang("CART_EMPTIED").'</span>';
}
else{
	$missatge="";
}

capsalera();
menu(0);
cospag();
?>
<div id="breadcrums"><?php echo lang("YOU_ARE_HERE"); ?>: <a href="./" title="<?php echo lang("BACK_TO_INDEX"); ?>"><?php echo lang("HOME"); ?></a> &raquo; <?php echo lang("CART"); ?></div>
<?php
botonera();
desplegable();
banner();
centercol();
?>
<h2><span><?php echo lang("CART"); ?></span></h2>
<div id="product-list" class="box-content">
<?php
echo $missatge;
if(totalItemsCarro()>0){
	listProductsCarro();
}
else{
	echo '<span class="info">'.lang("EMPTY_CART_DESC").'</span>';
}
?>
</div>
<?php
cospaginatanca();
//peu
peu();

/* jQuerys */
jQuery();
prettyPhoto();
jQLogin();
jQDesplegable(0);
jQueryTanca();

peutanca();
?>
