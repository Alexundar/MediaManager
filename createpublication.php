<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['publisherId'])) {
	$dbc = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
    $query = "SELECT eventId, eventTitle FROM events;";
	$events = mysqli_query($dbc, $query) or trigger_error("Query: $query MySQL Error: " . mysqli_error($dbc));
	mysqli_close($dbc); 
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
	<title>Create Publication</title>
</head>
<body>
	<?php require "blocks\header.php"?>
	
	<div class="container mt-5">
		<h4>Create your publication</h4>
		<form action="db/insertpublication.php" method="post" name="publicationform" id="publicationform " enctype="multipart/form-data">
			<p>
				<p>Title</p>
				<input type="text" name="title" id="title" size="25" />
			</p>
			<p>
				<p>Brief description</p>
				<textarea name="brief_description" id="brief_description" cols="48" rows="8"> </textarea>
			</p>
			<select name="events">
				<?php 
				if (mysqli_num_rows($events) > 0) {
	    			while($row = mysqli_fetch_assoc($events)) { ?>
						<option>
							<?php echo $row["eventTitle"];?> 
						</option> <?php
	    			}
	    		}
				?>
			</select>
			<p>
				<p>Keywords</p>
				<input type="text" name="keywords" id="keywords" size="25" />
			</p>
			<p>
				<div class="custom-file">
					<input type="file" name="picture" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			</p>
			<p>
				<input name="submit" type="submit" id="submit" value="Post publication" />
			</p>
		</form>
	</div>

	<?php require "blocks/footer.php"?>
</body>
</html>
<?php
}
?>
