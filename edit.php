<?php 


include('database.php');

// if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['id']) && !empty($_POST['id'])){

		$id = mysqli_real_escape_string( $conn, $_POST['id'] );

		$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
			    
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

		    	while($row = mysqli_fetch_assoc($result)) {
		            	
				// $_SESSION['userdetails'] = $row;

				$users[] = $row;

				// print_r($row);

				}
		
			    echo json_encode(array('status'=> 'success', 'users' => $users));

		    }else{

			    echo json_encode(array('status'=> 'error'));

		    }

	}	

// }else{

// 	echo "method not allowed";
// }


	// if(isset($_POST['username-modal']) && isset($_POST['level-modal']) && isset($_POST['percent-modal']) && isset($_POST['userid'])){

	// 	echo "posted";

	// }else{

	// 	echo "not posted";
	// }	

?>