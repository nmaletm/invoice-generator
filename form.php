<?php


$params = array(
	'Factura' => array(
		'date' => 'Data',
		'invoiceNum' => 'Nº factura',
		'subtotal' => 'Total bruto (€)',
		'ivaPerc' => 'IVA (%)',
		'iva' => 'Valor IVA (€)',
		'total' => 'Valor Total (€)',
	),
	'Client' => array(
		'clientName' => 'Nom client',
		'clientCIF' => 'NIF/CIF client',
		'clientAdress' => 'Adreça client linia 1',
		'clientAdress2' => 'Adreça client linia 2',
	),

);

function get($name) {
	return htmlspecialchars($_GET[$name]);
}

function getItems() {
	return array('names' => $_GET['names'], 'totals' => $_GET['totals']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Generar</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <link rel="stylesheet" type="text/css" media="all" href="http://tools.storn.es/estil.css" />
</head>
<body>

<div class="bar">
	<a href="#" id="generate">Generar</a> - 
	<a href="#" id="linkPDF">Link factura (PDF)</a> - 
	<a href="#" id="linkHTML">Link factura (HTML)</a>
</div>
<div class="block block-form">
<form method="get" id="form">

<?php

$items = getItems();



echo "<div class='paramBlock'>";
echo "<h3>Items</h3>";
foreach ($items['names'] as $i => $name) {
	$total = $items['totals'][$i];
	if ($name || $total) {
		echo "<input class='field itemName' name='names[]' value='".$name."' />";
		echo "<input class='field itemTotal' name='totals[]' value='".$total."' /> €";
	}
}
echo "<input class='itemName' name='names[]' value='' />";
echo "<input class='itemTotal' name='totals[]' value='' />";
echo "</div>";

foreach ($params as $blockName => $blockParams) {
	echo "<div class='paramBlock'>";
	echo "<h3>$blockName</h3>";
	foreach ($blockParams as $key => $value) {
		echo "<b>$value: </b><br>\n";
		echo "<input name='$key' class='field' value='".get($key)."'' />";
	}
	echo "</div>";
}
?>

</form>
</div>
<iframe class="block"></iframe>

<style style="text/css">
html, body{
	height: 100%;
	margin: 0;
	padding: 0;
}
body{
	font-family: 'Arial';
}
h1,h2,h3,h4{
	margin: 5px 0 10px 0;
}
.block-form{
	padding-top: 45px;
}
form{
	height: 100%;
	max-height: 100%;
	overflow-y: scroll;
}
.field{
	width: 100%;
	margin-bottom: 5px;
}
iframe{
	position: fixed;
	top: 0;
	right: 0;
}
.bar{
	position: fixed;
	top: 0;
	left: 0;
	width: 50%;
	background: #888;
	height: 40px;
	padding: 5px;
}
.bar, .bar a, .bar a:visited{
	color: white;
}
.itemName{
	width: 80%
}
.itemTotal{
	width: 15%
}
.block{
	width: 50%;
	height: 100%;
	display: inline-block;
	vertical-align: top;
}
.paramBlock{
	background: #eee;
	padding: 10px; 
	margin-bottom: 10px;
}
*{
	box-sizing: border-box;
}
</style>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
$(function() {
	generate();
	$('input').change(function(){
		generate();
	});
	$('#generate').click(function(){
		$('#form').submit();
	});
});

function getUrl(){
	var params = $('form').serialize();
	return 'http://tools.storn.es/factura/generate.php?'+params;
}

function generate(){
	var url = getUrl();
	$('iframe').attr('src', url);
	$('#linkPDF').attr('href', url);
	$('#linkHTML').attr('href', url.replace('generate','template'));
}

</script>
</body>
</html>
