<!DOCTYPE html>
<?php session_start() ?>
<script>
		window.user = <?php echo json_encode($_SESSION) ?>;
		console.log(window.user);
</script>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
		<title>Grewpwork Dashboard</title>
		<link rel="stylesheet" href="css/style.css" rel="stylesheet">
	</head>
	<body>

		<div class="top">
			<div class="logo">
				<a href="http://grewpwork.com" id="grewpwork-logo" title="grewpwork.com"></a>
			</div>
			<div class="header-title">
				<p>Kevin's Dashboard</p>
				<!-- <p><?php echo $_SESSION['screen_name']; ?>&#39;s Dashboard</p> -->
			</div>
			<div class="links">
				<ul>
					<li><a>Link to Sam's part</a></li>
					<li><a id="links-setting">Log out</a></li>
				</ul>
			</div>
		</div>

		<div class="side">
			<ul>
				<li><a class="active" href="#pane1">User Stats</a></li>
				<li><a href="#pane2">BI Stats</a></li>
				<li><a href="#pane3">Movie Stats</a></li>
				<li><a href="#pane4">Entity Word Cloud</a></li>
			</ul>
		</div>

		<div class="main">
			<ul>
				<li class="active"><div class="pane" id="pane1-content1"></div></li>
				<li><div class="pane" id="pane2-content1"></div></li>
				<li><div class="pane" id="pane2-content2"></div></li>
				<li><div class="pane" id="pane2-content3"></div></li>
				<li><div class="pane" id="pane3-content1"></div></li>
				<li><div class="pane" id="pane3-content2"></div></li>
				<li><div class="pane" id="pane4-content1"></div></li>
			</ul>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/javascript.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.resize.js"></script>
	</body>
</html>