<?php

session_start();

if (isset($_COOKIE['id']) && $_COOKIE['id'] != '') {
	$_SESSION['id'] = $_COOKIE['id'];
	$_SESSION['email'] = $_COOKIE['email'];
	$_SESSION['name'] = $_COOKIE['name'];
}

if (!isset($_SESSION['id'])) {
	if ($_GET['page'] == "signUp") {
		include 'page/' . $_GET['page'] . '.php';
	} else {
		include 'page/' . 'login' . '.php';
	}
} else {
	if (file_exists('page/' . $_GET['page'] . '.php')) {
		include 'page/' . $_GET['page'] . '.php';
	} else {
		include 'page/' . 'login' . '.php';
	}
}

?>


