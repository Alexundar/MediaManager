<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $link = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
    $query = "SELECT p.publicationTitle, p.publicationDescr, p.publicationDateTime, p.publicationKeywords, p.imgPath, pub.publisherName, ev.eventTitle FROM publications AS p
    INNER JOIN publishers AS pub ON p.publisherId=pub.publisherId
    INNER JOIN events AS ev ON p.eventId=ev.eventId
    ORDER BY p.publicationDateTime DESC;";
    $result = mysqli_query($link, $query) or die("Query failed : " . mysqli_error($link));

    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) { 
	    	$img = $row["imgPath"];
	    	$params = array("publicationTitle" => $row["publicationTitle"]);?>
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
			        </div>
			    </div>

<?php
		}
	}
    mysqli_free_result($result);
    mysqli_close($link);
?>