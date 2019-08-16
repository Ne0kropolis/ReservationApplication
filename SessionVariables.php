<?php

session_start();

function setUser($in_ID) {
	$user = $in_ID;
	$_SESSION['curUser'] = serialize($user);
}

function getUser() {
	$user = "";
	if (isset($_SESSION['curUser'])) {
		$user = unserialize($_SESSION['curUser']);
	}
	return $user;
}

function getSessionStatus() {
	return isset($_SESSION['curUser']);
}

function killSession() {
	$_SESSION = array();
}
?>