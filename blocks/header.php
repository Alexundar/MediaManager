<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  		<a class="my-0 mr-md-auto font-weight-normal" href="index.php">
  			<h5 >MediaManager</h5>
  		</a>
  		<nav class="my-2 my-md-0 mr-md-3">
  			<a class="p-2 text-dark" href="publishers.php">Publishers</a>
  		</nav>
  		<?php
		if(!isset($_COOKIE['publisherId'])) {
			?><a class="btn btn-outline-primary" href="signin.php">Sign in</a><?php
		}
  		else {
  			$params = array("username" => $_COOKIE["username"]);
  			?>
  			<a class="btn btn-outline-primary mr-3" href="mypublications.php?<?php echo http_build_query($params);?>">My publications</a>
  			<a class="btn btn-outline-primary mr-3" href="createpublication.php">Create publication</a>
  			<a class="btn btn-outline-primary mr-3" href="createevent.php">Create event</a>
  			<a class="btn btn-outline-primary" href="exit.php">Log out</a><?php
  		}
  		?>
  		
</div>