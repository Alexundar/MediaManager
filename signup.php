<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbc = mysqli_connect('localhost', 'root', '', 'mediamanager') or die("Could not connect : " . mysqli_error());
if(isset($_POST['submit'])){
	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
		$query = "SELECT * FROM publishers WHERE username = '$username'";
		$data = mysqli_query($dbc, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO publishers (publisherName, username, password) VALUES ('$name', '$username', SHA('$password2'))";
			mysqli_query($dbc,$query) or trigger_error("Query: $query MySQL Error: " . mysqli_error($dbc));
			mysqli_close($dbc);
			header('Location: signin.php');
		}
		else {
			echo 'This login already exits';
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
	<title>Sign up</title>
</head>
<body>
	<?php require "blocks/header.php"?>
	<div class="container">
			<h3>Sign up</h3>
			<div class="d-flex flex-wrap">
				<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="form-group">
		  				<label for="username" class="sr-only">Username:</label>
		  				<input type="text" name="username" class="form-control mt-4" placeholder="Username">
	  				</div>
	  				<div class="form-group">
		  				<label for="name" class="sr-only">Your Name:</label>
		  				<input type="text" name="name" class="form-control mt-4" placeholder="Your name">
	  				</div>
	  				<div class="form-group">
		  				<label for="password" class="sr-only">Password</label>
		  				<input type="password" name="password1" class="form-control mt-4" placeholder="Password">
	  				</div>
	  				<div class="form-group">
		  				<label for="password" class="sr-only">Repeate your rassword</label>
		  				<input type="password" name="password2" class="form-control mt-4" placeholder="Repeate your password">
	  				</div>
	  				<button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="submit">Sign up</button>
				</form>
			</div>
		</div>
</body>

</html>