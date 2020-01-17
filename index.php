<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>MadiaManager</title>
</head>
<body>
	<?php require "blocks/header.php"?>
	
	<div class="container mt-5">
		<h3 class="mb-5">Publications</h3>
		<div class="d-flex flex-wrap">
			<?php require "db/publications.php"?>
		</div>
	</div>

	<?php require "blocks/footer.php"?>
</body>
</html>