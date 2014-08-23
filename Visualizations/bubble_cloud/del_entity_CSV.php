<?php
	$user_screen_name = $_POST['val'];
	$file = "data\\$user_screen_name.csv";
	if (!unlink($file))
		echo ("Error deleting $file");
	else
	echo ("Deleted $file");
?>