<?php 

	$dbhost = "localhost";

	$dbuser = "root";

	$dbpass = "pogba";

	$db = "lottery_db";

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

	// return $conn ;

?>