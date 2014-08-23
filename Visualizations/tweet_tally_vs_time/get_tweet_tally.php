<?php
	require_once('../Dashboard.php');

	$dashboard = new Dashboard();
	$dashboard->get_tweet_tally_JSON();
	
?>