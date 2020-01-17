<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['publisherId'])) {
	if ($_SERVER['REQUEST_METHOD'] === 'GET'){
		$username = $_GET['username'];
		$link = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
    	$query = "SELECT p.publicationId ,p.publicationTitle, p.publicationDescr, p.publicationDateTime, p.publicationKeywords, p.imgPath, pub.publisherName, pub.username, ev.eventTitle FROM publications AS p
    INNER JOIN publishers AS pub ON p.publisherId=pub.publisherId
    INNER JOIN events AS ev ON p.eventId=ev.eventId
    WHERE pub.username='$username'
    ORDER BY p.publicationDateTime DESC;";
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
	<title>My Publications</title>
</head>
<body>
	<?php require "blocks/header.php"?>
	
	<div class="container mt-5">
		<h3 class="mb-5">My publications</h3>
		<div class="d-flex flex-wrap">
			<?php
			if (mysqli_num_rows($result) > 0) {
	   			while($row = mysqli_fetch_assoc($result)) { 
	    			$img = $row["imgPath"];
	    			$pubId = $row["publicationId"];
	    			$params = array("publicationTitle" => $row["publicationTitle"], "username" => $username, "publicationId" => $pubId);?>
		    	<div class="card mb-4 shadow-sm">
			        <div class="card-header">
			        	<h2 class="my-0 font-weight-normal"><?php echo $row["publisherName"];?></h2>
			        </div>
			        <div class="card-body">
			        	<h1 class="card-title"><a href="publication.php?<?php echo http_build_query($params);?>"><?php echo $row["publicationTitle"];?></a></h1>
			        	<img src="<?php echo $img;?> " alt="img" class="img-thumbnail">
			        	<ul class="list-unstyled mt-3 mb-4">
			         		<li><?php echo $row["publicationDescr"];?></li>
			          		
			            	<li><span>Keywords: </span><?php echo $row["publicationKeywords"];?></li>
			            	<li><span>Event: </span><?php echo $row["eventTitle"];?></li>
			            	<li><?php echo $row["publicationDateTime"];?></li>
			        	</ul>
			        	<a href="db/deletepost.php?<?php echo http_build_query($params);?>" class="btn bg-danger text-white" role="button">Delete Post</a>
			        </div>

			    </div>
			    <?php 
			}
		}
			?>
		</div>
	</div>

	<?php
}
else{
	echo 'Please. Sign in to see this page!!!';
}
require "blocks/footer.php";
	?>
</body>
</html>
