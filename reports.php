<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	$_SESSION['subuserid'] = $_SESSION['userid'];

	// echo $_SESSION['subuserid'];

	if(isset($_GET['userid'])){
	
		$id = $_GET['userid'];

		$_SESSION['subuserid'] = $id;

		// echo $_SESSION['subuserid'];

	}else{

		if($_SESSION['userlevel'] == 'A1'){

			$id = 1;
			
		}else{

			// header("Location: logout.php");
		}

	}

	if(isset($_GET['stage']) && isset($_GET['userid'])){
	
		$stagelevel = $_GET['stage'];

		if($stagelevel == 1){

			$stage = 1;

			$type = '2dbetform';

		}elseif($stagelevel == 2){

			$stage = 2;

			$type = '2dbetform';			

		}elseif($stagelevel == 3){

			$stage = 1;

			$type = '3dbetform';			

		}elseif($stagelevel == 4){

			$stage = 2;

			$type = '3dbetform';			

		}

	}else{

		if($_SESSION['userlevel'] == 'A1'){

			$stagelevel = 1;
			
		}else{

			// header("Location: logout.php");
		}

	}


	if(isset($_GET['date'])){
	
		$date = $_GET['date'];

		$date = date("Y-m-d H:i:s",strtotime($date));

	}else{

		if($_SESSION['userlevel'] == 'A1'){

			$date = 1;
			
		}else{

			// header("Location: logout.php");
		}

	}

	// echo $stage;
	// echo $date;

	// echo $id;

	$userid = $_SESSION['userid'];

	// echo "user id is " . $userid;

	if($_SESSION['userlevel'] == "A1"){

		$usersql = "SELECT * FROM `users` WHERE 1";
		    
		    $userresult = mysqli_query($conn, $usersql);

		        if (mysqli_num_rows($userresult) > 0) {

	            	while($userrow = mysqli_fetch_assoc($userresult)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$finalusers[] = $userrow;


	            	}

	            	// print_r($finalusers)

	            }		

	}else{

			$usersql = "SELECT * FROM `users` WHERE `id` = '$userid'";
		    
		    $userresult = mysqli_query($conn, $usersql);

		        if (mysqli_num_rows($userresult) > 0) {

	            	$userrow = mysqli_fetch_assoc($userresult);
	            	
			        	$finalusers[0] = $userrow;


			        }

			$iduser = $userrow['username'];
			
			$subusersql = "SELECT * FROM `users` WHERE `added_by` = '$iduser'";
		    
		    $subuserresult = mysqli_query($conn, $subusersql);

		        if (mysqli_num_rows($subuserresult) > 0) {

	            	while($subuserrow = mysqli_fetch_assoc($subuserresult)) {
	            	
			        	$finalusers[] = $subuserrow;


	            	}



	            	// print_r($finalusers);

	            }
	}




if(!isset($_GET['userid']) && !isset($_GET['stage']) && !isset($_GET['date'])){



	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$userid'";
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	$users[] = $row;


	            	}

	            }


	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$userid'";

		    $sumresult = mysqli_query($conn, $sumsql);

		        if (mysqli_num_rows($sumresult) > 0) {

	            	while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$sumusers[] = $sumrow;


	            	}

	            }

	            $ar[] = $sumusers[0]['SUM(`totalusd`)'];


	            $totalusd = $ar[0];
	            // $totalusd = $totalusd * 100;

	            // print_r($totalusd);


	            	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$userid'";

		    $khrresult = mysqli_query($conn, $khrsql);

		        if (mysqli_num_rows($khrresult) > 0) {

	            	while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$khrusers[] = $khrrow;


	            	}

	            }

	            $khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	            $totalkhr = $khr[0] * 100;
	            // $finaltotalkhr = $totalkhr * 100;

	            // print_r($totalkhr);

	            // echo count($users);

			        	// print_r($users);
















}elseif(isset($_GET['userid']) && !isset($_GET['stage'])){

	$id = $_SESSION['subuserid'];

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$id'";

	// echo $sql;
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;


	            	}

	            }

	            // var_dump($users);

	            // die();


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
	            // $totalusd = $totalusd * 100;

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


	            $totalkhr = $khr[0] * 100;
	            // $finaltotalkhr = $totalkhr * 100;

	            // print_r($totalkhr);

	            // echo count($users);

			        	// print_r($users);


	        }


	        elseif(isset($_GET['stage']) && isset($_GET['userid'])){

	        	if(isset($_GET['userid'])){

	        		$userid = $_GET['userid'];
	        	
	        	}

	        	// echo $userid;

	$sql = "SELECT * FROM `2dbetform` WHERE `stage` = '$stage' AND `type` = '$type' AND `user_id` = '$userid'";

	// echo $sql;
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;


	            	}

	            }

	            // var_dump($users);

	            // die();


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
	            // $totalusd = $totalusd * 100;

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


	            $totalkhr = $khr[0] * 100;
	            // $finaltotalkhr = $totalkhr * 100;

	            // print_r($totalkhr);

	            // echo count($users);

			        	// print_r($users);


	        }elseif(isset($_GET['date']) && isset($_GET['userid'])){

	        	if(isset($_GET['userid'])){

	        		$userid = $_GET['userid'];
	        	
	        	}else{

	        		$userid = $_SESSION['userid'];
	        	}

	$sql = "SELECT * FROM `2dbetform` WHERE `created_at` >= '$date' AND `user_id` = '$userid'";

	// echo $sql;
		    
		    $result = mysqli_query($conn, $sql);

		        if (mysqli_num_rows($result) > 0) {

	            	while($row = mysqli_fetch_assoc($result)) {
	            	
			        	// $_SESSION['userdetails'] = $row;
			        	$users[] = $row;


	            	}

	            }

	            // var_dump($users);

	            // die();


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
	            // $totalusd = $totalusd * 100;

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


	            $totalkhr = $khr[0] * 100;
	            // $finaltotalkhr = $totalkhr * 100;

	            // print_r($totalkhr);

	            // echo count($users);

			        	// print_r($users);


	        }

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

	  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

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

		.check{

			width: 32%;
			display: inline-block;
		}

		.checks{

			width: 49%;
			display: inline-block;
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

		    	<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<p class="text-center"><strong>Users</strong></p>
						<hr/>

						<?php 
						
						if($_SESSION['userlevel'] == 'A1' || $_SESSION['userlevel'] == 'A2' ){

						foreach ($finalusers as $key => $value) {?>
						
							<?php if(isset($_GET['userid'])){

								if($value['id'] == $_GET['userid']){?>

								<p class="check"><input type="checkbox" value="<?php echo $value['id'];?>" checked onclick="javascript:handleCheckbox(this)"><span><?php echo $value['username'];?></span></p>

								<?php }else{?>

								<p class="check"><input type="checkbox" value="<?php echo $value['id'];?>" onclick="javascript:handleCheckbox(this)"><span><?php echo $value['username'];?></span></p>

								<?php }
								    						
							}

						}?>
						
						<?php }?>
					
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<p class="text-center"><strong>Stages</strong></p>
						<hr/>

						<?php if(isset($_GET['stage'])){

						if($_GET['stage'] == 1){?>
						    		
							<p class="checks"><input type="checkbox" value="1, <?php echo $_SESSION['subuserid'];?>" checked onclick="javascript:handleSelectstage(this)"> 2D Stage 1</p>

							<p class="checks"><input type="checkbox" value="2, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 2</p>

							<p class="checks"><input type="checkbox" value="3, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 1</p>

							<p class="checks"><input type="checkbox" value="4, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 2</p>

						<?php }elseif($_GET['stage'] == 2){?>

							<p class="checks"><input type="checkbox" value="1, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 1</p>

							<p class="checks"><input type="checkbox" value="2, <?php echo $_SESSION['subuserid'];?>" checked onclick="javascript:handleSelectstage(this)"> 2D Stage 2</p>

							<p class="checks"><input type="checkbox" value="3, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 1</p>

							<p class="checks"><input type="checkbox" value="4, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 2</p>							


						<?php }elseif($_GET['stage'] == 3){?>

							<p class="checks"><input type="checkbox" value="1, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 1</p>

							<p class="checks"><input type="checkbox" value="2, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 2</p>

							<p class="checks"><input type="checkbox" value="3, <?php echo $_SESSION['subuserid'];?>" checked onclick="javascript:handleSelectstage(this)"> 3D Stage 1</p>

							<p class="checks"><input type="checkbox" value="4, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 2</p>


						<?php }elseif($_GET['stage'] == 4){?>

							<p class="checks"><input type="checkbox" value="1, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 1</p>

							<p class="checks"><input type="checkbox" value="2, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 2</p>

							<p class="checks"><input type="checkbox" value="3, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 1</p>

							<p class="checks"><input type="checkbox" value="4, <?php echo $_SESSION['subuserid'];?>" checked onclick="javascript:handleSelectstage(this)"> 3D Stage 2</p>


						<?php }}else{?>

							<p class="checks"><input type="checkbox" value="1, <?php echo $_SESSION['subuserid'];?>" checked onclick="javascript:handleSelectstage(this)"> 2D Stage 1</p>

							<p class="checks"><input type="checkbox" value="2, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 2D Stage 2</p>

							<p class="checks"><input type="checkbox" value="3, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 1</p>

							<p class="checks"><input type="checkbox" value="4, <?php echo $_SESSION['subuserid'];?>" onclick="javascript:handleSelectstage(this)"> 3D Stage 2</p>

						<?php }?>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<p class="text-center"><strong>Datepicker</strong></p>
						<hr/>
						<p class="text-center">
						<input type="button" name="prev" data-id="<?php echo $_SESSION['subuserid'];?>" value="Previous" id="prev">
						<input type="text" id="datepicker" data-id="<?php echo $_SESSION['subuserid'];?>" placeholder="DatePicker" value="<?php echo $_GET['date'];?>">
						<input type="button" name="next" data-id="<?php echo $_SESSION['subuserid'];?>" value="Next" id="next"></p>

					</div>					    			

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

					        <th>Stage</th>
					  
					      </tr>
					  
					    </thead>
					  
					    <tbody id="data-body">

					    	<?php 

					    	if(!is_null($users)){


					    	foreach ($users as $key => $value) {

					    		// echo "<pre>";

					    		// if($value['radiobox'] == '5S'){

					    		// 	$value['totalkhr'] = $value['totalkhr'] / 5;

					    		// 	$value['totalusd'] = $value['totalusd'] / 5;

					    		// }elseif($value['radiobox'] == '5OD'){

					    		// 	$value['totalkhr'] = $value['totalkhr'] / 5;

					    		// 	$value['totalusd'] = $value['totalusd'] / 5;

					    		// }elseif($value['radiobox'] == '10S'){

					    		// 	$value['totalkhr'] = $value['totalkhr'] / 10;

					    		// 	$value['totalusd'] = $value['totalusd'] / 10;
					    		// }

					    		if($value['totalkhr'] == ""){

					    			$value['totalkhr'] = NULL;
					    		
					    		// }elseif($value['totalkhr'] != ""){

					    			// $value['totalkhr'] = $value['totalkhr'] * 100;

					    		}

					    		if($value['totalusd'] == ""){

					    			$value['totalusd'] = NULL;
					    		
					    		// }elseif($value['totalusd'] != ""){

					    			// $value['totalkhr'] = $lcg_value()['totalkhr'] * 100;

					    		}

					    		// var_dump($value['totalkhr']);

					    			if($value['stage'] == 1 && $value['type'] == '2dbetform'){

					    				$stage = "2D Stage 1";

					    				// $type = "2D Betform";
					    			
					    			}elseif($value['stage'] == 2 && $value['type'] == '2dbetform'){

					    				$stage = "2D Stage 2";

					    				// $type = "2D Betform";
					    			
					    			}elseif($value['stage'] == 1 && $value['type'] == '3dbetform'){

					    				$stage = "3D Stage 1";

					    				// $type = "3D Betform";


					    			}elseif($value['stage'] == 2 && $value['type'] == '3dbetform'){

					    				$stage = "3D Stage 2";

					    				// $type = "3D Betform";					    				
					    			}

					    			$user_id = $value['user_id'];

					    			// echo $user_id;

					    			$usersql = "SELECT * FROM `users` WHERE `id` = '$user_id'";

					    			// echo $usersql;
		    
								    $userresult = mysqli_query($conn, $usersql);

								        if (mysqli_num_rows($userresult) > 0) {

							            	$userdetail = mysqli_fetch_assoc($userresult);
							            	$username = $userdetail['username'];
							            	$percent = $userdetail['userpercent'];

							            	$arr = explode('%', $percent);
							            	// echo $arr[0];
							            	$percent = $arr[0] / 100;							            	
							            
							            }

							            // if( $value['totalkhr'] == 0 ){

							            		// $value['totalkhr'] == '';

							            	// }

							            	// echo $value['totalkhr'];
							            	

					    		?>

					    		<tr>
					    			
					    			<td><?php echo $value['2dtxt'];?></td>
					    			<td><?php echo $value['usd'];?></td>
					    			<td><?php echo $value['khr'];?></td>
					    			<td><?php echo $value['checklevel'];?></td>
					    			<td><?php echo $value['totalusd'];?></td>
					    			<td><?php echo $value['totalkhr'];?></td>
					    			<td><?php echo $username;?></td>
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

					    	<?php }else{?>

					    		<tr>
					    			<th>No Results Found.</th>
					    		</tr>

					    	<?php }?>

					    </tbody>


					</table>


				</div>

		    	<div>

			</div>

		</section>

	</div>


	<script type="text/javascript">
		
		$(document).ready(function() {

			$(document).on('change', '.username-filters', function(){

				var userid = $(this).val();

				console.log(userid);

				$.ajax({

					url: 'getusers.php',

					type: 'POST',

					data: { 'userid': userid },

					success: function(response){

						// console.log("response " + response);

						var result = JSON.parse(response);

						console.log(result);
						
						var users = result.users;

						if(result.status == 'success'){

							console.log(users.length);

							for( var i = 0; i < users.length; i++){

								$('#data-body').append('aa');

								// console.log(i);
								
							}

						}

					}

				});

			});

		});

	</script>



	<script type="text/javascript">
		
		$(document).ready(function() {

				// var todayTime = new Date();
				// var month = todayTime . getMonth() + 1;
				// var monthnext = todayTime . getMonth() + 2;
				// var day = todayTime . getDate() - 1;
				// var year = todayTime . getFullYear();
				// var dd =  month + "/" + day + "/" + year ;
				// var mm =  monthnext + "/" + day + "/" + year ;

				// $('#prev').data('dateval', dd);
				// $('#next').data('dateval', mm);

			$(document).on('click', '#prev', function(){

				var datee = $('#datepicker').val();

				if(datee == ""){

					console.log('cannot be clicked');
					$(this).attr("disabled", true);

				}else{					

					$(this).attr("disabled", false);
					var dateprev = datee.split('/');
					var dd = parseInt(dateprev[1])-1;
										var todayTime = new Date();
					// console.log(todayTime);

					// console.log(dd);
					var todayTime = new Date();
					var month = todayTime . getMonth() + 1;
					var day = todayTime . getDate() - 1;
					var year = todayTime . getFullYear();
					var prevdate =  month + "/" + dd + "/" + year ;
					var userid = $(this).data('id');

					// window.location = "reports.php?date="+prevdate+"&userid="+userid;
				}

			});


			$(document).on('click', '#next', function(){

				var datee = $('#datepicker').val();

				if(datee == ""){

					console.log('cannot be clicked');
					$(this).attr("disabled", true);

				}else{					

					$(this).attr("disabled", false);
					var dateprev = datee.split('/');
					var dd = parseInt(dateprev[1])+1;

					console.log(dd);
					var todayTime = new Date();
					// console.log(todayTime);
					var month = todayTime . getMonth() + 1;
					var day = todayTime . getDate() - 1;
					var year = todayTime . getFullYear();
					var prevdate =  month + "/" + dd + "/" + year ;
					var userid = $(this).data('id');

					window.location = "reports.php?date="+prevdate+"&userid="+userid;
				}

			});

			$(document).on('change', '#datepicker', function(){

				var id = $(this).data('id');

				window.location = "reports.php?date="+this.value+"&userid="+id;

			});

		});

	</script>

<script type="text/javascript">

function handleSelect(elm)
{
window.location = "reports.php?userid="+elm.value;
}

function handleSelectstage(elm)
{	

	var str = elm.value;

	str = str.split(',');

	console.log(str[0]);

	var userid = str[1].trim();

	window.location = "reports.php?stage="+str[0]+"&userid="+userid;
}

function handleSelectdate(elm)
{
window.location = "reports.php?date="+elm.value;
}

function handleCheckbox(elm)
{
window.location = "reports.php?userid="+elm.value;
}


</script>

</body>
</html>

