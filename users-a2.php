<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "invalid request method";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$users = array();

	if(isset($_SESSION['userid']) && $_SESSION['userlevel'] == 'A1'){

		$id = $_SESSION['userid'];

		$sql = "SELECT * FROM `users` WHERE `userlevel` = 'A2'";
		        
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;

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

			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 sidebar">
				
				<ul class="nav nav-sidebar">
					
					<li><a href="dashboard.php">Dashboard</a></li>

					<li><a href="add-users.php">Add Users</a></li>

					<li><a href="users.php">Users</a>
						<ul>
							
							<li><a href="users-a1.php">Level A1</a></li>
							<li><a href="users-a2.php">Level A2</a></li>
							<li><a href="users-a3.php">Level A3</a></li>

						</ul>

					</li>

					<li><a href="2d-betform.php">2D Betform</a></li>

					<li><a href="3d-betform.php">3D Betform</a></li>

				</ul>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

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
				
				<h2>Total Users</h2>
				  
				<p>The table shows the list of all the users in the system.</p>            
				  
				<table class="table table-striped">
				  
				    <thead>
				  
				      <tr>
				  
				        <th>Username</th>
				  
				        <th>User Level</th>
				  
				        <th>User Percent</th>
				        
				        <th>Full Name</th>
				        
				        <th>Phone</th>
				        
				        <th>Address</th>
				        
				        <th>Added On</th>
				  
				      </tr>
				  
				    </thead>
				  
				    <tbody>

				    <?php foreach ($users as $key => $value) {?>

				      <tr>
				      
				        <td><?php echo $value['username'];?></td>
				      
				        <td><?php echo $value['userlevel'];?></td>
				        
				        <td><?php echo $value['userpercent'];?></td>

				        <td><?php echo $value['fullname'];?></td>

				        <td><?php echo $value['phone'];?></td>

				        <td><?php echo $value['address'];?></td>

				        <td><?php echo $value['created_at'];?></td>
				      
				      </tr>


				    <?php }?>  

				    </tbody>
				
				</table>
			
			</div>

		</section>

	</div>

</body>
</html>