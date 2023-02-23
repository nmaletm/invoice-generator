<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;


include "functions.php";


// get the HTML
ob_start();
include(dirname(__FILE__).'/templates/'.$GLOBALS['user']['template']);
$content = ob_get_clean();

// convert in PDF
try
{
	$fileName = get('invoiceNum');
	if(!$fileName){
		$fileName = 'invoice';
	}
	$fileName .= '.pdf';
	$fileName = str_replace('/', '-', $fileName);
	$action = 'I';
	if ($_GET['download'] ?? false) {
		$action = 'D';
	}
	$html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($fileName, $action);
}
catch(HTML2PDF_exception $e) {
	header('Content-Type: text/html; charset=utf-8');
    echo $e;
    exit;
}
