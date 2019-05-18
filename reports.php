<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$id = $_SESSION['userid'];

	// echo $id;

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$id'";
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;


	            	}

	            }


	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$id'";

		    $sumresult = mysqli_query($conn, $sumsql);

		        if (mysqli_num_rows($sumresult) > 0) {

	            	while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$sumusers[] = $sumrow;


	            	}

	            }

	            $ar[] = $sumusers[0]['SUM(`totalusd`)'];


	            $totalusd = $ar[0];

	            // print_r($totalusd);


	            	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$id'";

		    $khrresult = mysqli_query($conn, $khrsql);

		        if (mysqli_num_rows($khrresult) > 0) {

	            	while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$khrusers[] = $khrrow;


	            	}

	            }

	            $khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	            $totalkhr = $khr[0];

	            // print_r($totalkhr);

	            // echo count($users);

			        	// print_r($users);

}else{

	echo "not allowed";
}

?>


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

	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	  <style type="text/css">
	  	
	  	.form-group{

	  			width: 25%;
	  			display: inline-block!important;
	  			margin: 1.5%;
	  		}

	  		#add{

	  			display: inline-block;
	  			width: 3.5%;
	  		}

	  		.fields{

	  			margin-left:0.7%;
	  			width: 101%;
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

	 	#screen-view-container{

	 		text-align: right;
	 		margin: 15px;
	 	}

	 	.checkbox label, .radio label{

	 		padding: 10px 10px;
	 	}


	 	.radio, .checkbox{

	 		margin-left:10px;
	 	}

	 	@media only screen and (max-width: 768px) {
		
		.right-account{

	 		width: 30%;
	 	}

	 	.middle{

	 		width: 64%;
	 	}

	 	.last-checkbox{

	 		margin-left: 0px!important;
	 	}
		
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

			<?php if(isset($success['success'])){?>

			<div class="alert alert-success">
					
				<?php echo $success['success'];?>

			</div>

			<?php }?>


			<?php if(isset($error['error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['error'];?>

			</div>

			<?php }?>


			<?php if(isset($error['txt2d'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['txt2d'];?>

			</div>

			<?php }?>

			<?php if(isset($error['usdandkhrerror'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usdandkhrerror'];?>

			</div>

			<?php }?>


			<?php if(isset($error['usd'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usd'];?>

			</div>

			<?php }?>


			<?php if(isset($error['usd'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['usd'];?>

			</div>

			<?php }?>

			<?php if(isset($error['checkbox'])){?>

			<div class="alert alert-danger">
					
				<?php echo $error['checkbox'];?>

			</div>

			<?php }?>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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
		    			
		    	</div>

		    	<div class="table-responsive">
				 
					<table class="table table-striped">
					  
					    <thead>
					  
					      <tr>
					  
					        <th>2D</th>
					  
					        <th>USD</th>
					  
					        <th>KHR</th>

					        <th>PO</th>
					        
					        <th>TUSD</th>

					        <th>TKHR</th>
					        
					        <th>BetBy</th>
					  
					      </tr>
					  
					    </thead>
					  
					    <tbody>

					    	<?php foreach ($users as $key => $value) {

					    			if($value['stage'] == 1){

					    				$stage = "2D Stage 1";
					    			
					    			}elseif($value['stage'] == 2){

					    				$stage = "2D Stage 2";

					    			}


					    		?>

					    		<tr>
					    			
					    			<td><?php echo $value['2dtxt'];?></td>
					    			<td><?php echo $value['usd'];?></td>
					    			<td><?php echo $value['khr'];?></td>
					    			<td><?php echo $value['checklevel'];?></td>
					    			<td><?php echo $value['totalusd'];?></td>
					    			<td><?php echo $value['totalkhr'];?></td>
					    			<td><?php echo $stage;?></td>

					    		</tr>


					    	<?php }?>

					    	<tr>
					    		
					    		<td>Total</td>
					    		<td></td>
					    		<td></td>
					    		<td></td>
					    		<td><?php echo $totalusd;?></td>
					    		<td><?php echo $totalkhr;?></td>
					    		<td></td>

					    	</tr>

					    </tbody>


					</table>


				</div>

		    	<div>

			</div>

		</section>

	</div>

</body>
</html>