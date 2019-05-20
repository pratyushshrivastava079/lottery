<?php 

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['userid'])){

		$id = mysqli_real_escape_string( $conn, $_POST['userid'] );

		$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$id'";

		// echo $sql;

		// die();
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;


	            	}

	            }

	            if(!is_null($users)){

	            	echo json_encode(array('status'=>'success', 'users' => $users));
	            	
	            }else{

	            	echo json_encode(array('status'=>'error', 'users' => $users));

	            }


	}


}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	echo "not allowed";

}



?>