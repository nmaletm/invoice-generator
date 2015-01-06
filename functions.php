<?php
include "vars.php";

function get($name) {
	return htmlspecialchars($_GET[$name]);
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
