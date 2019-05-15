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

	$balanceKHR = mysqli_real_escape_string( $conn, $_POST['balanceKHR']);

	$userid = mysqli_real_escape_string( $conn, $_POST['userid']);
	
	$addedby = mysqli_real_escape_string( $conn, $_POST['addedby']);

	if($refUID == ""){

		$_SESSION['refUID'] = "RefUID cannot be empty.";
									header("Location: edit-users.php?id=$userid&error=RefUID cannot be empty.");
	
	}

	if($username == ""){

		$_SESSION['username'] = "Username cannot be empty.";
									header("Location: edit-users.php?id=$userid&error=Username cannot be empty.");
	
	}

	if($password == ""){

		$_SESSION['password'] = "Password cannot be empty.";
									header("Location: edit-users.php?id=$userid&error=Password cannot be empty.");

	}

	if($userlevel == ""){

		$_SESSION['userlevel'] = "Userlevel cannot be empty.";
									header("Location: edit-users.php?id=$userid&error=Userlevel cannot be empty.");

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

		$_SESSION['address'] = "Userpercent cannot be empty.";
									header("Location: edit-users.php?id=$userid&error=Userpercent cannot be empty.");

	}

	if( $userlevel == "A1" || $userlevel == "A2" || $userlevel == "A3"){

			if($username != "" && $password != "" && $userlevel != "" && $userpercent != "" && $refUID != ""){

				$added_by = $refUID;

				$password = md5($password);

				$uidusers = array();

				$uidsql = "SELECT * FROM `users` WHERE `username` = '$refUID'";
				        
				$uidresult = mysqli_query($conn, $uidsql);

				if (mysqli_num_rows($uidresult) > 0) {

					while( $uidrow = mysqli_fetch_assoc($uidresult)){

						$uidusers[] = $uidrow;
					}
					// print_r($uidusers);
					// die();

					$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
					        
					$result = mysqli_query($conn, $sql);

					// if (mysqli_num_rows($result) > 0) {

						// $error['error'] = "Username already exists in database.";

				    // }else{

				    	$id = $_SESSION['userid'];

				    	$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
						
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {

							while($row = mysqli_fetch_assoc($result)) {
		            	
				        		$users[] = $row;

		            		}

		            		$added_by = $uidusers[0]['added_by'];

		            		// print_r($uidusers);
		            		// die();

							$query= "UPDATE users SET username = '$username', password = '$password', userlevel = '$userlevel', userpercent = '$userpercent', fullname = '$fullname', phone = '$phone', address = '$address', added_by = '$addedby', balanceUSD = '$balanceUSD', balanceKHR = '$balanceKHR' WHERE id='$userid'";

							// print_r($query);

							// die();

							if ($conn->query($query) === TRUE) {
								
							$_SESSION['success'] = "User updated successfully.";

														header("Location: edit-users.php?id=$userid&success=User updated successfully.");
								
							} else {
										
								$_SESSION['error'] = "Unable to created user.";
															header("Location: edit-users.php?id=$userid&error=Unable to created user.");
									
							}

						}else{

							$_SESSION['error'] = "Error fetching addedby user details.";

														header("Location: edit-users.php?id=$userid&error=Error fetching addedby user details.");

						}


					// }

			    }else{

					$_SESSION['error'] = "RefUID does not exist in database. Please enter a valid RefUID username.";
												header("Location: edit-users.php?id=$userid&error=RefUID does not exist in database. Please enter a valid RefUID username.");
			    	
			    }
			}

		}elseif($userlevel == 'A4'){

			if( $balanceUSD == "" || $balanceKHR == ""){

				$_SESSION['error'] = "Either BalanceUSD or BalanceKHR cannot be 0 for level 4";
							header("Location: edit-users.php?id=$userid&error=Either BalanceUSD or BalanceKHR cannot be 0 for level 4.");				
			
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

						$_SESSION['error'] = "Username already exists in database.";
								header("Location: edit-users.php?id=$userid&error=Username already exists in database.");

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

							$query= "UPDATE users SET username = '$username', password = '$password', userlevel = '$userlevel', userpercent = '$userpercent', fullname = '$fullname', phone = '$phone', address = '$address', added_by = '$addedby', balanceUSD = '$balanceUSD', balanceKHR = '$balanceKHR' WHERE id='$userid'";

							if ($conn->query($query) === TRUE) {
								
							$_SESSION['success'] = "User created successfully.";

								header("Location: edit-users.php?id=$userid&success=User created successfully.");
								
							} else {
										
								$_SESSION['error'] = "Unable to created user.";
	
								header("Location: edit-users.php?id=$userid&error=Unable to create user.");
									
							}

						}else{

							$_SESSION['error'] = "Error fetching addedby user details.";
								header("Location: edit-users.php?id=$userid&error=error fetching added_by user details.");

						}

					    }

				}else{

					$_SESSION['error'] = "RefUID does not exist in database. Please enter a valid RefUID username.";
								header("Location: edit-users.php?id=$userid&error=RefUID does not exist in database. Please enter a valid RefUID username.");
					
				}

				}
			}

		}

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_SESSION['userid']) && isset($_SESSION['userlevel']) && isset($_GET['id'])){

		$userlevel = $_SESSION['userlevel'];

		if($userlevel == 'A1'){

			$id = $_GET['id'];

			$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
			        
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_assoc($result)) {
		            	
					$users[] = $row;

		            
		       	}

		       	$refuid = $users[0]['added_by'];

		       	$refsql = "SELECT * FROM `users` WHERE `id` = '$refuid'";
						
				$refresult = mysqli_query($conn, $refsql);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($refresult)) {
		            	
				    	$refusers[] = $row;

		            }

		        }else{

		            	$_SESSION['refUID'] = "RefUID is not found";
		       	}

				// print_r($users);
				// print_r($refusers);

	     	}else{

	     		$_SESSION['error'] = "No such user found";
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

		    			<span><a href="#">Reports</a></span>
		    			
		    			<span> | </span>

		      			<?php if(isset($_SESSION['userid'])){?>
		      				
			      			<span><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></span>
		      			
		      			<?php }else{?>

			      			<span><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></span>

		      			<?php }?>
	    			
		    	</div>


			<?php if(isset($_SESSION['refUID'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['refUID'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['username'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['username'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['password'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['password'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['userlevel'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['userlevel'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['fullname'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['fullname'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['phone'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['phone'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['address'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['address'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_SESSION['error'];?>

			</div>

			<?php }?>

			<?php if(isset($_SESSION['success'])){?>

			<div class="alert alert-success">
					
				<?php echo $_SESSION['success'];?>

			</div>

			<?php }?>						
				
				<form action="edit-users.php" method="POST">
		  		
			  		<div class="form-group">
			    	
			    		<!-- <label for="addedby">RefUID:</label> -->
			    		
			    		<?php if(isset($_SESSION['userdetails'])){?>
			    		
			    		<input type="text" class="form-control" name="refUID" placeholder="RefUID" value="<?php echo $refusers[0]['username'];?>" />

			    		<?php }?>
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="username">Username:</label> -->
			    	
			    		<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $users[0]['username'];?>">
			  		
			  		</div>
		  		
			  		<div class="form-group">
			    	
			    		<!-- <label for="pwd">Password:</label> -->
			    	
			    		<input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="pwd">User Level:</label> -->
			    	
			    		<select class="form-control" id="userlevel" name="userlevel">

			    			<?php if($users[0]['userlevel'] == "A1"){?>
					    
						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A1" selected="true">A1</option>
						    
						    	<option value="A2">A2</option>
						    
						    	<option value="A3">A3</option>
						    	
						    	<option value="A4">A4</option>

					    	<?php }elseif($users[0]['userlevel'] == "A2"){?>
						    	
						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A1">A1</option>
						    
						    	<option value="A2" selected="true">A2</option>
						    
						    	<option value="A3">A3</option>
						    	
						    	<option value="A4">A4</option>
						    	
					    	<?php }elseif($users[0]['userlevel'] == "A3"){?>

						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A1">A1</option>
						    
						    	<option value="A2">A2</option>
						    
						    	<option value="A3" selected="true">A3</option>
						    	
						    	<option value="A4">A4</option>

					    	<?php }elseif($users[0]['userlevel'] == "A4"){?>

						    	<option value="">--- User Level ---</option>
						    
						    	<option value="A1">A1</option>
						    
						    	<option value="A2">A2</option>
						    
						    	<option value="A3">A3</option>
						    	
						    	<option value="A4" selected="true">A4</option>



					    	<?php }?>
					   	
					  	</select>
			  		
			  		</div>

			  		<input type="hidden" name="userid" value="<?php echo $_GET['id'];?>">
			  		<input type="hidden" name="addedby" value="<?php echo $users[0]['added_by'];?>">

			  		<div class="form-group">
			    	
			    		<!-- <label for="fullname">Full Name:</label> -->
			    	
			    		<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" value="<?php echo $users[0]['username'];?>">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="fullname">Full Name:</label> -->
			    	
			    		<input type="text" class="form-control" id="userpercent" name="userpercent" placeholder="Userpercent" value="<?php echo $users[0]['userpercent'];?>">
			  		
			  		</div>

					<div class="form-group">
			    	
			    		<!-- <label for="phone">Phone:</label> -->
			    	
			    		<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $users[0]['phone'];?>">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $users[0]['address'];?>">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="balanceUSD" name="balanceUSD" placeholder="Balance USD" value="<?php echo $users[0]['balanceUSD'];?>">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<!-- <label for="address">Address:</label> -->
			    	
			    		<input type="text" class="form-control" id="balanceKHR" name="balanceKHR" placeholder="Balance KHR" value="<?php echo $users[0]['balanceKHR'];?>">
			  		
			  		</div>			  		
		  		
			  		<!-- <div class="checkbox">
			    	
			    		<label><input type="checkbox"> Remember me</label>
			  		
			  		</div> -->
			  		
			  		<p class="text-center pclass"><button type="submit" class="btn btn-default">Submit</button></p>
			
				</form>

			</div>

		</section>

	</div>

	<script type="text/javascript">
		
		$(function(){


			setInterval(function(){
		    
		      $.ajax({

		      	url: 'session_destroy.php',

		      	method: 'POST',

		      	data: {'id': 'id'},

		      	success: function(response){

		      		console.log(response);

		      		$('.alert-danger').css('display', 'none');
		      	}


		      });
    		
    		},5000); 

		});

	</script>

</body>
</html>