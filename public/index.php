<?php
	include("modules/API.php");

	$doc = $_GET['doc'];
	if(!isset($_GET['doc'])){
		$doc = "imagefeed.php";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<base href="/sites/jupicer/public/" />
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="apps/main.js"></script>
		<script src="apps/nav.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
	</head>

	<body>
		<?php include("modules/nav.php"); ?>
		<div class="content">
			<?php include("modules/docs/$doc"); ?>
		</div>
	</body>

	<footer>
		<?php include("modules/footer.php"); ?>
	</footer>
</html>