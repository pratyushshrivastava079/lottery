<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$counttxt2d = count($_POST['txt2d']);

	$countusd = count($_POST['usd']);

	$countkhr = count($_POST['khr']);

	// checks if one row or more than one row of a form has been posted //

	if($counttxt2d == 1 && $countkhr == 1 || $countusd == 1 ){

		$txt2d = mysqli_real_escape_string( $conn, $_POST['txt2d'][0] );
	
		$usd = mysqli_real_escape_string( $conn, $_POST['usd'][0] );
	
		$khr = mysqli_real_escape_string( $conn, $_POST['khr'][0] );

		$radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

		// check whether multiple checkbox or checkboxlevel has been posted //

		$countcheck = count($_POST['checkbox']);
		
		$stagecheck = count($_POST['Stage_checkbox']);


		if($txt2d == ""){

			$error['txt2d'] = "txt2d value cannot be empty"; 
		}

		if($txt2d != "" && ( $usd != "" || $khr != "") || ( $usd != "" && $khr != "")){

			if($countcheck == 0 && $stagecheck == 0){

				$error['checkbox'] = "Please select at least one of the checkbox";

			}elseif($countcheck > 0 || $stagecheck > 0){

				if( $countcheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

				}elseif($stagecheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

				}elseif($countcheck > 1){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

					}

				}

				// if some exception occurs about minimum and maximum value for txt2d value then validation should be put here. //

				$userid = $_SESSION['userid'];

				$order_id = uniqid();

				if(is_array($checkboxlevel)){

					$checkboxlevel = implode(',', $checkboxlevel);
					
				}

				if($usd == ""){

					$usd = 0;
				
				}elseif($khr == ""){

					$khr = 0;

				}

				// var_dump($radio);

				$newtxt2d = array();
				
				$incrementval = 0;

				if($radio == '5OD'){

					for($i = 0 ; $i < 5 ; $i++){

						$newtxt2d[$i] = $txt2d + 2;

						$txt2d = $newtxt2d[$i]; 
						
						$incrementval = 5; 
					}

				}elseif($radio == '5S'){

					for($i = 0 ; $i < 5 ; $i++){

						$newtxt2d[$i] = $txt2d + 1;

						$txt2d = $newtxt2d[$i]; 

						$incrementval = 5; 
					}

				}elseif($radio == '10S'){

					for($i = 0 ; $i < 10 ; $i++){

						$newtxt2d[$i] = $txt2d + 1;

						$txt2d = $newtxt2d[$i]; 

						$incrementval = 10; 

					}

				}

				// die(';eneter her');

				// print_r($incrementval);

				// die(); 

				// echo "txt2d is ".$txt2d;

				$arrayid = array();

				if($incrementval == 0){

				// echo "txt2d is ".$txt2d;
					$users = array(


							'user_id' => $userid,

							'order_id' => $order_id,

							'2dtxt' => $txt2d,

							'usd' => $usd,

							'khr' => $khr,

							'radiobox' => $radio,

							'checklevel' => $checkboxlevel 

						);

					$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel` ) VALUES( '$userid', '$order_id', '$txt2d', '$usd', '$khr', '$radio', '$checkboxlevel' )";
						// print_r($query);
						// die();
						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid = $last_id;


						} else {
													
							$error['error'] = "Unable to place bet.";
												
						}

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}
				
							$success['success'] = "Bet placed successfully.";


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }

				}elseif($incrementval > 0){


					for($j = 0; $j < $incrementval; $j++){

						$users[$j] = array(


							'user_id' => $userid,

							'order_id' => $order_id,

							'2dtxt' => $newtxt2d[$j],

							'usd' => $usd,

							'khr' => $khr,

							'radiobox' => $radio,

							'checklevel' => $checkboxlevel 

						);

						$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel` ) VALUES( '$userid', '$order_id', '$newtxt2d[$j]', '$usd', '$khr', '$radio', '$checkboxlevel' )";
						// print_r($query);
						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid[$j] = $last_id; 

							// $sql = "SELECT * FROM `2dbetform` WHERE `id` = '$last_id'";
					    	
						 //    $result = mysqli_query($conn, $sql);

						 //        if (mysqli_num_rows($result) > 0) {

					  //           	while($row = mysqli_fetch_assoc($result)) {
					            	
							//         	$order[] = $row;

					  //           	}
					
									// $success['success'] = "Bet placed successfully.";

					    //         }else{

									// $error['error'] = "Bet placed but unable to fetch last bid details.";
					            	
					    //         }
											

						} else {
													
							$error['error'] = "Unable to place bet.";
												
						}

					}
				}

				$countarrayid = count($arrayid);

				if($countarrayid == 5 || $countarrayid == 10){

					for($k = 0 ; $k < $countarrayid ; $k++){

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}
				
							$success['success'] = "Bet placed successfully.";


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }
					}
				}			
			}

		
		}else{

			$error['usdandkhrerror'] = "Either usd or khr must have a value."; 
		}

	}else{

		// echo $counttxt2d;

		// echo $countusd;

		// echo $countkhr;

		$txt2d = array();

		$usd = array();

		$khr = array();

		for( $i = 0 ; $i < $counttxt2d ; $i++){

			if($_POST['txt2d'][$i] == ""){

				$error['txt2d'] = "txt2d value row is empty.";
			
			}elseif($_POST['txt2d'][$i] != ""){

				$txt2d[$i] = mysqli_real_escape_string( $conn, $_POST['txt2d'][$i] );
				
			}else{

				$error['txt2d'] = "Something unexpected occured in txt2d value.";

			}

		}


		for( $i = 0 ; $i < $countusd ; $i++){

			if($_POST['usd'][$i] == ""){

				// $error['usd'] = "usd row is empty.";
			
			}elseif($_POST['usd'][$i] != ""){

				$usd[$i] = mysqli_real_escape_string( $conn, $_POST['usd'][$i] );
				
			}else{

				$error['usd'] = "Something unexpected occured in usd value.";

			}

		}


		for( $i = 0 ; $i < $countkhr ; $i++){

			if($_POST['khr'][$i] == ""){

				// $error['khr'] = "khr row is empty.";
			
			}elseif($_POST['khr'][$i] != ""){

				$khr[$i] = mysqli_real_escape_string( $conn, $_POST['khr'][$i] );
				
			}else{

				$error['khr'] = "Something unexpected occured in khr value.";

			}

		}

		$countcheck = count($_POST['checkbox']);

		$stagecheck = count($_POST['Stage_checkbox']);

		$arra = array();

		if($countcheck == 0 && $stagecheck == 0){

				$error['checkbox'] = "Please select at least one of the checkbox";

			}elseif($countcheck > 0 || $stagecheck > 0){

				if( $countcheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

				}elseif($stagecheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

				}elseif($countcheck > 1){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

						$arra[] = $checkboxlevel[$j];
					}

				}

			}

		if(!empty($usd) || !empty($khr)){

			// echo "row not empty";

			$userid = $_SESSION['userid'];

				$order_id = uniqid();

				if(is_array($arra)){

					$checkboxlevel = implode(',', $arra);
					
				}

		// check whether multiple checkbox or checkboxlevel has been posted //

		

			$radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

			if($radio != ""){

				$error['error'] = "Radio option cannot be selected in this case.";

			}elseif($radio == ""){

				for($j = 0 ; $j < $counttxt2d; $j++ ){

					if($usd[$j] == ""){

						$usd[$j] = 0;
					}

					if($khr[$j] == ""){

						$khr[$j] = 0;
					}

					$users[$j] = array(


							'user_id' => $userid,

							'order_id' => $order_id,

							'2dtxt' => $txt2d[$j],

							'usd' => $usd[$j],

							'khr' => $khr[$j],

							'radiobox' => $radio,

							'checklevel' => $checkboxlevel 

						);

						$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel` ) VALUES( '$userid', '$order_id', '$txt2d[$j]', '$usd[$j]', '$khr[$j]', '$radio', '$checkboxlevel' )";
						// print_r($query);
						// die();
						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid[$j] = $last_id; 

						} else {
													
							$error['error'] = "Unable to place bet.";
												
						}

				}

				$countarrayid = count($arrayid);


					for($k = 0 ; $k < $countarrayid ; $k++){

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}

							$success['success'] = "Bet placed successfully.";


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }
					}
			}		

		}

		$countcheck = count($_POST['checkbox']);
		
		$stagecheck = count($_POST['Stage_checkbox']);

		$arra = array();

		if($countcheck == 0 && $stagecheck == 0){

				$error['checkbox'] = "Please select at least one of the checkbox";

			}elseif($countcheck > 0 || $stagecheck > 0){

				// echo $countcheck."<br/>";

				// echo $stagecheck."<br/>";

				if( $countcheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

				}elseif($stagecheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

				}elseif($countcheck > 1){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

						$arra[] = $checkboxlevel[$j];
					}

				}

			}

			// echo gettype($checkboxlevel);
			// print_r($checkboxlevel);
			// print_r($arra);

			// print_r($checkboxlevel);

		if(!empty($usd) && !empty($khr)){

			$userid = $_SESSION['userid'];

				$order_id = uniqid();

				if(is_array($arra)){

					$checkboxlevel = implode(',', $arra);

				}else{

					// $checkboxlevel = explode(',', $checkboxlevel);
					// echo "not array";
				}

		// check whether multiple checkbox or checkboxlevel has been posted //


			$radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

			if($radio != ""){

				$error['error'] = "Radio option cannot be selected in this case.";

			}elseif($radio == ""){

				for($j = 0 ; $j < $counttxt2d; $j++ ){

					$users[$j] = array(


							'user_id' => $userid,

							'order_id' => $order_id,

							'2dtxt' => $txt2d[$j],

							'usd' => $usd[$j],

							'khr' => $khr[$j],

							'radiobox' => $radio,

							'checklevel' => $checkboxlevel 

						);

						$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel` ) VALUES( '$userid', '$order_id', '$txt2d[$j]', '$usd[$j]', '$khr[$j]', '$radio', '$checkboxlevel' )";
						// print_r($query);
						// die();
						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid[$j] = $last_id; 

						} else {
													
							$error['error'] = "Unable to place bet.";
												
						}

				}

				$countarrayid = count($arrayid);

					for($k = 0 ; $k < $countarrayid ; $k++){

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}
				
							$success['success'] = "Bet placed successfully.";


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }
					}

			}
			
		}
	
	}


	// end of form parameters //

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_SESSION['userid'])){

	$id = $_SESSION['userid'];

	$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
			        
			        $result = mysqli_query($conn, $sql);

			        if (mysqli_num_rows($result) > 0) {

		            	while($row = mysqli_fetch_assoc($result)) {
		            	
				        	// $_SESSION['userid'] = $row['id'];

				        	// print_r($row);

		            
		            	}


		            }

	}else{

		header("Location: login.php");

	}

}



;?>


<!DOCTYPE html>
<html>
<head>

	<title>2D Betform | Lottery System</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous"></script>

	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	  <style type="text/css">
	  	
	  	.form-group{

	  			width: 25%;
	  			display: inline-block!important;
	  			margin: 1.5%;
	  		}

	  		#add{

	  			display: inline-block;
	  			width: 3.5%;
	  		}

	  		.fields{

	  			margin-left:0.7%;
	  			width: 101%;
	  		}

	  		.pclass{

	  			width: 20%;
	  			display: inline-block!important;
	  		}

	  		.first-line{

	  			border: 1px solid #d2d2d2;
	  			padding: 2%;
	  			border-radius: 5px; 
	  		}

	  		.navbar-nav{

	 		width: 100%!important;
	 		/*text-align: center;*/
	 	}

	 	.navbar-header{

	 		width: 30%;
	 		display: inline-block;
	 	}

	 	.caps{

	 		display: inline-block!important;
	 		width: 68%;
	 		text-align: center;
	 	}

	 	.navbars-brand, .navbar-header{

		    height: 50px;
		    padding: 15px 15px;
		    font-size: 18px;
		    line-height: 20px;
	 	
	 	}

	 	.row.text-center{
	 		padding: 10px 0px
	 	}

	 	.left,.middle,.right-account{

	 		display: inline-block;
	 		/*width: 32%;*/
	 	}

	 	.right-account{

	 		text-align: right;
	 		width: 20%;
	 	}

	 	.middle, .right-account{

	 		padding: 15px 15px;
	 	}


	 	.left{

	 		width: 10%;
	 	}

	 	.middle{

	 		width: 68%;
	 		text-align: center;
	 	}

	 	#screen-view-container{

	 		text-align: right;
	 		margin: 15px;
	 	}

	 	.checkbox label, .radio label{

	 		padding: 10px 10px;
	 	}


	 	.radio, .checkbox{

	 		margin-left:10px;
	 	}

	 	@media only screen and (max-width: 768px) {
		
		.right-account{

	 		width: 30%;
	 	}

	 	.middle{

	 		width: 64%;
	 	}

	 	.last-checkbox{

	 		margin-left: 0px!important;
	 	}
		
		}

	  </style>

</head>
<body>

	<header>		
			
		<nav class="navbar navbar-default">
  				
  			<div class="container">
    			
	    		<div class="navbar-header left">
	      				
	    			<a href="login.php"><i class="fa fa-home" aria-hidden="true"></i></a>
				
	    		</div>
					
				<div class="caps middle">

					<span><?php $today = date("d / m / Y h:i:s A"); echo $today; ?></span>

		    	</div>

		    	<div class="right-account">
		    		
		      			<?php if(isset($_SESSION['userid'])){?>
		      				
			      			<span><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></span>
		      			
		      			<?php }else{?>

			      			<span><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></span>

		      			<?php }?>


		    	</div>
		  	
		  	</div>

		</nav>

	</header>

	<div class="container">
	
		<section>

			<?php if(isset($success['success'])){?>

			<div class="alert alert-success">
					
				<?php echo $success['success'];?>

			</div>

			<?php }?>


			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>


			<?php if(isset($error['txt2d'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['txt2d'];?>

			</div>

			<?php }?>

			<?php if(isset($error['usdandkhrerror'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usdandkhrerror'];?>

			</div>

			<?php }?>


			<?php if(isset($error['usd'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usd'];?>

			</div>

			<?php }?>


			<?php if(isset($error['usd'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usd'];?>

			</div>

			<?php }?>

			<?php if(isset($error['checkbox'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['checkbox'];?>

			</div>

			<?php }?>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<div class="row text-center">

		      			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span><a href="users.php">Users</a></span>

		    			<span> | </span>

		    			<span><a href="add-users.php">Add Users</a></span>

		    			<?php }?>
		      				
		    			<span> | </span>

		    			<span><a href="2d1-betform.php">2D S1</a></span>
		    		
		    			<span> | </span>
		    		
		    			<span><a href="2d2-betform.php">2D S2</a></span>

		    			<span> | </span>
		    			
		    			<span><a href="3d1-betform.php">3D S1</a></span>
		    		
		    			<span> | </span>

		    			<span><a href="3d2-betform.php">3D S2</a></span>
		    			
		    			<span> | </span>
		    			
		    			<span><a href="#">Results</a></span>
		    			
		    			<span> | </span>

		    			<span><a href="#">Reports</a></span>
		    			
		    	</div>

		    	<div>
		    		
		      		<?php if(isset($success['success'])){

						// check if only one row is inserted //
						$count = count($order);

						if($count == 1){

							$checkorder = explode(',', $order[0]['checklevel']); 

							$countcheckorder = count($checkorder);

							if($checkorder[0] == 'l23'){

								$countcheckorder = 23;
							
							}elseif($checkorder[0] == 'l25'){

								$countcheckorder = 25;

							}elseif($checkorder[0] == 'l27'){

								$countcheckorder = 27;
								
							}elseif($checkorder[0] == 'l29'){

								$countcheckorder = 29;
								
							}

							if($order[0]['usd'] != 0.00 && $order[0]['khr'] != 0.00){

								echo "sdss";

								$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

							}elseif($order[0]['usd'] != 0.00 || $order[0]['khr'] != 0.00){

								$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;


							 }elseif($order[0]['usd'] != 0.00 || $order[0]['khr'] == 0.00){

							 	echo "khr zero";
							
							 }elseif($order[0]['khr'] != 0.00 || $order[0]['usd'] == 0.00){

							 	echo "usd zero";
							 }				


						?>


						<div id='screen-view-container'><input type='button' value='Print' onclick="javascript:printerDiv('print-table-up')" /></div>

							<div class="table-responsive" id="print-table-up">          
							
							  	<table class="table table-primary">
							
								    <thead>
							
								      <tr class="table-primary">
								        <th>2d</th>
								        <th>USD</th>
								        <th>KHR</th>
								        <th>PO</th>
								      </tr>
							
								    </thead>
							
								    <tbody>
								      <tr>
								      	<td><?php echo $order[0]['2dtxt'];?></td>
								      	<td><?php echo $order[0]['usd'];?></td>
								      	<td><?php echo $order[0]['khr'];?></td>
								      	<td>( <?php echo $order[0]['checklevel'];?> )</td>
								      </tr>

								      <tr>
								      	<td>Total</td>
								      	<td><?php echo $finalvalueusd;?></td>
								      	<td><?php echo $finalvaluekhr;?></td>
								      	<td><?php echo $order[0]['created_at'];?></td>
								      </tr>
							
								    </tbody>
							
								</table>
							
							</div>

						<?php }elseif($count > 1){?>

							<?php $count; 

							$finalvalueusd = 0;

							$finalvaluekhr = 0;
							// echo "<pre>";
							// print_r($order);

							for($i = 0 ; $i < $count; $i++){

								$checkorder = explode(',', $order[$i]['checklevel']);

								// print_r($checkorder);
								
								$countcheckorder = count($checkorder);

								if($checkorder[$i] == 'l23'){

									$countcheckorder = 23;
								
								}elseif($checkorder[$i] == 'l25'){

									$countcheckorder = 25;

								}elseif($checkorder[$i] == 'l27'){

									$countcheckorder = 27;
									
								}elseif($checkorder[$i] == 'l29'){

									$countcheckorder = 29;
									
								}

								// if($order[0]['usd'] != 0.00){

								// 	$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								// }elseif($order[0]['khr'] != 0.00){

								// 	$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

								// }else

								if($order[$i]['usd'] != 0.00 && $order[$i]['khr'] != 0.00){

									$finalvalueusd = $order[$i]['usd'] * $countcheckorder * $count;

									$finalvaluekhr = $order[$i]['khr'] * $countcheckorder * $count;

								}elseif($order[$i]['usd'] != 0.00 || $order[$i]['khr'] != 0.00){

									$finalvalueusd = $order[$i]['usd'] * $countcheckorder * $count;

									$finalvaluekhr = $order[$i]['khr'] * $countcheckorder * $count;


								}elseif($order[$i]['usd'] != 0.00 || $order[$i]['khr'] == 0.00){

									$finalvalueusd = $order[$i]['usd'] * $countcheckorder * $count;

									$finalvaluekhr = $order[$i]['khr'] * $countcheckorder * $count;
								
								}elseif($order[$i]['khr'] != 0.00 || $order[$i]['usd'] == 0.00){

									$finalvalueusd = $order[$i]['usd'] * $countcheckorder * $count;

									$finalvaluekhr = $order[$i]['khr'] * $countcheckorder * $count;

								 }

								 // print_r($finalvaluekhr);
								 // echo "<br/>";
								 // print_r($finalvalueusd);

							}	


							 ?>

							<div id='screen-view-container'><input type='button' value='Print' onclick="javascript:printerDiv('print-table')" /></div>

								<div class="table-responsive" id="print-table">          
							
							  	<table class="table table-primary">
							
								    <thead>
							
								      <tr class="table-primary">
								        <th>2d</th>
								        <th>USD</th>
								        <th>KHR</th>
								        <th>PO</th>
								      </tr>
							
								    </thead>
							
								    <tbody>

								<?php foreach ($order as $key => $value) {?>
								
								      <tr>
								      	<td><?php echo $value['2dtxt'];?></td>
								      	<td><?php echo $value['usd'];?></td>
								      	<td><?php echo $value['khr'];?></td>
								      	<td>( <?php echo $value['checklevel'];?> )</td>
								      </tr>

								<?php }?>

								      <tr>
								      	<td>Total</td>
								      	<td><?php echo $finalvalueusd;?></td>
								      	<td><?php echo $finalvaluekhr;?></td>
								      	<td><?php echo $order[0]['created_at'];?></td>
								      </tr>
							
								    </tbody>
							
								</table>
							
							</div> 

			      		<?php  } }?>		    		

		    	</div>
				
				<form action="2d1-betform.php" method="POST">
	              
	              	<input type="hidden" id="lastStage" value="1" />
		            
		            <div class="card-header"><h3 id="Stage" data-Stage="1">Stage 1</h3></div>

	              	<div class="first-line">

	              		<div class="field">
			                
			                <span class="btn btn-primary" id="add" data-level="1">+</span>
			                
			                <div class="form-group">
			                
			                  	<input type="text" id="2d1" class="form-control 2d" name="txt2d[]" placeholder="2D value">
			                
			                </div>

			                <div class="form-group">
		                
			                  	<input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="USD">
		                
		                	</div>

		                	<div class="form-group">
		                
		                  		<input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="KHR">
		                
		                	</div>

		              	</div>

		             </div>

		  	            <div class="radio">

			                <label class="radio-inline"><input type="radio" name="optradio" value="5OD">5 OD</label>
			              
			                <label class="radio-inline"><input type="radio" name="optradio" value="5S">5 S</label>
			              
			            	<label class="radio-inline"><input type="radio" name="optradio" value="10S">10 S</label>

			            </div>

			            <div class="checkbox">
	                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="A" name="checkbox[]" id="A">A</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="B" name="checkbox[]" id="B">B</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="C" name="checkbox[]" id="C">C</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="D" name="checkbox[]" id="D">D</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="H" name="checkbox[]" id="H">H</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="F" name="checkbox[]" id="I">I</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="N" name="checkbox[]" id="N">N</label>

	         		    </div>

	               			<input type="hidden" value="" id="checkbox-val">

	              		<div class="checkbox">
	                
			                <label class="checkbox-inline"><input type="checkbox" id="l23" value="l23" class="checkStage" name="Stage_checkbox[]">L 23</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" id="l25" value="l25" class="checkStage" name="Stage_checkbox[]">L 25</label>

			                <label class="checkbox-inline"><input type="checkbox" id="l27" value="l27" class="checkStage" name="Stage_checkbox[]">L 27</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" id="l29" value="l29" class="checkStage" name="Stage_checkbox[]">L 29</label>

			                 <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="K" name="checkbox[]" id="K">K</label>

			                <label class="checkbox-inline last-checkbox"><input type="checkbox" class="singleCheckbox" value="O" name="checkbox[]" id="0">O</label>
			                
			            </div>

			            <button type="submit" class="btn btn-primary">Submit</button>
	            
	            	</div>

	            </form>            

			</div>

		</section>

	</div>


<script type="text/javascript">

	$(document).ready(function(){

		var ab  = $.now();

		var date = new Date(ab*1000);

		console.log(date);

		var level = 1;

 		$(document).on('click', '#add', function(event){

 			event.preventDefault();

 			$('.first-line').append('<div class="fields"><span class="btn btn-primary plus-sign" style="visibility:hidden;">+</span><div class="form-group"> <input type="text" id="2d1" class="form-control 2d" name="txt2d[]" placeholder="2D value"> </div><div class="form-group"> <input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="USD"> </div><div class="form-group"> <input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="KHR"> </div></div>');

 			level++

		});

 	});

  $(document).on('click', '.radio-inlines', function(){

     var d2val = $('#2d1').val();

      var usdval = $('#usd1').val();

      var khrval = $('#khr1').val();

      // console.log(d3val);

      // console.log(usdval);

      // console.log(khrval);

      $('#lastlevel').val('1');

      $('.first-line').html(' <div class="card-header"><h3 id="level" data-level="1">Level 1</h3></div><div class="form-group"> <label for="2d">2D:</label> <input type="text" id="2d1" class="form-control 2d" name="txt2d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+d2val+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usdval+'"> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khrval+'"> </div>');

    });


  $(document).on('keypress', '.2d', function(event){

        var data = $(this).attr('id');

        var targetValue = $(this).val();

        if (event.which ===8 || event.which === 13 || event.which === 37 || event.which === 39 || event.which === 46) { 
          return;

        }

       if (event.which > 47 &&  event.which < 58  && targetValue.length < 2) {
        
          var c = String.fromCharCode(event.which);

          var val = parseInt(c);
        
          var textVal = parseInt(targetValue || "0");
        
          var result = textVal + val;

          if (result < 0 || result > 99) {
        
             event.preventDefault();
        
          }

          if (targetValue === "0") {
        
            $(this).val(val);
        
            event.preventDefault();
        
          }
       
       }
       
       else {
       
           event.preventDefault();
       
       }


    });

  $(document).on('keypress', '.usd', function(event){

        var data = $(this).attr('id');

        var targetValue = $(this).val();

        console.log(targetValue);

        console.log(event.keyCode);

        if (event.which ===8 || event.which === 13 || event.which === 37 || event.which === 39 || event.which === 46) { 
          return;

        }

        // if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          
        //   event.preventDefault();
        
        // }else{
        
        if (event.which > 47 &&  event.which < 58  && targetValue.length < 6) {
        
          var c = String.fromCharCode(event.which);

          var val = parseInt(c);
        
          var textVal = parseInt(targetValue || "0");
        
          var result = textVal + val;

          if (result < 0 || result > 99) {
        
             event.preventDefault();
        
          }

          if (targetValue === "0") {
        
            $(this).val(val);
        
            event.preventDefault();
        
          }
       
       }

       
       else {
       
           event.preventDefault();
       
       }

    });

  $(document).on('click', '.checkStage', function(){

 var checked = $(this).prop('checked');

 console.log("stage check is " + checked);

    if(checked){

      var checkboxValue = $(this).val();

      $('#checkbox-val').val(checkboxValue);

      console.log(checkboxValue);

      if(checkboxValue == 'l23'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);
  
        $('#l25').prop('checked', false);
        
        $('#l27').prop('checked', false);
        
        $('#l29').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'l25'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);

        $('#l23').prop('checked', false);
        
        $('#l27').prop('checked', false);
        
        $('#l29').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'l27'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#F').prop('checked', false);

        $('#l23').prop('checked', false);
        
        $('#l25').prop('checked', false);
        
        $('#l29').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'l29'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#F').prop('checked', false);
        
        $('#N').prop('checked', false);

        $('#l23').prop('checked', false);
        
        $('#l25').prop('checked', false);
        
        $('#l27').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }

    }else{

      console.log('checkbox unclicked');

      $('#checkbox-val').val('lower');

    }

  });


  $(document).on('click', '.singleCheckbox', function(){

     var checked = $(this).prop('checked');

     console.log("checked is " + checked);

     var value = $(this).val();

     console.log("checked value is " + value);

     var levelval = $('#checkbox-val').val();

     console.log('level val is ' + levelval);

     if(checked == true && levelval == 'l23'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);
     	
     }else if(checked == true && levelval == 'l25'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);

     }else if(checked == true && levelval == 'l27'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#F').prop('checked', false);

     }else if(checked == true && levelval == 'l29'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#F').prop('checked', false);
        
        $('#N').prop('checked', false);

     }

    // if(checked){

    //     $('#checkbox-val').val('upper');
        
    //     $('#l23').prop('checked', false);

    //     $('#l25').prop('checked', false);

    //     $('#l27').prop('checked', false);

    //     $('#l29').prop('checked', false);

    // }else{

    //     console.log('checkbox unclicked');

    //     $('#checkbox-val').val('lower');

    //     console.log($('#checkbox-val').val());

    // }

  });

	</script>

	<script language="javascript" type="text/javascript">
		
		function printerDiv(divID) {
		//Get the HTML of div

		var divElements = document.getElementById(divID).innerHTML;

		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;

		//Reset the pages HTML with divs HTML only

		     document.body.innerHTML = 

		     "<html><head><title></title></head><body>" + 
		     divElements + "</body>";



		//Print Page
		window.print();

		//Restore orignal HTML
		document.body.innerHTML = oldPage;

		}
	
	</script>



</body>
</html>