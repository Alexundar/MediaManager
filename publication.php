<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbc = mysqli_connect("localhost", "root", "", "mediamanager") or die("Could not connect : " . mysqli_error());
$pubTitle = mysqli_real_escape_string($dbc, trim($_GET['publicationTitle']));
$query = "SELECT p.publicationTitle, p.publicationDescr, p.publicationDateTime, p.publicationKeywords, p.imgPath, pub.publisherName, ev.eventTitle FROM publications AS p
    INNER JOIN publishers AS pub ON p.publisherId=pub.publisherId
    INNER JOIN events AS ev ON p.eventId=ev.eventId 
    WHERE publicationTitle='$pubTitle';";
$data = mysqli_query($dbc,$query) or Trigger_error("Query: $query MySQL Error: " . mysqli_error($dbc));
    if(mysqli_num_rows($data) == 1) {
    	$row = mysqli_fetch_assoc($data);
    	$img = $row["imgPath"];
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
	<title><?php echo $row["publicationTitle"];?></title>
</head>
<body>
	<?php require "blocks/header.php"?>
	<div>
		<h3 class="ml-5 mb-5"><?php echo $row["publicationTitle"];?></h3>
		<div class="ml-5">
			<p>Author: <?php echo $row["publisherName"];?></p>
			<img src="<?php echo $img;?> " alt="img" class="mb-3">
			<p>
				<?php echo $row["publicationDescr"];?>
			</p>
			<p>
				Keywords: <?php echo $row["publicationKeywords"];?>
			</p>
			<p>
				Event: <?php echo $row["eventTitle"];?>
			</p>
			<p>
				<?php echo $row["publicationDateTime"];?>
			</p>
		</div>
	</div>

	
	<?php require "blocks/footer.php"?>
</body>
</html>
<?php
}
else{
	echo 'Sorry. This publication doesnt exist';
}
mysqli_close($dbc);
?>