<?php
/*
Copy this file to vars.php to set the variables of each user.
*/

$GLOBALS['users'] = array(
	'user1' => array(
		'authorName' => 'Marco Polo Ferrer',
		'authorAdress1' => 'Carrer Verdaguer 51',
		'authorAdress2' => '08015 Barcelona',
		'authorNIF' => '7654321 K',
		'authorMail' => 'info@nestor.cat',
		'authorWeb' => 'www.nestor.cat',
		'template' => 'template1.php',
		'templateParams' => array(
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

		),
	),
	'rubieanes' => array(
		'authorName' => 'Pepe Rubianes',
		'authorAdress1' => 'Carrer Valencia 51',
		'authorAdress2' => '08015 Barcelona',
		'authorNIF' => '3235235 K',
		'authorMail' => 'info@nestor.cat',
		'authorWeb' => 'www.nestor.cat',
		'template' => 'template2.php',
		'templateParams' => array(
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

		),
	),
);

$GLOBALS['defaultUser'] = 'user1';