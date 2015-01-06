<?php
include "functions.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Generar</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <link rel="stylesheet" type="text/css" media="all" href="http://tools.storn.es/estil.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/form.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
</head>
<body>

<div class="bar">
	<a href="#" id="settings"><img src="img/settings.png" alt="Settings"/></a> 
	<a href="#" id="save"><img src="img/save.png" alt="Save PDF"/></a> 
	<a href="#" id="refresh"><img src="img/refresh.png" alt="Refresh PDF"/></a> 
</div>
<div class="block block-form">
<form method="get" id="form">
	<input type="hidden" name='username' value='<?=$GLOBALS['user']['username']?>' id="userHidden"/>
<?php

$items = getItems();

echo "<div class='paramBlock'>";
echo "<h3>Items</h3>";
foreach ($items['names'] as $i => $name) {
	$total = $items['totals'][$i];
	$value = $items['values'][$i];
	if ($name || $value || $total) {
		echo "<input class='field itemName' name='names[]' value='".$name."' />";
		echo "<input class='field itemValue' name='values[]' value='".$value."' />";
		echo "<input class='field itemTotal' name='totals[]' value='".$total."' /> €";
	}
}
echo "<input class='itemName' name='names[]' value='' />";
echo "<input class='itemValue' name='values[]' value='' />";
echo "<input class='itemTotal' name='totals[]' value='' /> €";
echo "</div>";

foreach ($GLOBALS['user']['templateParams'] as $blockName => $blockParams) {
	echo "<div class='paramBlock'>";
	echo "<h3>$blockName</h3>";
	foreach ($blockParams as $key => $value) {
		echo "<b>$value: </b><br>\n";
		echo "<input name='$key' class='field' value='".get($key)."' />";
	}
	echo "</div>";
}
?>
	<input type="hidden" name='rand' value='<?=rand(100,20000)?>'/>
</form>
</div>
<iframe class="block"></iframe>

<div id="dialog-invoice" class="dialog" title="Factura">
	<p>Guarda aquesta url:</p>
	<code class="formUrl"></code>
	<p>Descarrega el PDF <a href="#" class="downloadUrl"><img src="img/pdf.png" alt="Generate PDF" class="icon"/></a></p>
</div>

<div id="dialog-tools" class="dialog" title="Eines">
	<p> 
		Canviar a usuari: 
		<select name='user' id="userSelect">
			<option value="<?=$GLOBALS['user']['username']?>" selected="selected"><?=$GLOBALS['user']['username']?></option>
			<option disabled>-----------</option>
<?php
foreach ($GLOBALS['users'] as $username => $data) {
	echo "\t\t\t<option value='$username'>$username</option>";
}
?>
		</select>
	</p>
	<p>PDF al navegador: <a href="#" id="linkPDF" target="_blank"><img src="img/pdf.png" alt="Generate PDF" class="icon"/></a></p>
	<p>Pàgina HTML: <a href="#" id="linkHTML" target="_blank"><img src="img/html.png" alt="View html page" class="icon"/></a></p>
</div>


<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
	generate();
	$('input').change(function(){
		generate();
	});
	$('#refresh').click(function(){
		$('#form').submit();
	});
	$('#save').click(function(){
		$("#dialog-invoice").dialog({
			width: '80%'
		});
	});
	$('#settings').click(function(){
		$("#dialog-tools").dialog({
			width: '400px'
		});
	});
	$('#userSelect').change(function(){
		$('#userHidden').val($(this).val());
		$('#form').submit();
	});
});

function getUrl(){
	var params = $('form').serialize();
	return 'http://tools.storn.es/factura/{{file}}?'+params;
}

function generate(){
	var url = getUrl();
	var templatePath = 'templates/<?=$GLOBALS['user']['template']?>';
	var urlTemplate = url.replace('{{file}}',templatePath);
	var urlPdf = url.replace('{{file}}', 'generate.php');

	$('iframe').attr('src', urlPdf + '&' + Math.random());
	$('#linkPDF').attr('href', urlPdf.replace('{{file}}', 'generate.php'));
	$('#linkHTML').attr('href', urlTemplate);
	$('.formUrl').html(url.replace('{{file}}', 'form.php'));
	$('.downloadUrl').attr('href', urlPdf + '&download=1')
}

</script>
</body>
</html>
