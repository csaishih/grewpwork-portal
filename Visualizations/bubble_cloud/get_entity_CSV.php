<?php
	require_once('../Dashboard.php');
	
	session_start();
	
	$user_screen_name = $_SESSION['screen_name'];
	
	$dashboard = new Dashboard();
	$dashboard->get_word_cloud_CSV($user_screen_name, "Entity");
	
?>