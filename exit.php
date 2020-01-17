<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header( 'Location: http://localhost/mediamanager/index.php', true, 303 );
//header("Cache-Control : no-store, no-cache, must-revalidate, max-age=0");
session_start();
setcookie ("publisherId", "", time()-14800);
setcookie ("username", "", time()-14800);
session_destroy();
exit;

?>