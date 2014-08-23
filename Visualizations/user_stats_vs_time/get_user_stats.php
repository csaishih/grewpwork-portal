<?php
	
	include '../Dashboard.php';

	session_start();
	
	$dashboard = new Dashboard();
	//$dashboard->get_user_stats_JSON($_SESSION['screen_name']);
	$dashboard->get_user_stats_JSON('hyungi0406');
?>