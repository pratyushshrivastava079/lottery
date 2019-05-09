<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "invalid request method";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$users = array();

	if(isset($_SESSION['userid']) && ( $_SESSION['userlevel'] == 'A1')){

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

	 <style type="text/css">
	 	
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

	 </style>

</head>

<body>

	<header>		
			
		<nav class="navbar navbar-default">
  				
  			<div class="container">
    			
	    		<div class="navbar-header">
	      				
	    			<a class="navbars-brand" href="login.php">Home</a>
				
	    		</div>
					
				<div class="caps navbars-brand">

					<span><?php $today = date("M / d / Y h:i:s A"); echo $today; ?></span>

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
				 
				<div class="table-responsive">
				 
					<table class="table table-striped">
					  
					    <thead>
					  
					      <tr>
					  
					        <th>User</th>
					  
					        <th>Level</th>
					  
					        <th>Percent</th>
					  
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