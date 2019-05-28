<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "invalid request method";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	if(isset($_GET['msg'])){

		$error['error'] = $_GET['msg'];
	
	// }else{

		// echo "no message";
	}

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

		header("Location: 2d1-betform.php");

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

	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous"></script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

	 	i{

	 		cursor: pointer;
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


			<?php if(isset($error['msg'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['msg'];?>

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
		    			
		    			<span> | </span>

		    			<span><a href="disable.php">Disable check boxes</a></span>
	    			
		    	</div>
				 
				<div class="table-responsive">
				 
					<table class="table table-striped">
					  
					    <thead>
					  
					      <tr>
					  
					        <th>User</th>
					  
					        <th>Actions</th>
					  
					      </tr>
					  
					    </thead>
					  
					    <tbody>

					   		<tr>
					      		
					      		<td>A</td>
					      		<td class="enable" data-value="A">Enabled</td>

					      	</tr>

					      	<tr>
					      		<td>B</td>
					      		<td class="enable" data-value="B">Enabled</td>

					      	</tr>

					      	<tr>
					      		<td>C</td>
					      		<td class="enable" data-value="C">Enabled</td>

					      	</tr>

					      	<tr>

					      		<td>D</td>
					      		<td class="enable" data-value="D">Enabled</td>

					      	</tr>

					      	<tr>

					      		<td>H</td>
					      		<td class="enable" data-value="H">Enabled</td>

					      	</tr>

					      	<tr>

					      		<td>I</td>
					      		<td class="enable" data-value="I">Enabled</td>

					      	</tr>

					      	<tr>
					      		<td>N</td>
					      		<td class="enable" data-value="N">Enabled</td>

					      	</tr>

					      	<tr>
					      		<td>K</td>
					      		<td class="enable" data-value="K">Enabled</td>

					      	</tr>

					      	<tr>
					      		<td>O</td>
					      		<td class="enable" data-value="O">Enabled</td>

							</tr>  

					    </tbody>
					
					</table>

				</div>
			
			</div>

		</section>

	</div>

	<script type="text/javascript">
		
		$(document).on('click', '.enable', function(){

			var value = $(this).data('value');

			console.log(value);

			$.ajax({

				url: 'disable-checkbox.php',

				method: 'POST',

				data: { 'id': value },

				success: function(response){

					// var resp = JSON.parse(response);

					console.log(response);

					// if(resp.status == 'success'){

					// 	var user = resp.users[0];

					// 	var username = user.username;
						
					// 	var level = user.userlevel;
						
					// 	var percent = user.userpercent;

					// 	console.log(resp.users[0]);

					// 	console.log(username);
						
					// 	console.log(level);
						
					// 	console.log(percent);

					// 	$('#username-modal').val(username);

					// 	$("#level-modal").val(level);

					// 	$('#percent-modal').val(percent);

					// 	$('#submit-modal').data('id', id);						

					// 	$('#myModal').modal('show');

					// }else if(resp.status == 'error'){

					// 	console.log('user not found');

					// }
				}

			});

		});

	</script>

</body>
</html>