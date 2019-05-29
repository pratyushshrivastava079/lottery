<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$refUID = mysqli_real_escape_string( $conn, $_POST['refUID']);

	$username = mysqli_real_escape_string( $conn, $_POST['username']);

	$password = mysqli_real_escape_string( $conn, $_POST['password']);

	$userlevel = mysqli_real_escape_string( $conn, $_POST['userlevel']);

	$userpercent = mysqli_real_escape_string( $conn, $_POST['userpercent']);

	$fullname = mysqli_real_escape_string( $conn, $_POST['fullname']);

	$phone = mysqli_real_escape_string( $conn, $_POST['phone']);

	$address = mysqli_real_escape_string( $conn, $_POST['address']);
	
	$balanceUSD = mysqli_real_escape_string( $conn, $_POST['balanceUSD']);
	
	$balanceKHR = mysqli_real_escape_string( $conn, $_POST['balanceKHR']);

	if($refUID == ""){

		$error['refUID'] = "RefUID cannot be empty.";
	
	}

	if($username == ""){

		$error['username'] = "Username cannot be empty.";
	
	}

	if($password == ""){

		$error['password'] = "Password cannot be empty.";

	}

	if($userlevel == ""){

		$error['userlevel'] = "Userlevel cannot be empty.";

	}

	// if($fullname == ""){

	// 	$error['fullname'] = "Fullname cannot be empty.";

	// }

	// if($phone == ""){

	// 	$error['phone'] = "Phone cannot be empty.";

	// }

	// if($address == ""){

	// 	$error['address'] = "Address cannot be empty.";

	// }

	if($userpercent == ""){

		$error['address'] = "Userpercent cannot be empty.";

	}

	if( $userlevel == "A1" || $userlevel == "A2" || $userlevel == "A3"){

			if($username != "" && $password != "" && $userlevel != "" && $userpercent != "" && $refUID != ""){

				$added_by = $refUID;

				$password = md5($password);

				$sql = "SELECT * FROM `users` WHERE `username` = '$refUID'";
				        
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
					        
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

						$error['error'] = "Username already exists in database.";

				    }else{

				    	$id = $_SESSION['userid'];

				    	$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
						
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {

							while($row = mysqli_fetch_assoc($result)) {
		            	
				        		$users[] = $row;

		            		}

							$query= "INSERT INTO users( username, password, userlevel, userpercent, fullname, phone, address, added_by, balanceUSD, balanceKHR) VALUES( '$username', '$password', '$userlevel', '$userpercent', '$fullname', '$phone', '$address', '$added_by', '$balanceUSD', '$balanceKHR' )";

							if ($conn->query($query) === TRUE) {
								
							$success['success'] = "User created successfully.";
								
							} else {
										
								$error['error'] = "Unable to created user.";
									
							}

						}else{

							$error['error'] = "Error fetching addedby user details.";

						}


					}

			    }else{

					$error['error'] = "RefUID does not exist in database. Please enter a valid RefUID username.";
			    	
			    }
			}

		}elseif($userlevel == 'A4'){

			if( $balanceUSD == "" || $balanceKHR == ""){

				$error['error'] = "Either BalanceUSD or BalanceKHR cannot be 0 for level 4";
			
			}else{

				if($username != "" && $password != "" && $userlevel != "" && $userpercent != ""){

				$added_by = $refUID;

				$password = md5($password);

				$sql = "SELECT * FROM `users` WHERE `username` = '$refUID'";
				        
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
				        
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

						$error['error'] = "Username already exists in database.";

				    }else{

				    	$id = $_SESSION['userid'];

				    	$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
						
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {

							while($row = mysqli_fetch_assoc($result)) {
		            	
				        		$users[] = $row;

		            		}

		            		$addedby = $users[0];

		            		$added_by = $addedby['username'];

							$query= "INSERT INTO users( username, password, userlevel, userpercent, fullname, phone, address, added_by, balanceUSD, balanceKHR) VALUES( '$username', '$password', '$userlevel', '$userpercent', '$fullname', '$phone', '$address', '$added_by', '$balanceUSD', '$balanceKHR' )";

							if ($conn->query($query) === TRUE) {
								
							$success['success'] = "User created successfully.";
								
							} else {
										
								$error['error'] = "Unable to created user.";
									
							}

						}else{

							$error['error'] = "Error fetching addedby user details.";

						}

					    }

				}else{

					$error['error'] = "RefUID does not exist in database. Please enter a valid RefUID username.";
					
				}

				}
			}

		}

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_SESSION['userid']) && ( $_SESSION['userlevel'] == 'A1') ){

		$id = $_SESSION['userid'];

		$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
		        
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	$_SESSION['userdetails'] = $row;

			        	// print_r($row);

	            
	            	}


	            }

	}else{

		header("Location: login.php");

	}

}else{

	echo "Invalid Request Method";
}

;?>


<!DOCTYPE html>
<html>
<head>

	<title>Add Users | Lottery System</title>

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

	  			width: 48%;
	  			display: inline-block!important;
	  			margin-right: 1%;
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

		    			<span><a href="reports.php">Reports</a></span>
		    			
		    			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span> | </span>

		    			<span><a href="disable.php">Disable check boxes</a></span>

		    			<?php }?>

	    			
		    	</div>

			<?php if(isset($error['refUID'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['refUID'];?>

			</div>

			<?php }?>

			<?php if(isset($error['username'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['username'];?>

			</div>

			<?php }?>

			<?php if(isset($error['password'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['password'];?>

			</div>

			<?php }?>

			<?php if(isset($error['userlevel'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['userlevel'];?>

			</div>

			<?php }?>

			<?php if(isset($error['fullname'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['fullname'];?>

			</div>

			<?php }?>

			<?php if(isset($error['phone'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['phone'];?>

			</div>

			<?php }?>

			<?php if(isset($error['address'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['address'];?>

			</div>

			<?php }?>

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<?php if(isset($success['success'])){?>

			<div class="alert alert-success">
					
				<?php echo $success['success'];?>

			</div>

			<?php }?>						
				
				<form action="add-users.php" method="POST">
		  		
			  		<div class="form-group">
			    	
			    		<!-- <label for="addedby">RefUID:</label> -->
			    		
			    		<?php if(isset($_SESSION['userdetails'])){?>
			    		
			    		<input type="text" class="form-control" name="refUID" placeholder="RefUID" />

			    		<?php }?>
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="username">Username:</label> -->
			    	
			    		<input type="text" class="form-control" id="username" name="username" placeholder="Username">
			  		
			  		</div>
		  		
			  		<div class="form-group">
			    	
			    		<!-- <label for="pwd">Password:</label> -->
			    	
			    		<input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="pwd">User Level:</label> -->
			    	
			    		<select class="form-control" id="userlevel" name="userlevel">

			    			<?php if($_SESSION['userlevel'] == "A1"){?>
					    
						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A1">A1</option>
						    
						    	<option value="A2">A2</option>
						    
						    	<option value="A3">A3</option>
						    	
						    	<option value="A4">A4</option>

					    	<?php }elseif($_SESSION['userlevel'] == "A2"){?>
						    	
						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A3">A3</option>
						    	
					    	<?php }?>
					   	
					  	</select>
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="fullname">Full Name:</label> -->
			    	
			    		<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="fullname">Full Name:</label> -->
			    	
			    		<input type="text" class="form-control" id="userpercent" name="userpercent" placeholder="Userpercent">
			  		
			  		</div>

					<div class="form-group">
			    	
			    		<!-- <label for="phone">Phone:</label> -->
			    	
			    		<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="address" name="address" placeholder="Address">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="balanceUSD" name="balanceUSD" placeholder="Balance USD">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="balanceKHR" name="balanceKHR" placeholder="Balance KHR">
			  		
			  		</div>			  		
		  		
			  		<!-- <div class="checkbox">
			    	
			    		<label><input type="checkbox"> Remember me</label>
			  		
			  		</div> -->
			  		
			  		<p class="text-center pclass"><button type="submit" class="btn btn-default">Submit</button></p>
			
				</form>

			</div>

		</section>

	</div>

</body>
</html>