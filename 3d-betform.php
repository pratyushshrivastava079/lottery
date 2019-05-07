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

	<title>Logout | Lottery System</title>

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
		      			
		      			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<li><a href="users.php">Users</a></li>

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

			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<form action="3d-betform.php" method="POST" id="3dform">
              
            		<input type="hidden" id="lastlevel" value="1" />

              		<div class="first-line">

                		<div class="card-header"><h3 id="level" data-level="1">Level 1</h3></div>

                		<div class="form-group">
                
                  			<label for="3d">3D:</label>
                
                  			<input type="text" id="3d1" class="form-control 3d" name="txt3d[]" placeholder="Only 3 digit number between 101-999 allowed">
                
                		</div>

		                 <div class="form-group">
		                
		                  	<label for="usd">USD:</label>
		                
		                  	<input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) ">
		                
		                </div>

		                <div class="form-group">
                
		                  	<label for="khr">KHR:</label>
		                
		                  	<input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )">
		                
		                </div>

		            </div>

		            <div class="radio">

		            	<label class="radio-inline"><input type="radio" name="optradio" value="5OD">5 X</label>
		              
		                <label class="radio-inline"><input type="radio" name="optradio" value="5L">5 L</label>
		              
		                <label class="radio-inline"><input type="radio" name="optradio" value="5C">5 C</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="5R">5 R</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10L">10 L</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10C">10 C</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10R">10 R</label>

		            </div>

 		            <div class="checkbox upper">
 	               
    		            <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="A" name="checkbox[]">A</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="B" name="checkbox[]">B</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="C" name="checkbox[]">C</label>
		
		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="D" name="checkbox[]">D</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="H" name="checkbox[]">H</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="I" name="checkbox[]">I</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="N" name="checkbox[]">N</label>

		            </div>

			            <input type="hidden" value="" id="checkbox-val">

		            <div class="checkbox lower">
                
		                <label class="checkbox-inline"><input type="checkbox" id="l19" value="l19" class="checkLevel" name="level_checkbox[]">L 19</label>
		                
		                <label class="checkbox-inline"><input type="checkbox" id="l22" value="l22" class="checkLevel" name="level_checkbox[]">L 22</label>
		                
		            </div>

              		<button type="submit" class="btn btn-default">Submit</button>
            
           		</form>            

			</div>

		</section>

	</div>

</body>
</html>