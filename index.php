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
					<li><a href="http://grewpwork.com" id="links-setting">Log out</a></li>
				</ul>
			</div>
		</div>

		<div class="side">
			<ul>
				<li class="active bigboss default"><a href="#pane-default">Dashboard</a></li>
				<li class="bigboss"><a href="#pane1" id="pane-user">User Stats</a></li>
				<li class="miniboss"><a href="#pane1-content1" id="pane-user-mini-1">User Statistics VS Time</a></li>
				<li class="bigboss"><a href="#pane2" id="pane-bi">BI Stats</a></li>
				<li class="miniboss"><a href="#pane2-content1" id="pane-bi-mini-1">Total Purchases and Requests</a></li>
				<li class="miniboss"><a href="#pane2-content2" id="pane-bi-mini-2">Average Purchases and Requests</a></li>
				<li class="miniboss"><a href="#pane2-content3" id="pane-bi-mini-3">Total Revenue</a></li>
				<li class="bigboss"><a href="#pane3" id="pane-movie">Movie Stats</a></li>
				<li class="miniboss"><a href="#pane3-content1" id="pane-movie-mini-1">Movie Tweet Tally</a></li>
				<li class="miniboss"><a href="#pane3-content2" id="pane-movie-mini-2">Movie Sentiment</a></li>
				<li class="bigboss"><a href="#pane4" id="pane-entity">Entity Word Cloud</a></li>
				<li class="miniboss"><a href="#pane4-content1" id="pane-entity-mini-1">Bubble Cloud</a></li>
			</ul>
		</div>

		<div class="main-wrapper">
			<div class="main">
			</div>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/javascript.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.resize.js"></script>
	</body>
</html>