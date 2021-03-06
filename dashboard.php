<?php 

session_start();

include('database.php');

if(isset($_SESSION['userid'])){

$id = $_SESSION['userid'];

$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
		        
		        $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userid'] = $row['id'];

			        	// print_r($row);
						header("Location: users.php");

	            
	            	}


	            }

}else{

	header("Location: login.php");

}

;?>


<!DOCTYPE html>
<html>
<head>

	<title>Logout | Lottery System</title>
	
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
	      				
	    			<a class="navbar-brand" href="#">Lottery System</a>
	    			
	    		</div>
	    			
	    		<ul class="nav navbar-nav">
	      				
	    			<li class="active"><a href="#">Home</a></li>
	      				
	    			<li><a href="#">About Us</a></li>
	      				
	    			<li><a href="#">Contact Us</a></li>
	    			
	    		</ul>
	    			
	    		<ul class="nav navbar-nav navbar-right">
	      				
	      			<!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->

	      			<?php if(isset($_SESSION['userid'])){?>
	      				
		      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	      			
	      			<?php }else{?>

		      			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

	      			<?php }?>
	    			
	    		</ul>
		  	
		  	</div>

		</nav>

	</header>

	<div class="container">
	
		<section>

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 sidebar">
				
				<ul class="nav nav-sidebar">
					
					<li><a href="dashboard.php">Dashboard</a>

					<?php if($_SESSION['userlevel'] == 'A1'){?>

					<li><a href="add-users.php">Add Users</a></li>

					<li><a href="users.php">Users</a>

						<ul>
							
							<li><a href="users-a1.php">Level A1</a></li>
							<li><a href="users-a2.php">Level A2</a></li>
							<li><a href="users-a3.php">Level A3</a></li>

						</ul>

					</li>

					<?php}elseif(($_SESSION['userlevel'] == 'A2') || ($_SESSION['userlevel'] == 'A3')){?>


					<?php }?>
					<li><a href="2d-betform.php">2D Betform</a></li>

					<li><a href="3d-betform.php">3D Betform</a></li>

				</ul>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
				
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

			</div>

		</section>

	</div>

</body>
</html>