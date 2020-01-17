<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$link = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
	$query = "SELECT p.publisherId, p.publisherName, count(pub.publicationId) as cnt FROM publishers AS p
INNER JOIN publications AS pub ON p.publisherId=pub.publisherId
GROUP BY p.publisherId
ORDER BY cnt DESC;";
	$result = mysqli_query($link, $query) or die("Query failed : " . mysqli_error($link));
}
else{
	$query = "SELECT p.publisherId, p.publisherName, count(pub.publicationId) as cnt FROM publishers AS p
INNER JOIN publications AS pub ON p.publisherId=pub.publisherId
GROUP BY p.publisherId;";
$result = mysqli_query($link, $query) or die("Query failed : " . mysqli_error($link));
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
	<title>Publishers</title>
</head>
<body>
	<?php require "blocks/header.php";?>
	<div class="container mt-5">
		<h3 class="mb-5">Publishers</h3>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" name="selectsort" id="selectsort" enctype="multipart/form-data" class="mb-5">
			<select name="sort" class="custom-select w-25">
				<option selected>Sort by</option>
				<option>Nubmer of publications</option>
			</select>
			<p>
				<input name="submit" type="submit" id="submit" value="Sort" />
			</p>
		</form>
		<?php 
if (mysqli_num_rows($result) > 0) { 
	$i = 1;
	while($row = mysqli_fetch_assoc($result)) { 
		echo $i.'. '.$row['publisherName'].' '.$row['cnt'].' posted publications';
		$i++;
		?>
		<br>
	<?php
	}
	?>
	</div>
<?php
}
else{
	?>
	<h1>No publishers registered</h1>
	<?php
}
require "blocks/footer.php";?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($link);
?>