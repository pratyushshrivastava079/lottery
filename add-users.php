<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$username = mysqli_real_escape_string( $conn, $_POST['username']);

	$password = mysqli_real_escape_string( $conn, $_POST['password']);

	$userlevel = mysqli_real_escape_string( $conn, $_POST['userlevel']);

	$fullname = mysqli_real_escape_string( $conn, $_POST['fullname']);

	$phone = mysqli_real_escape_string( $conn, $_POST['phone']);

	$address = mysqli_real_escape_string( $conn, $_POST['address']);

	if($username == ""){

		$error['username'] = "Username cannot be empty.";
	
	}

	if($password == ""){

		$error['password'] = "Password cannot be empty.";

	}

	if($userlevel == ""){

		$error['userlevel'] = "Userlevel cannot be empty.";

	}

	if($fullname == ""){

		$error['fullname'] = "Fullname cannot be empty.";

	}

	if($phone == ""){

		$error['phone'] = "Phone cannot be empty.";

	}

	if($address == ""){

		$error['address'] = "Address cannot be empty.";

	}

	if($username != "" && $password != "" && $userlevel != "" && $fullname != "" && $phone != "" && $address != ""){

		$userpercent = "";

		$addedby = $_SESSION['userid'];

		$password = md5($password);

		if($userlevel == 'A1'){

			$userpercent = "";
		
		}elseif($userlevel == "A2"){

			$userpercent = "70%";
			
		}elseif($userlevel == "A3"){

			$userpercent = "72%";

		}

		$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
		        
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

		        	$error['error'] = "Username already exists in database.";

	            }else{

	            	$query= "INSERT INTO users( username, password, userlevel, userpercent, fullname, phone, address, added_by) VALUES( '$username', '$password', '$userlevel', '$userpercent', '$fullname', '$phone', '$address', '$addedby' )";

	            	if ($conn->query($query) === TRUE) {
					
					    $success['success'] = "User created successfully.";
					
					} else {
						
					    $error['error'] = "Unable to create user.";
					
					}

	            }
	
	}

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_SESSION['userid']) && $_SESSION['userlevel'] == 'A1'){

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

	<title>Logout | Lottery System</title>

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

</head>
<body>

	<header>		
			
		<nav class="navbar navbar-default">
  				
  			<div class="container">
    			
	    		<div class="navbar-header">
	      				
	    			<a class="navbar-brand" href="login.php">Lottery System</a>
	    			
	    			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
				
	    		</div>
					
				<div class="collapse navbar-collapse" id="myNavbar">

		    		<ul class="nav navbar-nav navbar-right">
		      				
		    			<li class="active"><a href="login.php">Home</a></li>
		      			
		      			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<li><a href="users.php">Users</a></li>

		    			<li><a href="add-users.php">Add Users</a></li>

		    			<?php }?>
		      				
		    			<li><a href="2d-betform.php">2D</a></li>
		    			
		    			<li><a href="3d-betform.php">3D</a></li>
		    			
		    			<li><a href="#">Results</a></li>
		    			
		    			<li><a href="#">Reports</a></li>

		      			<?php if(isset($_SESSION['userid'])){?>
		      				
			      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		      			
		      			<?php }else{?>

			      			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

		      			<?php }?>
	    			
		    		</ul>

		    	</div>
		  	
		  	</div>

		</nav>

	</header>

	<div class="container">
	
		<section>			

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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
			    	
			    		<label for="username">Username:</label>
			    	
			    		<input type="text" class="form-control" id="username" name="username">
			  		
			  		</div>
		  		
			  		<div class="form-group">
			    	
			    		<label for="pwd">Password:</label>
			    	
			    		<input type="password" class="form-control" id="pwd" name="password">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<label for="addedby">Added By:</label>
			    		
			    		<?php if(isset($_SESSION['userdetails'])){?>
			    		
			    		<span><strong><?php echo $_SESSION['userdetails']['username'];?></strong></span>

			    		<?php }?>
			  		
			  		</div>


			  		<div class="form-group">
			    	
			    		<label for="pwd">User Level:</label>
			    	
			    		<select class="form-control" id="userlevel" name="userlevel">
					    
					    	<option value="">--- Choose User Level ---</option>
					    
					    	<option value="A1">A1</option>
					    
					    	<option value="A2">A2</option>
					    
					    	<option value="A3">A3</option>
					   	
					  	</select>
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<label for="fullname">Full Name:</label>
			    	
			    		<input type="text" class="form-control" id="fullname" name="fullname">
			  		
			  		</div>

					<div class="form-group">
			    	
			    		<label for="phone">Phone:</label>
			    	
			    		<input type="text" class="form-control" id="phone" name="phone">
			  		
			  		</div>

			  		<div class="form-group">
			    	
			    		<label for="address">Address:</label>
			    	
			    		<input type="text" class="form-control" id="address" name="address">
			  		
			  		</div>			  		
		  		
			  		<!-- <div class="checkbox">
			    	
			    		<label><input type="checkbox"> Remember me</label>
			  		
			  		</div> -->
			  		
			  		<button type="submit" class="btn btn-default">Submit</button>
			
				</form>

			</div>

		</section>

	</div>

</body>
</html>