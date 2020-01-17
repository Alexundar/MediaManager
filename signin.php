<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbc = mysqli_connect('localhost', 'root', '', 'mediamanager')or die("Could not connect : " . mysqli_error());

if(!isset($_COOKIE['publisherId'])) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		if(!empty($user_username) && !empty($user_password)) {
			$query = "SELECT publisherId , username FROM publishers WHERE username = '$user_username' AND password = SHA('$user_password')";
			$data = mysqli_query($dbc,$query) or Trigger_error("Query: $query MySQL Error: " . mysqli_error($dbc));
			if(mysqli_num_rows($data) == 1) {
				$row = mysqli_fetch_assoc($data);
				print_r($row);
				setcookie('publisherId', $row['publisherId'], time() + (60*60*24*30));
				setcookie('username', $row['username'], time() + (60*60*24*30));
				$home_url = 'index.php';
				header('Location: '. $home_url);
			}
			else {
				echo 'Sorry, login or password is not correct';
			}
		}
		else {
			echo 'Sorry, fill all fields';
		}
	}
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
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<title>Sign in</title>
</head>
<body>
	<?php require "blocks/header.php"?>
	
	<div class="container">
		<h3>Sign in</h3>
		<div class="d-flex flex-wrap">
			<form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  				<div class="form-group">
		  			<label for="username" class="sr-only">Username:</label>
		  			<input type="text" name="username" class="form-control mt-4" placeholder="Username">
	  			</div>
	  			<div class="form-group">
		  			<label for="password" class="sr-only">Password</label>
		  			<input type="password" name="password" class="form-control mt-4" placeholder="Password">
	  			</div>
	  			<!--
  				<div class="checkbox mb-3">
    				<label>
      					<input type="checkbox" name="remember-me" value="remember-me"> Remember me
    				</label>
 	 			</div>
 	 		-->
  				<input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
			</form>
		</div>
		<a href="signup.php">Create an account</a>
	</div>
</body>
</html>