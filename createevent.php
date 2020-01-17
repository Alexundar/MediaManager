<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['publisherId'])) {
	if(isset($_POST['submit'])){
		$dbc = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
		$brief_description = mysqli_real_escape_string($dbc, trim($_POST['brief_description']));
		$keywords = mysqli_real_escape_string($dbc, trim($_POST['keywords']));
		$datetime = date("Y-m-d H:i:s", strtotime(mysqli_real_escape_string($dbc, trim($_POST['date']))));
		$insert = "INSERT INTO events (eventDateTime, eventTitle, eventDescr, eventKeywords) VALUES ('$datetime', '$title', '$brief_description', '$keywords');";
		mysqli_query($dbc,$insert) or trigger_error("Query: $insert MySQL Error: " . mysqli_error($dbc));
		mysqli_close($dbc);
		$home_url = '../mediamanager/index.php';
		header('Location: '. $home_url);
	}
	
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
	<title>Create Event</title>
</head>
<body>
	<?php require "blocks\header.php"?>
	
	<div class="container mt-5">
		<h4>Create event</h4>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="eventform" id="eventform " enctype="multipart/form-data">
			<p>
				<p>Title</p>
				<input type="text" name="title" id="title" value="" size="25" />
			</p>
			<p>
				<p>Brief description</p>
				<textarea name="brief_description" id="brief_description" cols="48" rows="8"> </textarea>
			</p>
			
			<p>
				<p>Keywords</p>
				<input type="text" name="keywords" id="keywords" value="" size="25" />
			</p>
			<p>
				<p>Date and time</p>
				<input type="datetime-local" id="localdate" name="date"/>
			</p>
			<p>
				<input name="submit" type="submit" id="submit" value="Create event" />
			</p>
		</form>
	</div>

	<?php require "blocks/footer.php"?>
</body>
</html>
<?php
}
?>