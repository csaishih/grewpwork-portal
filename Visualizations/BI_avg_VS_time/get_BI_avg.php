<?php

	require_once('../Dashboard.php');

	//session_start();
	//$user_screen_name = $_SESSION['screen_name'];
	$user_screen_name = 'hyungi0406';
	$dashboard = new Dashboard();
	$dashboard->get_BI_avg($user_screen_name);

?>