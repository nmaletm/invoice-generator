<?php
include "vars.php";

function get($name) {
	//return urldecode(htmlspecialchars($_GET[$name]));
	//return htmlspecialchars($_GET[$name]);
	return htmlspecialchars(mb_convert_encoding($_GET[$name], 'UTF-8', 'UTF-8,ISO-8859-1'));
	//return urldecode($_GET[$name]);
}
function getItems() {
	return array('names' => $_GET['names'], 'values' => $_GET['values'], 'totals' => $_GET['totals']);
}

function formatMoneyNumber($num) {
	return number_format((float)$num, 2, '.', '');
}


$username = $_GET['username'];
if(!$username || !isset($GLOBALS['users'][$username])) {
	$username = $GLOBALS['defaultUser'];
}
$GLOBALS['user'] = $GLOBALS['users'][$username];
$GLOBALS['user']['username'] = $username;
