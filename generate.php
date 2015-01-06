<?php

include "html2pdf/html2pdf.class.php";

if(!function_exists('get')){
	function get($name) {
		return htmlspecialchars($_GET[$name]);
	}
	function getItems() {
		return array('names' => $_GET['names'], 'totals' => $_GET['totals']);
	}
}



// get the HTML
ob_start();
include(dirname(__FILE__).'/template.php');
$content = ob_get_clean();

// convert in PDF
try
{
	$fileName = get('invoiceNum');
	if(!$fileName){
		$fileName = 'invoice';
	}
	$fileName .= '.pdf';
	
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($fileName);
}
catch(HTML2PDF_exception $e) {
	header('Content-Type: text/html; charset=utf-8');
    echo $e;
    exit;
}
