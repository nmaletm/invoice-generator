<?php
include "../functions.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Factura</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
</head>
<body>
<div class="page">
	<table class="row">
		<tr>
			<td class="block-70">
				<h1><?=$GLOBALS['user']['authorName']?></h1>
				<h3>Factura</h3>
			</td>
			<td class="block-30">
				<?=$GLOBALS['user']['authorAdress1']?><br>
				<?=$GLOBALS['user']['authorAdress2']?><br>
				N.I.F. <?=$GLOBALS['user']['authorNIF']?><br>
				<a href="mailto:<?=$GLOBALS['user']['authorMail']?>"><?=$GLOBALS['user']['authorMail']?></a><br>
				<a href="http://<?=$GLOBALS['user']['authorWeb']?>"><?=$GLOBALS['user']['$authorWeb']?></a><br>
			</td>
		</tr>
	</table>
	<table class="row" style="margin-top: 10px;">
		<tr>
			<td class="block-50">
				<?=get('clientName')?><br>
				<?=get('clientAdress')?><br>
				<?=get('clientAdress2')?><br>
				<?=get('clientCIF')?><br>
			</td>
			<td class="block-50">
				<table class="block-100">
					<tr style="font-weight: bold;">
						<td class="block-50">Fecha</td>
						<td class="block-50">Factura Nº</td>
					</tr>
					<tr>
						<td><?=get('date')?></td>
						<td><?=get('invoiceNum')?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div class="row header">
		Conceptos
	</div>

<table class="row">
<?php 
$items = getItems();
foreach ($items['names'] as $i => $name) {
	$total = $items['totals'][$i];
	if ($name ||$total) {
		echo "<tr>";
		echo "<td class='block-80'>".$name."</td>";
		echo "<td class='block-20' style='text-align: right;'>".$total." €</td>";
		echo "</tr>\n";
	}
}
?>
</table>
	<div class="row header">
		Cómputo
	</div>

	<table class="row">
		<tr style="font-weight: bold;">
			<td class="block-20">Total bruto</td>
			<td class="block-60">IVA (<?=get('ivaPerc')?>%)</td>
			<td class="block-20">Total</td>
		</tr>
		<tr>
			<td><?=get('subtotal')?> €</td>
			<td><?=get('iva')?> €</td>
			<td><?=get('total')?> €</td>
		</tr>
	</table>

</div>
</body>
<style style="text/css">
body{
	 margin: 20px; 
	 font-family: 'Arial';
}
.page{
	width: 80%;
	margin-left: 60px;
	margin-top: 60px;
}
.row{
	width: 100%;
}
h1,h2,h3,h4{
	margin: 5px 0 10px 0;
}
.header{
	margin-top: 30px;
	font-weight: bold;
	background-color: grey;
	color: white;
}

.bordered{
	border: 1px solid;
}

.block-100{width: 100%;}
.block-90{width: 90%;}
.block-80{width: 80%;}
.block-70{width: 70%;}
.block-60{width: 60%;}
.block-50{width: 50%;}
.block-40{width: 40%;}
.block-30{width: 30%;}
.block-20{width: 20%;}
.block-10{width: 10%;}
.block-0{width: 0%;}

table { 
    border-spacing: 0;
    border-collapse: collapse;
}
td, div{
    vertical-align: top;
    padding: 5px;
}
*{
	/*border: 1px solid; /**/
}
</style>
</html>
