<?php
include_once("funcionsHTML.php");
include_once("funcions.php");

//capçalera
capsalera();
//menu principal
menu(0);
cospag();
?>
<div id="breadcrums"><?php echo lang('YOU_ARE_HERE'); ?>: <a href="./" title="<?php echo lang('BACK_TO_INDEX'); ?>"><?php echo lang('HOME'); ?></a> &raquo; <?php echo lang('CONTACT'); ?></div>
<?php
botonera();
//desplegable dels productes
desplegable();
//banner
banner();
//cos
centercol();
?>
						<h2><span>Contacto</span></h2>
						<div class="box-content">
							<form id="contacto-form" name="contacto-form">
								<h3>Formulario de contacto</h3>
								<label for="fullname">Nombre</label><br />
								<input name="fullname" class="field" /><br />
								<label for="email">Correo electrónico</label><br />
								<input name="email" class="field" /><br />
								<label name="msg">Mensaje</label><br />
								<textarea rows="10"></textarea><br />
								<div class="form-actions">
									<input class="button"type="reset" value="Borrar" /><input class="button" type="submit" value="Enviar" />
								</div>
								<div class="clear"></div>
							</form>
							<div id="contacto-data">
								<h3>Datos de la empresa</h3>
								<p>InnovatePC S.L<br />Gran Paseo de Ronda 54, 25008, España</p>
								<p><a href="mailto:contacto@innovatepc.es">contacto@innovatepc.es</a></p>
								<p>CIF: N0043428E</p>
								
								<iframe width="330" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Gran+Paseo+de+Ronda+54,+25008,+Espa%C3%B1a&amp;sll=41.615234,0.61407&amp;sspn=0.003429,0.008256&amp;gl=es&amp;g=Gran+Passeig+de+Ronda,+54,+25006+L%C3%A9rida,+Lleida&amp;ie=UTF8&amp;hq=&amp;hnear=Gran+Passeig+de+Ronda,+54,+25006+L%C3%A9rida,+Lleida&amp;t=m&amp;ll=41.615346,0.613604&amp;spn=0.005615,0.007081&amp;z=16&amp;iwloc=near&amp;output=embed"></iframe>
							</div>
							<div class="clear"></div>
						</div>
						
						
					</div>
<?php
cospaginatanca();
//peu
peu();

/* jQuerys */
jQuery();
jQDesplegable(0);
jQLogin();
jQueryTanca();

peutanca();
?>
