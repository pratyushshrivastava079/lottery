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

	            
	            	}


	            }

}else{

	header("Location: login.php");

}

;?>


<!DOCTYPE html>
<html>
<head>

	<title>2D Betform | Lottery System</title>

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
	  	
	  	.form-group{

	  			width: 30%;
	  			display: inline-block!important;
	  			margin-right: 1%;
	  		}

	  		.pclass{

	  			width: 20%;
	  			display: inline-block!important;
	  		}

	  		.first-line{

	  			border: 1px solid #d2d2d2;
	  			padding: 2%;
	  			border-radius: 5px; 
	  		}

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

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<div class="row text-center">

		      			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span><a href="users.php">Users</a></span>

		    			<span> | </span>

		    			<span><a href="add-users.php">Add Users</a></span>

		    			<?php }?>
		      				
		    			<span> | </span>

		    			<span><a href="2d-betform.php">2D</a></span>

		    			<span> | </span>
		    			
		    			<span><a href="3d-betform.php">3D</a></span>
		    			
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

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<form action="2d-betform.php" method="POST">
	              
	              	<input type="hidden" id="lastStage" value="1" />

	              	<div class="first-line">

		                <div class="card-header"><h3 id="Stage" data-Stage="1">Stage 1</h3></div>

			                  	<!-- <label for="2d">2D:</label> -->
			                
			                  	<button class="btn btn-primary">+</button>
			                
			                <div class="form-group">
			                
			                  	<!-- <label for="2d">2D:</label> -->
			                
			                  	<input type="text" id="2d1" class="form-control 2d" name="txt2d[]" placeholder="2D value">
			                
			                </div>

			                <div class="form-group">
		                
			                  	<!-- <label for="usd">USD:</label> -->
			                
			                  	<input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="USD">
		                
		                	</div>

		                	<div class="form-group">
		                
		                  		<!-- <label for="khr">KHR:</label> -->
		                
		                  		<input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="KHR">
		                
		                	</div>

		              	</div>

		  	            <div class="radio">

			                <label class="radio-inline"><input type="radio" name="optradio" value="5OD">5 OD</label>
			              
			                <label class="radio-inline"><input type="radio" name="optradio" value="5S">5 S</label>
			              
			            	<label class="radio-inline"><input type="radio" name="optradio" value="10S">10 S</label>

			            </div>

			            <div class="checkbox">
	                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="A" name="checkbox[]">A</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="B" name="checkbox[]">B</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="C" name="checkbox[]">C</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="D" name="checkbox[]">D</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="H" name="checkbox[]">H</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="F" name="checkbox[]">F</label>

			                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="N" name="checkbox[]">N</label>

	         		    </div>

	               			<input type="hidden" value="" id="checkbox-val">

	              		<div class="checkbox">
	                
			                <label class="checkbox-inline"><input type="checkbox" id="l23" value="l23" class="checkStage" name="Stage_checkbox[]">L 23</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" id="l25" value="l25" class="checkStage" name="Stage_checkbox[]">L 25</label>

			                <label class="checkbox-inline"><input type="checkbox" id="l27" value="l27" class="checkStage" name="Stage_checkbox[]">L 27</label>
			                
			                <label class="checkbox-inline"><input type="checkbox" id="l29" value="l29" class="checkStage" name="Stage_checkbox[]">L 29</label>
			                
			            </div>

			            <button type="submit" class="btn btn-primary">Submit</button>
	            
	            	</div>

	            </form>            

			</div>

		</section>

	</div>

</body>
</html>