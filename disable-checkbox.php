<?php 


include('database.php');

	if(isset($_POST['id']) && !empty($_POST['id'])){

		$id = mysqli_real_escape_string( $conn, $_POST['id'] );
		$type = mysqli_real_escape_string( $conn, $_POST['type'] );
		$stage = mysqli_real_escape_string( $conn, $_POST['stage'] );

		$sql = "SELECT * FROM `checkbox_status` WHERE `checkbox` = '$id' AND `type` = '$type' AND `stage` = '$stage'";

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

		    	while($row = mysqli_fetch_assoc($result)) {
		            	
				$users[] = $row;

				if($row['status'] == '1'){

					$update = "UPDATE `checkbox_status` SET `STATUS` = 0 WHERE `checkbox` = '$id' AND `type` = '$type' AND `stage` = '$stage'";

					if ($conn->query($update) === TRUE) {				

						echo json_encode(array('status'=> 'disabled', 'users' => $users));
					
					}else{

						echo json_encode(array('status'=> 'error'));
					}
				
				}elseif($row['status'] == '0'){

					$update = "UPDATE `checkbox_status` SET `STATUS` = 1 WHERE `checkbox` = '$id' AND `type` = '$type' AND `stage` = '$stage'";

					if ($conn->query($update) === TRUE) {
						
						echo json_encode(array('status'=> 'enabled', 'users' => $users));

					}else{

						echo json_encode(array('status'=> 'error'));

					}
				}


			}
		}

	}		

?>