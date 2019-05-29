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

		    			<span><a href="reports.php?userid=<?php echo $_SESSION['userid'];?>&stage=1">Reports</a></span>
		    			
		    			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span> | </span>

		    			<span><a href="disable.php">Disable check boxes</a></span>

		    			<?php }?>
	    			
		    	</div>
				 
				<div class="table-responsive">
				 
					<table class="table table-striped">
					  
					    <thead>
					  
					      <tr>
					  
					        <th>User</th>
					  
					        <th>Level</th>
					  
					        <th>Percent</th>

					        <th>Actions</th>
					  
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

					        <td>
					        
					        	<a href="edit-users.php?id=<?php echo $value['id'];?>"><i data-id="" class="fa fa-pencil edit-user" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="delete-user.php?id=<?php echo $value['id'];?>"><i data-id="<?php echo $value['id'];?>" class="fa fa-times" aria-hidden="true"></i></a>

					        </td>

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



	<!-- Bootstrap modal to edit field details -->


	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit User</h4>
	      </div>
	      <div class="modal-body">
			
			<form id="edit-modal">
			
			  <div class="form-group">
			
			    <!-- <label for="username">Username:</label> -->
			
			    <input type="text" class="form-control" id="username-modal" placeholder="Username" value="" name="username-modal">
			
			  </div>
			
			  <div class="form-group">
			
			    <!-- <label for="level">Level:</label> -->
			  
			    <select class="form-control" id="level-modal" name="level-modal">
		        
		        	<option>-- User Level --</option>

		        	<option value="A1">A1</option>
		        
		        	<option value="A2">A2</option>
		        
		        	<option value="A3">A3</option>
		        
		        	<option value="A4">A4</option>
		      
		      	</select>
			
			  </div>

			  <div class="form-group">
			
			    <!-- <label for="percent">Percent:</label> -->
			  
			    <input type="text" class="form-control" id="percent-modal" placeholder="percent" value="" name="percent-modal">
			
			  </div>
			
			</form>
	      
	      </div>
	      <div class="modal-footer">
	        <button type="button" form="edit-modal" id="submit-modal" class="btn btn-primary">Submit</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>



<script type="text/javascript">
	

	$(function(){

		$(document).on('click', '.edit-user', function(){

			var id = $(this).data('id');

			console.log(id);

			$.ajax({

				url: 'edit.php',

				method: 'POST',

				data: { 'id': id },

				success: function(response){

					var resp = JSON.parse(response);

					console.log(resp);

					if(resp.status == 'success'){

						var user = resp.users[0];

						var username = user.username;
						
						var level = user.userlevel;
						
						var percent = user.userpercent;

						console.log(resp.users[0]);

						console.log(username);
						
						console.log(level);
						
						console.log(percent);

						$('#username-modal').val(username);

						$("#level-modal").val(level);

						$('#percent-modal').val(percent);

						$('#submit-modal').data('id', id);						

						$('#myModal').modal('show');

					}else if(resp.status == 'error'){

						console.log('user not found');

					}
				}

			});


		});

		$(document).on('click', '#submit-modal', function(){

			var username = $('#username-modal').val();
			
			var level = $('#level-modal').val();
			
			var percent = $('#percent-modal').val();
			
			var id = $(this).data('id');

			$.ajax({

				url: 'edit.php',

				method: 'POST',

				data: { 'userid': id, 'username-modal': username, 'level-modal': level, 'percent-modal': percent },

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

					// 	$('#myModal').modal('show');

					// }else if(resp.status == 'error'){

					// 	console.log('user not found');

					// }
				}

			});


		});


	});

	
</script>


</body>
</html>-