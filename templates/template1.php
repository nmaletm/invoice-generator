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
			<td class="block-70" style="vertical-align: middle;">
				<h1><?=$GLOBALS['user']['authorName']?></h1>
			</td>
			<td class="block-30">
				<?=$GLOBALS['user']['authorAddress1']?><br>
				<?=$GLOBALS['user']['authorAddress2']?><br>
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
				<?=get('clientAddress')?><br>
				<?=get('clientAddress2')?><br>
				<?=get('clientCIF')?><br>
			</td>
			<td class="block-50">
				<table class="block-100">
					<tr style="font-weight: bold;">
						<td class="block-30">Fecha<br>expedición</td>
						<td class="block-30">Fecha<br>operación</td>
						<td class="block-30">Factura Nº</td>
					</tr>
					<tr>
						<td><?=get('dateExp')?></td>
						<td><?=get('dateExp')?></td>
						<td><?=get('invoiceNum')?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div >
		
	</div>

<table class="row">
	<tr class="header">
		<td>Cant.</td>
		<td>Concepto</td>
		<td>Precio<br>unitario</td>
		<td class="alginRight">Importe</td>
	</tr>
<?php
$subtotal = 0;
$items = getItems();
foreach ($items['names'] as $i => $name) {
	$numItem = $items['values'][$i];
	$priceItem = $items['totals'][$i];
	$total = $numItem * $priceItem;
	$subtotal += $total;
	if ($name || $total) {
		echo "<tr>";
		echo "<td class='block-10'>".$numItem."</td>";
		echo "<td class='block-60'>".$name."</td>";
		echo "<td class='block-15'>".formatMoneyNumber($priceItem)." €</td>";
		echo "<td class='block-15 alginRight'>".formatMoneyNumber($total)." €</td>";
		echo "</tr>\n";
	}
}
?>
</table>
	<div class="row header">
		Cómputo
	</div>
<?php

$ivaPerc = get('ivaPerc');
$irpfPerc = get('irpfPerc');

$iva = $subtotal * $ivaPerc / 100;
$irpf = $subtotal * $irpfPerc / 100;
$total = $subtotal + $iva - $irpf;
?>
	<table class="row">
		<tr style="font-weight: bold;">
			<td class="block-20">Total bruto</td>
			<td class="block-20">IVA (<?=$ivaPerc?>%)</td>
			<td class="block-40">IRPF (<?=$irpfPerc?>%)</td>
			<td class="block-20 alginRight">Total</td>
		</tr>
		<tr>
			<td><?=formatMoneyNumber($subtotal)?> €</td>
			<td><?=formatMoneyNumber($iva)?> €</td>
			<td><?=formatMoneyNumber($irpf)?> €</td>
			<td class="alginRight"><?=formatMoneyNumber($total)?> €</td>
		</tr>
	</table>

<br><br><br>
<br><br><br>

	<div class="row legal">
		Operación localizada en sede del destinatario en virtud del art. 69 de la Ley 37/1992, del IVA.
	</div>

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
.header-inner{
	padding: 5px;
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

.legal{
	font-size: 10px;
}
.bordered{
	border: 1px solid;
}

.alginRight{
	text-align: right;
}
.alginCenter{
	text-align: center;
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
.block-15{width: 15%;}
.block-10{width: 10%;}
.block-0{width: 0%;}

table { 
    border-spacing: 0;
    border-collapse: collapse;
}
td, div{
    /*vertical-align: top;*/
    vertical-align: middle;
    padding: 5px;
}
*{
	/*border: 1px solid; /**/
}
</style>
</html>
