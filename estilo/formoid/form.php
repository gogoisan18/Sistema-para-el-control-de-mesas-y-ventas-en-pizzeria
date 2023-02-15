<?php

define('EMAIL_FOR_REPORTS', '');
define('RECAPTCHA_PRIVATE_KEY', '@privatekey@');
define('FINISH_URI', 'http://');
define('FINISH_ACTION', 'message');
define('FINISH_MESSAGE', 'Thanks for filling out my form!');
define('UPLOAD_ALLOWED_FILE_TYPES', 'doc, docx, xls, csv, txt, rtf, html, zip, jpg, jpeg, png, gif');

define('_DIR_', str_replace('\\', '/', dirname(__FILE__)) . '/');
require_once _DIR_ . '/handler.php';

?>

<?php if (frmd_message()): ?>
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-solid-green.css" type="text/css" />
<span class="alert alert-success"><?php echo FINISH_MESSAGE; ?></span>
<?php else: ?>
<!-- Start Formoid form-->
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-solid-green.css" type="text/css" />
<script type="text/javascript" src="<?php echo dirname($form_path); ?>/jquery.min.js"></script>
<form class="formoid-solid-green" style="background-color:#FFFFFF;font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#34495E;max-width:780px;min-width:150px" method="post"><div class="title"><h2>Control de Usuarios</h2></div>
	<div class="element-number<?php frmd_add_class("number"); ?>"><label class="title"><span class="required">*</span></label><div class="item-cont"><input class="small" type="text" min="7" max="8" name="number" required="required" placeholder="Cédula" value=""/><span class="icon-place"></span></div></div>
	<div class="element-password<?php frmd_add_class("password"); ?>"><label class="title"><span class="required">*</span></label><div class="item-cont"><input class="small" type="password" name="password" value="" required="required" placeholder="Clave"/><span class="icon-place"></span></div></div>
	<div class="element-name<?php frmd_add_class("name"); ?>"><label class="title"><span class="required">*</span></label><span class="nameFirst"><input placeholder=" Nombre" type="text" size="8" name="name[first]" required="required"/><span class="icon-place"></span></span><span class="nameLast"><input placeholder=" Apellido" type="text" size="14" name="name[last]" required="required"/><span class="icon-place"></span></span></div>
	<div class="element-select<?php frmd_add_class("select"); ?>"><label class="title"><span class="required">*</span></label><div class="item-cont"><div class="medium"><span><select name="select" required="required">

		<option value="Tipo de usuario">Tipo de usuario</option>
		<option value="Administrador">Administrador</option>
		<option value="Operador R">Operador R</option>
		<option value="Operador H">Operador H</option>
		<option value="Operador Dual">Operador Dual</option></select><i></i><span class="icon-place"></span></span></div></div></div>
	<div class="element-phone<?php frmd_add_class("phone"); ?>"><label class="title"></label><div class="item-cont"><input class="small" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="24" name="phone" placeholder="Teléfono" value=""/><span class="icon-place"></span></div></div>
	<div class="element-radio<?php frmd_add_class("radio"); ?>"><label class="title">Estatus<span class="required">*</span></label>		<div class="column column1"><label><input type="radio" name="radio" value="Activo" required="required"/><span>Activo</span></label><label><input type="radio" name="radio" value="Inactivo" required="required"/><span>Inactivo</span></label></div><span class="clearfix"></span>
</div>
<div class="submit"><input type="submit" value="Registrar"/></div></form><script type="text/javascript" src="<?php echo dirname($form_path); ?>/formoid-solid-green.js"></script>

<!-- Stop Formoid form-->
<?php endif; ?>

<?php frmd_end_form(); ?>