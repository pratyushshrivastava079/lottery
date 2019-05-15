<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "not allowed";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_SESSION['userid']) && isset($_GET['id'])){

		$id = $_GET['id'];

		$sql = "SELECT * FROM `users` WHERE `id` = '$id'";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0) {

			// while($row = mysqli_fetch_assoc($result)) {
		            	
			// 	$users[] = $row;
        
		 //    }

		    // print_r($users);

		    $delete = "DELETE FROM `users` WHERE id= '$id'";

			if ($conn->query($delete) === TRUE) {

			    header('Location: users.php?msg="User deleted successfully."');

			} else {

			    header('Location: users.php?msg="Some error occurred."');

			}

		}else{

			    header('Location: users.php?msg="No user found."');
		}

	}

}else{

	echo "Invalid Request Method";
}

;?>