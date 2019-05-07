<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "invalid request method";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$users = array();

	if(isset($_SESSION['userid']) && ( $_SESSION['userlevel'] == 'A1' || $_SESSION['userlevel'] == "A2")){

		$id = $_SESSION['userid'];

		$level = $_SESSION['userlevel'];
	
		$username = $_SESSION['username'];

		if( $_SESSION['userlevel'] == "A2"){

			$sql = "SELECT * FROM `users` WHERE `userlevel` = 'A3' AND `added_by` = '$username'";
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;

			        	// print_r($row);

	            	}

	            }		

		}elseif($_SESSION['userlevel'] == "A1"){

		$sql = "SELECT * FROM `users`";
		        
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;

			        	// print_r($row);

	            	}

	            }

	        }

	}else{

		header("Location: 2d-betform.php");

	}

}else{

	echo "Invalid Request Method";
}

;?>


<!DOCTYPE html>
<html>
<head>

	<title>Users | Lottery System</title>

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
		      			
		      			<?php if($_SESSION['userlevel'] == "A1" || $_SESSION['userlevel'] == "A2"){?>

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
				 
				<div class="table-responsive">
				 
					<table class="table table-striped">
					  
					    <thead>
					  
					      <tr>
					  
					        <th>User</th>
					  
					        <th>Level</th>
					  
					        <th>Percent</th>
					        
					        <th>Fullname</th>
					        
					        <th>Phone</th>
					        
					        <th>Address</th>
					        
					        <th>Balance USD</th>

					        <th>Balance KHR</th>
					        
					        <th>Added By</th>

					        <th>Added On</th>
					  
					      </tr>
					  
					    </thead>
					  
					    <tbody>

					    <?php 

					    if(!empty($users)){

					    foreach ($users as $key => $value) {?>

					      <tr>
					      
					        <td><?php echo $value['username'];?></td>
					      
					        <td><?php echo $value['userlevel'];?></td>
					        
					        <?php if($value['userpercent'] == NULL){?>

					        <td>NULL</td>

					        <?php }else{?>

					        <td><?php echo $value['userpercent'];?></td>

					        <?php }?>
					        

					        <td><?php echo $value['fullname'];?></td>

					        <td><?php echo $value['phone'];?></td>

					        <td><?php echo $value['address'];?></td>

					        <?php if($value['balanceUSD'] == NULL){?>

					        <td>NULL</td>

					        <?php }else{?>

					        <td><?php echo $value['balanceUSD'];?></td>

					        <?php }?>
					        
					        <?php if($value['balanceKHR'] == NULL){?>

					        <td>NULL</td>

					        <?php }else{?>

					        <td><?php echo $value['balanceKHR'];?></td>

					        <?php }?>
					        
					        <td><?php echo $value['added_by'];?></td>
					        
					        <td><?php echo $value['created_at'];?></td>

					      </tr>


					    <?php }}else{?>

					    	<tr><td></td><td>No Results Found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

					    <?php }?>  

					    </tbody>
					
					</table>

				</div>
			
			</div>

		</section>

	</div>

</body>
</html>