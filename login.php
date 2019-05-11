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

			        	$_SESSION['username'] = $row['username'];

			        	$_SESSION['userlevel'] = $row['userlevel'];

			        	header("Location: users.php");

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

			header("Location: users.php");

		}

	}



;?>


<!DOCTYPE html>
<html>
<head>
	
	<title>Login | Lottery System</title>

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
	  	
	  	/*@media only screen and (max-width: 600px) {*/
 			
 			.form-group{

	  			width: 36%;
	  			display: inline-block!important;
	  			margin-right: 1%;
	  		}

	  		.pclass{

	  			width: 20%;
	  			display: inline-block!important;
	  		}
		
		.navbar-nav{

	 		width: 100%!important;
	 		/*text-align: center;*/
	 	}

	 	.navbar-header{

	 		width: 33%;
	 		display: inline-block;
	 		text-align: center;
	 	}

	 	.logsin{

	 		text-align: right!important;
	 	}

	 	.caps{

	 		/*display: inline-block!important;*/
	 		/*width: 68%;*/
	 		/*text-align: center;*/
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

		<div class="row text-center">

		      			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span><a href="users.php">Users</a></span>

		    			<span> | </span>

		    			<span><a href="add-users.php">Add Users</a></span>

		    			<span> | </span>
		    			
		    			<?php }?>
		      				

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
	
		<section>

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<form action="login.php" method="POST">
		  		
		  		<div class="form-group">
		    	
		    		<!-- <label for="username">Username:</label> -->
		    	
		    		<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		  		
		  		</div>
		  		
		  		<div class="form-group">
		    	
		    		<!-- <label for="pwd">Password:</label> -->
		    	
		    		<input type="password" class="form-control" id="pwd" name="password" placeholder="password">
		  		
		  		</div>
		  		
		  		<!-- <div class="checkbox">
		    	
		    		<label><input type="checkbox"> Remember me</label>
		  		
		  		</div> -->
		  		
		  		<p class=" pclass"><button type="submit" class="btn btn-default">Submit</button></p>
			
			</form>

		</section>

	</div>

</body>

</html>