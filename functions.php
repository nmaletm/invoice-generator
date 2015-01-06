<?php
include "vars.php";

if(!function_exists('get')){
	function get($name) {
		return htmlspecialchars($_GET[$name]);
	}
	function getItems() {
		return array('names' => $_GET['names'], 'values' => $_GET['values'], 'totals' => $_GET['totals']);
	}
}

$username = $_GET['username'];
if(!$username || !isset($GLOBALS['users'][$username])) {
	$username = $GLOBALS['defaultUser'];
}
$GLOBALS['user'] = $GLOBALS['users'][$username];
$GLOBALS['user']['username'] = $username;
