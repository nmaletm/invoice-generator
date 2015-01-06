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
	<table class="row header">
		<tr>
			<td class="block-70">
				<h2><?=$GLOBALS['user']['authorName']?></h2>
			</td>
			<td class="block-30">
				<?=$GLOBALS['user']['authorAddress1']?><br>
				<?=$GLOBALS['user']['authorAddress2']?><br>
				N.I.F. <?=$GLOBALS['user']['authorNIF']?><br>
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
			<td class="block-50 atop">
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
	<div class="row">
		<?=get('concept')?>
	</div>

	<div class="row header">
		Cómputo
	</div>

<table class="row">
	<tr style="font-weight: bold;">
		<td class="block-30">Nº sesiones</td>
		<td class="block-40">Importe</td>
		<td class="block-30 aright">Total</td>
	</tr>
<?php 
$items = getItems();
$gross = 0;
foreach ($items['values'] as $i => $sesion) {
	$priecePerSesion = $items['totals'][$i];
	if ($sesion || $priecePerSesion) {
		$total = $sesion * $priecePerSesion;
		echo "\t<tr>";
		echo "<td>".$sesion."</td>";
		echo "<td>".formatMoneyNumber($priecePerSesion)."</td>";
		echo "<td class='aright'>".formatMoneyNumber($total)." €</td>";
		echo "</tr>\n";
		$gross += $total;
	}
}

$irpf = get('irpf');
$totalIRPF = round($gross * $irpf/100,2);
$total = round($gross - $totalIRPF,2);
?>
</table>
<br><br><br>
	<table class="row">
		<tr>
			<td class="block-70 bold aright">Total bruto</td>
			<td class="block-30 aright"><?=formatMoneyNumber($gross)?> €</td>
		</tr>
		<tr>
			<td class="bold aright">IVA (0%) *</td>
			<td class="aright">0.00 €</td>
		</tr>
		<tr>
			<td class="bold aright">IRPF (<?=$irpf?>%)</td>
			<td class="aright"><?=formatMoneyNumber($totalIRPF)?> €</td>
		</tr>
		<tr>
			<td class="bold aright"><h4>Total</h4></td>
			<td class="bold aright"><?=formatMoneyNumber($total)?> €</td>
		</tr>
	</table>

<br><br><br>
<br><br><br>

	<div class="row legal">
		* Operación exenta, según disposición en el art.20.U.3 de la ley 37/1992 de 28 de diciembre, del Impuesto sobre el Valor añadido.
	</div>

<br><br><br>

	<div class="row legal">
		De conformidad con la Ley Orgánica 15/1999, le informamos que sus datos se hallan incorporados a un
fichero titularidad de CARMEN MONTOLIO CATALAN, con la finalidad de cumplir con nuestra relación
profesional.Puede ejercer los derechos de acceso, rectificación, cancelación y oposición en cualquier
momento, mediante escrito, acompañado de copia de documento oficial que le identifique, dirigido a
CARMEN MONTOLIO CATALAN, C/ Sardenya, 525 8º 1ª – 08024 Barcelona.
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
.legal{
	font-size: 10px;
}
h1,h2,h3,h4{
	margin: 5px 0 10px 0;
}
.bold{
	font-weight: bold;
}
.aright{
	text-align: right;
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
    vertical-align: middle;
    padding: 5px;
}
tr, .atop{
	vertical-align: top;
}
*{
	/*border: 1px solid; /**/
}
</style>
</html>
