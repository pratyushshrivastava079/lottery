<?php 
	
	session_start();

	include('database.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		if(isset($_POST['username']) && isset($_POST['password'])){

			$error = array();

			$username = mysqli_real_escape_string( $conn, $_POST['username']);
			
			$password = mysqli_real_escape_string( $conn, $_POST['password']);

			if( $username == "" || $password == ""){

				$error['error'] = "Either username or password cannot be left blank.";

			}elseif($username != "" || $password != ""){

				$password = md5($password);

				$sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
		        
		        $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	$_SESSION['userid'] = $row['id'];

			        	header("Location: dashboard.php");

	            	}
	         	
	         	} else {
	            	
	            	$error['error'] = "The credential does not exist in our database.";
	         	}
		
		        mysqli_close($conn);

			}

		}else{

				$error['error'] = "Something unexpected occured.";

		}

	}else{


		if(isset($_SESSION['userid'])){

			header("Location: dashboard.php");

		}

	}



;?>


<!DOCTYPE html>
<html>
<head>
	
	<title>Login | Lottery System</title>
	
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

	<div class="container">

		<header></header>

		<section>

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<p><strong>Note: </strong>Test credentials: username - <strong>admin</strong> password - <strong>admin</strong>. Try with other credentials also.</p>

			<form action="login.php" method="POST">
		  		
		  		<div class="form-group">
		    	
		    		<label for="username">Username:</label>
		    	
		    		<input type="text" class="form-control" id="username" name="username">
		  		
		  		</div>
		  		
		  		<div class="form-group">
		    	
		    		<label for="pwd">Password:</label>
		    	
		    		<input type="password" class="form-control" id="pwd" name="password">
		  		
		  		</div>
		  		
		  		<!-- <div class="checkbox">
		    	
		    		<label><input type="checkbox"> Remember me</label>
		  		
		  		</div> -->
		  		
		  		<button type="submit" class="btn btn-default">Submit</button>
			
			</form>

		</section>

	</div>

</body>

</html>