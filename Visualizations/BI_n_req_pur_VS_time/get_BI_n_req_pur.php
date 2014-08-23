<?php
	require_once('../Dashboard.php');
	
	session_start();

	$dashboard = new Dashboard();
	//$dashboard->get_BI_n_req_pur($_SESSION['user_id']);
	$dashboard->get_BI_n_req_pur('53463223');
	
?>