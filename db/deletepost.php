<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['publisherId'])) {
    $pubId = $_GET['publicationId'];
    $username = $arrayName = array('username' => $_GET['username']);
	$link = mysqli_connect("localhost", "root", "", "mediamanager")
        or die("Could not connect : " . mysqli_error());
    $delete = "DELETE FROM publications WHERE publicationId='$pubId';";
    mysqli_query($link, $delete) or trigger_error("Query: $insert MySQL Error: " . mysqli_error($link));
    mysqli_close($link);
    header('Location: ../mypublications.php?'.http_build_query($username));
}
?>