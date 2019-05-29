<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "invalid request method";

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$sql = "SELECT * FROM `checkbox_status` WHERE `type` = '2dbetform' AND `stage` = '1'";
			    
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
		            	
			$users1[] = $row;
		
		}

	}

	$sql = "SELECT * FROM `checkbox_status`  WHERE `type` = '2dbetform' AND `stage` = '2'";;
			    
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
		            	
			$users2[] = $row;
		
		}

	}

	$sql = "SELECT * FROM `checkbox_status`  WHERE `type` = '3dbetform' AND `stage` = '1'";
			    
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
		            	
			$users3[] = $row;
		
		}

	}

	$sql = "SELECT * FROM `checkbox_status`  WHERE `type` = '3dbetform' AND `stage` = '2'";
			    
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
		            	
			$users4[] = $row;
		
		}

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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	 <style type="text/css">
	 	
	 	.navbar-nav{

	 		width: 100%!important;
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

		    	<div class="row">

		    		<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
				
		    			<label class="text-center">2D Betform Stage 1</label>

		    			<hr/>

						<?php foreach ($users1 as $key => $value) {

							if($value['status'] == 1){?>

								<p><input type="checkbox" class="enable" data-stage="1" data-type="2dbetform" value="<?php echo $value['checkbox'];?>" checked><?php echo $value['checkbox'];?></p>
							    		
							<?php }elseif($value['status'] == 0){?>

								<p><input type="checkbox" class="enable" data-stage="1" data-type="2dbetform" value="<?php echo $value['checkbox'];?>"><?php echo $value['checkbox'];?></p>

							<?php }?>

						<?php }?>

					</div>

		    		<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
				
		    			<label class="text-center">2D Betform Stage 2</label>

		    			<hr/>

						<?php foreach ($users2 as $key => $value) {

							if($value['status'] == 1){?>

								<p><input type="checkbox" class="enable" data-stage="2" data-type="2dbetform" value="<?php echo $value['checkbox'];?>" checked><?php echo $value['checkbox'];?></p>
							    		
							<?php }elseif($value['status'] == 0){?>

								<p><input type="checkbox" class="enable" data-stage="2" data-type="2dbetform" value="<?php echo $value['checkbox'];?>"><?php echo $value['checkbox'];?></p>

							<?php }?>

						<?php }?>

					</div>

		    		<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">

		    			<label class="text-center">3D Betform Stage 1</label>

		    			<hr/>
				
						<?php foreach ($users3 as $key => $value) {

							if($value['status'] == 1){?>

								<p><input type="checkbox" class="enable" data-stage="1" data-type="3dbetform" value="<?php echo $value['checkbox'];?>" checked><?php echo $value['checkbox'];?></p>
							    		
							<?php }elseif($value['status'] == 0){?>

								<p><input type="checkbox" class="enable" data-stage="1" data-type="3dbetform" value="<?php echo $value['checkbox'];?>"><?php echo $value['checkbox'];?></p>

							<?php }?>

						<?php }?>

					</div>

		    		<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
		    			
		    			<label class="text-center">3D Betform Stage 2</label>

		    			<hr/>
				
						<?php foreach ($users4 as $key => $value) {

							if($value['status'] == 1){?>

								<p><input type="checkbox" class="enable" data-stage="2" data-type="3dbetform" value="<?php echo $value['checkbox'];?>" checked><?php echo $value['checkbox'];?></p>
							    		
							<?php }elseif($value['status'] == 0){?>

								<p><input type="checkbox" class="enable" data-stage="2" data-type="3dbetform" value="<?php echo $value['checkbox'];?>"><?php echo $value['checkbox'];?></p>

							<?php }?>

						<?php }?>

					</div>					

				</div>
			
			</div>

		</section>

	</div>

	<script type="text/javascript">
		
		$(document).on('click', '.enable', function(){

			var value = $(this).val();
			var type = $(this).data('type');
			var stage = $(this).data('stage');

			console.log(value);
			console.log(type);
			console.log(stage);

			$.ajax({

				url: 'disable-checkbox.php',

				method: 'POST',

				data: { 'id': value, 'type': type, 'stage': stage },

				success: function(response){

					// console.log(response);

					window.location.reload();
				}

			});

		});

	</script>

</body>
</html>