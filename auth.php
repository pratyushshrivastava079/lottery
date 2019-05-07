<?php 

	$userid = $_SESSION['userid'];

	$sql = "SELECT * FROM `users` WHERE `id` = '$userid'";
			        
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
		            	
			// $_SESSION['userid'] = $row['id'];

			// var_dump($row);
    
    	}


	}else{

		header("Location: logout.php");

	}





?>