<?php 

session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$_SESSION['subuserid'] = $_SESSION['userid'];

	if(isset($_GET['userid'])){
	
		$id = $_GET['userid'];

		$_SESSION['subuserid'] = $id;


	}else{

		if($_SESSION['userlevel'] == 'A1'){

			$id = 1;
			
		}else{

		}

	}


	$userid = $_SESSION['userid'];

	// echo $_SESSION['userlevel'];

	// echo $id;

	$countusername = count($_POST['username']);
	
	$stage = count($_POST['stage']);
	
	$datepicker = count($_POST['datepicker']);

	$username = mysqli_real_escape_string( $conn, $_POST['username'] );
	
	$date = mysqli_real_escape_string( $conn, $_POST['datepicker'] );

	// echo $username."<br/>";

	// echo $stage."<br/>";

	echo $date."<br/>";

	$stageArray = array();
	// echo $stage;
	// if($stage > 0){

		for($i = 0; $i < 4; $i++){

			if($i < $stage){

				if($i+1 == $_POST['stage'][$i]){

					$stageArray[$i+1] = mysqli_real_escape_string( $conn, $_POST['stage'][$i] );

				}else{
					// echo $i;
					$stageArray[$_POST['stage'][$i]] = $_POST['stage'][$i];

				}

			}
		}

	// }else{

			// $stageArray[0] = mysqli_real_escape_string( $conn, $_POST['stage'][0] );

	// }

			print_r($stageArray);

	// die();
	$_SESSION['posteduser'] = $username;

	// echo $username;

	// echo $date;

	// print_r($stageArray);

	$arrstage = array();

	// $date =  date("m / d / Y");

	// echo $date;

	if($_SESSION['userlevel'] == "A1"){

		for($i = 1; $i <= count($stageArray); $i++ ){

			if(count($stageArray) == 1){

				// echo "sas";

				header("Location: reports.php?userid=".$username."&stage1=".$stageArray[1]."&stage2=".$stageArray[2]."&stage3=".$stageArray[3]."&stage4=".$stageArray[4]."&date=".$date."");
			
			}elseif(count($stageArray) == 2){

				header("Location: reports.php?userid=".$username."&stage1=".$stageArray[1]."&stage2=".$stageArray[2]."&stage3=".$stageArray[3]."&stage4=".$stageArray[4]."&date=".$date."");

			}elseif(count($stageArray) == 3){

				header("Location: reports.php?userid=".$username."&stage1=".$stageArray[1]."&stage2=".$stageArray[2]."&stage3=".$stageArray[3]."&stage4=".$stageArray[4]."&date=".$date."");				

			}elseif(count($stageArray) == 4){

				header("Location: reports.php?userid=".$username."&stage1=".$stageArray[1]."&stage2=".$stageArray[2]."&stage3=".$stageArray[3]."&stage4=".$stageArray[4]."&date=".$date."");				

			}


		}

		// $usersql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$username'";

		// $userresult = mysqli_query($conn, $usersql);

		// if (mysqli_num_rows($userresult) > 0) {

		// 	while($userrow = mysqli_fetch_assoc($userresult)) {
		            	
		// 		$users[] = $userrow;

		// 	}


  //       }

        // print_r($finalusers);

		// $iduser = $userrow['username'];
			
		// $subusersql = "SELECT * FROM `users` WHERE `added_by` = '$iduser'";
		    
		// $subuserresult = mysqli_query($conn, $subusersql);

		// if (mysqli_num_rows($subuserresult) > 0) {

	 //    	while($subuserrow = mysqli_fetch_assoc($subuserresult)) {
	            	
		// 		$finalusers[] = $subuserrow;


	 //        }

		// }
	}























































	// for( $i = 0; $i < count($stageArray); $i++){

	// 	if(count($stageArray) == 1){

	// 		$stage = $stageArray[$i];

	// 		if($stage == 1){

	// 			$type = "2dbetform";

	// 			$stage = 1;
			
	// 		}elseif($stage == 2){

	// 			$type = "2dbetform";

	// 			$stage = 2;
			
	// 		}elseif($stage == 3){

	// 			$type = "3dbetform";

	// 			$stage = 1;
			
	// 		}elseif($stage == 4){

	// 			$type = "3dbetform";

	// 			$stage = 2;
	// 		}
		
	// 	}elseif(count($stageArray) == 2){

	// 		if($stageArray[$i] == 1){

	// 			$type = "2dbetform";

	// 			$stage = 1;

	// 			array_push($arrstage, $stage);

	// 		}elseif($stageArray[$i] == 2){

	// 			$type = "2dbetform";

	// 			$stage = 2;

	// 			array_push($arrstage, $stage);
				
	// 		}elseif($stageArray[$i] == 3){

	// 			$type = "3dbetform";

	// 			$stage = 3;
				
	// 			array_push($arrstage, $stage);
			
	// 		}elseif($stageArray[$i] == 4){

	// 			$type = "3dbetform";

	// 			$stage = 4;

	// 			array_push($arrstage, $stage);
	// 		}
	// 	}
	// }

	// echo $type;

	// echo $stage;

	// print_r($arrstage);

		// if(count($stageArray) == 1){

		// 	if($stageArray[0] == 1){

		// 		$type = "2dbetform";

		// 		$stage = 1;
			
		// 	}elseif($stageArray[0] == 2){

		// 		$type = "2dbetform";

		// 		$stage = 2;
			
		// 	}elseif($stageArray[0] == 3){

		// 		$type = "3dbetform";

		// 		$stage = 1;
			
		// 	}elseif($stageArray[0] == 4){

		// 		$type = "3dbetform";

		// 		$stage = 2;
		// 	}

		// }elseif(count($stageArray) == 2){

		// 	if($stageArray[0] == 1){

		// 		$type = "2dbetform";

		// 		$stage = 1;

		// 	}elseif($stageArray[0] == 2){

		// 		$type = "2dbetform";

		// 		$stage = 2;
			
		// 	}elseif($stageArray[0] == 3){

		// 		$type = "3dbetform";

		// 		$stage = 3;
			
		// 	}elseif($stageArray[0] == 4){

		// 		$type = "3dbetform";

		// 		$stage = 4;

		// 	}elseif($stageArray[1] == 1){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 1;

		// 	}elseif($stageArray[1] == 2){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 2;

		// 	}elseif($stageArray[1] == 3){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 3;
			
		// 	}elseif($stageArray[1] == 4){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 4;
		// 	}

		// }elseif(count($stageArray) == 3){

		// 	if($stageArray[0] == 1){

		// 		$type = "2dbetform";

		// 		$stage = 1;

		// 	}elseif($stageArray[0] == 2){

		// 		$type = "2dbetform";

		// 		$stage = 2;
			
		// 	}elseif($stageArray[0] == 3){

		// 		$type = "3dbetform";

		// 		$stage = 3;
			
		// 	}elseif($stageArray[0] == 4){

		// 		$type = "3dbetform";

		// 		$stage = 4;

		// 	}elseif($stageArray[1] == 1){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 1;

		// 	}elseif($stageArray[1] == 2){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 2;

		// 	}elseif($stageArray[1] == 3){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 3;
			
		// 	}elseif($stageArray[1] == 4){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 4;
		// 	}

		// }elseif(count($stageArray) == 4){

		// 	if($stageArray[0] == 1){

		// 		$type = "2dbetform";

		// 		$stage = 1;

		// 	}elseif($stageArray[0] == 2){

		// 		$type = "2dbetform";

		// 		$stage = 2;
			
		// 	}elseif($stageArray[0] == 3){

		// 		$type = "3dbetform";

		// 		$stage = 3;
			
		// 	}elseif($stageArray[0] == 4){

		// 		$type = "3dbetform";

		// 		$stage = 4;

		// 	}elseif($stageArray[1] == 1){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 1;

		// 	}elseif($stageArray[1] == 2){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 2;

		// 	}elseif($stageArray[1] == 3){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 3;
			
		// 	}elseif($stageArray[1] == 4){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 4;

		// 	}elseif($stageArray[1] == 1){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 1;

		// 	}elseif($stageArray[1] == 2){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 2;

		// 	}elseif($stageArray[1] == 3){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 3;
			
		// 	}elseif($stageArray[1] == 4){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 4;
		// 	}elseif($stageArray[1] == 1){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 1;

		// 	}elseif($stageArray[1] == 2){

		// 		$type2 = "2dbetform";

		// 		$stage2 = 2;

		// 	}elseif($stageArray[1] == 3){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 3;
			
		// 	}elseif($stageArray[1] == 4){

		// 		$type2 = "3dbetform";

		// 		$stage2 = 4;
		// 	}

		// }

		// var_dump($type);
		// var_dump($type2);

		// echo $stage."<br/>";
		// echo $stage2."<br/>";
		
		// echo $_SESSION['posteduser'];
		// print_r($stageArray);
		// echo $datepicker;

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

	// $_SESSION['subuserid'] = $_SESSION['userid'];

	// if(isset($_GET['userid'])){
	
	// 	$id = $_GET['userid'];

	// 	$_SESSION['subuserid'] = $id;

	// }else{

	// 	if($_SESSION['userlevel'] == 'A1'){

	// 		$id = 1;
			
	// 	}else{

	// 	}

	// }

	// if(isset($_GET['stage']) && isset($_GET['userid'])){
	
	// 	$stagelevel = $_GET['stage'];

	// 	if($stagelevel == 1){

	// 		$stage = 1;

	// 		$type = '2dbetform';

	// 	}elseif($stagelevel == 2){

	// 		$stage = 2;

	// 		$type = '2dbetform';			

	// 	}elseif($stagelevel == 3){

	// 		$stage = 1;

	// 		$type = '3dbetform';			

	// 	}elseif($stagelevel == 4){

	// 		$stage = 2;

	// 		$type = '3dbetform';			

	// 	}

	// }else{

	// 	if($_SESSION['userlevel'] == 'A1'){

	// 		$stagelevel = 1;
			
	// 	}else{

	// 	}

	// }


	// if(isset($_GET['date'])){
	
	// 	$date = $_GET['date'];

	// 	$date = date("Y-m-d H:i:s",strtotime($date));

	// }else{

	// 	if($_SESSION['userlevel'] == 'A1'){

	// 		$date = 1;
			
	// 	}else{

	// 	}

	// }

	$userid = $_SESSION['userid'];

	if($_SESSION['userlevel'] == "A1"){

		$usersql = "SELECT * FROM `users` WHERE 1";
		    
		    $userresult = mysqli_query($conn, $usersql);

		        if (mysqli_num_rows($userresult) > 0) {

	            	while($userrow = mysqli_fetch_assoc($userresult)) {
	            	
			        	$finalusers[] = $userrow;


	            	}

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

	            }
	}


	// $_SESSION['subuserid'] = $_SESSION['userid'];

	// if(isset($_GET['userid'])){
	
	// 	$id = $_GET['userid'];

	// 	$_SESSION['subuserid'] = $id;

	// }else{

	// 	if($_SESSION['userlevel'] == 'A1'){

	// 		$id = 1;
			
	// 	}else{

	// 	}

	// }




if(isset($_GET['userid']) && isset($_GET['stage1']) && isset($_GET['date']) && !isset($_GET['stage2']) && !isset($_GET['stage3']) && !isset($_GET['stage4'])){

	$stagelevel = $_GET['stage1'];

	$userid = $_GET['userid'];

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

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type' AND `stage` = '$stage'";
		
	// echo $sql;

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
	            	
			$sumusers[] = $sumrow;


	    }

	}

    $ar[] = $sumusers[0]['SUM(`totalusd`)'];

	$totalusd = $ar[0];

	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$userid'";

	$khrresult = mysqli_query($conn, $khrsql);

	if (mysqli_num_rows($khrresult) > 0) {

		while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			$khrusers[] = $khrrow;

		}

	}

	$khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	$totalkhr = $khr[0] * 100;

}elseif(isset($_GET['userid']) && isset($_GET['stage1']) && isset($_GET['stage2']) && isset($_GET['date']) && !isset($_GET['stage3']) && !isset($_GET['stage4'])){

	$stagelevel = $_GET['stage1'];
	
	$stagelevel2 = $_GET['stage2'];

	$userid = $_GET['userid'];

	// echo $userid;

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

	// echo $stagelevel2;

	if($stagelevel2 == 1){

		$stage2 = 1;

		$type2 = '2dbetform';

	}elseif($stagelevel2 == 2){

		$stage2 = 2;

		$type2 = '2dbetform';			

	}elseif($stagelevel2 == 3){

		$stage2 = 1;

		$type2 = '3dbetform';			

	}elseif($stagelevel2 == 4){

		$stage2 = 2;

		$type2 = '3dbetform';			

	}

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type' AND `stage` = '$stage' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type2' AND `stage` = '$stage2'";
		
	// echo $sql;

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
	            	
			$sumusers[] = $sumrow;


	    }

	}

    $ar[] = $sumusers[0]['SUM(`totalusd`)'];

	$totalusd = $ar[0];

	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$userid'";

	$khrresult = mysqli_query($conn, $khrsql);

	if (mysqli_num_rows($khrresult) > 0) {

		while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			$khrusers[] = $khrrow;

		}

	}

	$khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	$totalkhr = $khr[0] * 100;

}elseif(isset($_GET['userid']) && isset($_GET['stage1']) && isset($_GET['stage2']) && isset($_GET['stage3']) && isset($_GET['date']) && !isset($_GET['stage4'])){

	$stagelevel = $_GET['stage1'];
	$stagelevel2 = $_GET['stage2'];
	$stagelevel3 = $_GET['stage3'];

	$userid = $_GET['userid'];

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

	if($stagelevel2 == 1){

		$stage2 = 1;

		$type2 = '2dbetform';

	}elseif($stagelevel2 == 2){

		$stage2 = 2;

		$type2 = '2dbetform';			

	}elseif($stagelevel2 == 3){

		$stage2 = 1;

		$type2 = '3dbetform';			

	}elseif($stagelevel2 == 4){

		$stage2 = 2;

		$type2 = '3dbetform';			

	}

	if($stagelevel3 == 1){

		$stage3 = 1;

		$type3 = '2dbetform';

	}elseif($stagelevel3 == 2){

		$stage3 = 2;

		$type3 = '2dbetform';			

	}elseif($stagelevel3 == 3){

		$stage3 = 1;

		$type3 = '3dbetform';			

	}elseif($stagelevel3 == 4){

		$stage3 = 2;

		$type3 = '3dbetform';			

	}

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type' AND `stage` = '$stage' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type2' AND `stage` = '$stage2' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type3' AND `stage` = '$stage3'";
		
	// echo $sql;

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
	            	
			$sumusers[] = $sumrow;


	    }

	}

    $ar[] = $sumusers[0]['SUM(`totalusd`)'];

	$totalusd = $ar[0];

	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$userid'";

	$khrresult = mysqli_query($conn, $khrsql);

	if (mysqli_num_rows($khrresult) > 0) {

		while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			$khrusers[] = $khrrow;

		}

	}

	$khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	$totalkhr = $khr[0] * 100;

}elseif(isset($_GET['userid']) && isset($_GET['stage1']) && isset($_GET['stage2']) && isset($_GET['stage3']) && isset($_GET['stage4']) && isset($_GET['date'])){

	$stagelevel = $_GET['stage1'];
	$stagelevel2 = $_GET['stage2'];
	$stagelevel3 = $_GET['stage3'];
	$stagelevel4 = $_GET['stage4'];
	$date = $_GET['date'];
	$date=date("Y-m-d h:i:s",strtotime($date));

	$userid = $_GET['userid'];

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

	if($stagelevel2 == 1){

		$stage2 = 1;

		$type2 = '2dbetform';

	}elseif($stagelevel2 == 2){

		$stage2 = 2;

		$type2 = '2dbetform';			

	}elseif($stagelevel2 == 3){

		$stage2 = 1;

		$type2 = '3dbetform';			

	}elseif($stagelevel2 == 4){

		$stage2 = 2;

		$type2 = '3dbetform';			

	}

	if($stagelevel3 == 1){

		$stage3 = 1;

		$type3 = '2dbetform';

	}elseif($stagelevel3 == 2){

		$stage3 = 2;

		$type3 = '2dbetform';			

	}elseif($stagelevel3 == 3){

		$stage3 = 1;

		$type3 = '3dbetform';			

	}elseif($stagelevel3 == 4){

		$stage3 = 2;

		$type3 = '3dbetform';			

	}

	if($stagelevel4 == 1){

		$stage4 = 1;

		$type4 = '2dbetform';

	}elseif($stagelevel3 == 2){

		$stage4 = 2;

		$type4 = '2dbetform';			

	}elseif($stagelevel4 == 3){

		$stage4 = 1;

		$type4 = '3dbetform';			

	}elseif($stagelevel4 == 4){

		$stage4 = 2;

		$type4 = '3dbetform';			

	}

	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type' AND `stage` = '$stage' AND `created_at` >= '$date' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type2' AND `stage` = '$stage2' AND `created_at` >= '$date' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type3' AND `stage` = '$stage3' AND `created_at` >= '$date' UNION SELECT * FROM `2dbetform` WHERE `user_id` = '$userid' AND `type` = '$type4' AND `stage` = '$stage4' AND `created_at` >= '$date'";
		
	// echo $sql;

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
	            	
			$users[] = $row;


	    }

	}

	// echo "<pre>";

	// print_r($users);

	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$userid'";

	$sumresult = mysqli_query($conn, $sumsql);

	if (mysqli_num_rows($sumresult) > 0) {

		while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
			$sumusers[] = $sumrow;


	    }

	}

    $ar[] = $sumusers[0]['SUM(`totalusd`)'];

	$totalusd = $ar[0];

	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$userid'";

	$khrresult = mysqli_query($conn, $khrsql);

	if (mysqli_num_rows($khrresult) > 0) {

		while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
			$khrusers[] = $khrrow;

		}

	}

	$khr[] = $khrusers[0]['SUM(`totalkhr`)'];


	$totalkhr = $khr[0] * 100;

}






// }elseif(isset($_GET['userid']) && !isset($_GET['stage'])){

// 	$id = $_SESSION['subuserid'];

// 	$sql = "SELECT * FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $result = mysqli_query($conn, $sql);

// 		        if (mysqli_num_rows($result) > 0) {

// 	            	while($row = mysqli_fetch_assoc($result)) {
	            	
// 			        	// $_SESSION['userdetails'] = $row;
// 			        	$users[] = $row;


// 	            	}

// 	            }


// 	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $sumresult = mysqli_query($conn, $sumsql);

// 		        if (mysqli_num_rows($sumresult) > 0) {

// 	            	while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
// 			        	$sumusers[] = $sumrow;


// 	            	}

// 	            }

// 	            $ar[] = $sumusers[0]['SUM(`totalusd`)'];


// 	            $totalusd = $ar[0];

// 	            	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $khrresult = mysqli_query($conn, $khrsql);

// 		        if (mysqli_num_rows($khrresult) > 0) {

// 	            	while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
// 			        	$khrusers[] = $khrrow;


// 	            	}

// 	            }

// 	            $khr[] = $khrusers[0]['SUM(`totalkhr`)'];


// 	            $totalkhr = $khr[0] * 100;

// 	        }


// 	        elseif(isset($_GET['stage']) && isset($_GET['userid'])){

// 	        	if(isset($_GET['userid'])){

// 	        		$userid = $_GET['userid'];
	        	
// 	        	}

// 	$sql = "SELECT * FROM `2dbetform` WHERE `stage` = '$stage' AND `type` = '$type' AND `user_id` = '$userid'";

		    
// 		    $result = mysqli_query($conn, $sql);

// 		        if (mysqli_num_rows($result) > 0) {

// 	            	while($row = mysqli_fetch_assoc($result)) {
	            	
// 			        	$users[] = $row;


// 	            	}

// 	            }


// 	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $sumresult = mysqli_query($conn, $sumsql);

// 		        if (mysqli_num_rows($sumresult) > 0) {

// 	            	while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
// 			        	$sumusers[] = $sumrow;


// 	            	}

// 	            }

// 	            $ar[] = $sumusers[0]['SUM(`totalusd`)'];


// 	            $totalusd = $ar[0];

// 	        $khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $khrresult = mysqli_query($conn, $khrsql);

// 		        if (mysqli_num_rows($khrresult) > 0) {

// 	            	while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
// 			        	$khrusers[] = $khrrow;


// 	            	}

// 	            }

// 	            $khr[] = $khrusers[0]['SUM(`totalkhr`)'];


// 	            $totalkhr = $khr[0] * 100;


// 	        }elseif(isset($_GET['date']) && isset($_GET['userid']) && isset($_GET['stage']) && isset($_GET['stage2']) && isset($_GET['stage3']) && isset($_GET['stage4'])){

// 	        	if(isset($_GET['userid'])){

// 	        		$userid = $_GET['userid'];
	        	
// 	        	}else{

// 	        		$userid = $_SESSION['userid'];
// 	        	}

// 	        	if(isset($_GET['stage'])){

// 	        		$stage = $_GET['stage'];
	        	
// 	        	}else{

// 	        		$stage = $_SESSION['stage'];
// 	        	}

// 	        	if(isset($_GET['stage2'])){

// 	        		$stage = $_GET['stage2'];
	        	
// 	        	}else{

// 	        		$stage = $_SESSION['stage2'];
// 	        	}

// 	        	if(isset($_GET['stage3'])){

// 	        		$stage = $_GET['stage3'];
	        	
// 	        	}else{

// 	        		$stage = $_SESSION['stage3'];
// 	        	}

// 	        	if(isset($_GET['stage4'])){

// 	        		$stage = $_GET['stage4'];
	        	
// 	        	}else{

// 	        		$stage = $_SESSION['stage4'];
// 	        	}

// 	$sql = "SELECT * FROM `2dbetform` WHERE `created_at` >= '$date' AND `user_id` = '$userid' AND `stage` = '$stage'";

// 		    $result = mysqli_query($conn, $sql);

// 		        if (mysqli_num_rows($result) > 0) {

// 	            	while($row = mysqli_fetch_assoc($result)) {
	            	
// 			        	$users[] = $row;


// 	            	}

// 	            }


// 	$sumsql = "SELECT SUM(`totalusd`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $sumresult = mysqli_query($conn, $sumsql);

// 		        if (mysqli_num_rows($sumresult) > 0) {

// 	            	while($sumrow = mysqli_fetch_assoc($sumresult)) {
	            	
// 			        	$sumusers[] = $sumrow;


// 	            	}

// 	            }

// 	            $ar[] = $sumusers[0]['SUM(`totalusd`)'];


// 	            $totalusd = $ar[0];

// 	            	$khrsql = "SELECT SUM(`totalkhr`) FROM `2dbetform` WHERE `user_id` = '$id'";

// 		    $khrresult = mysqli_query($conn, $khrsql);

// 		        if (mysqli_num_rows($khrresult) > 0) {

// 	            	while($khrrow = mysqli_fetch_assoc($khrresult)) {
	            	
// 			        	$khrusers[] = $khrrow;


// 	            	}

// 	            }

// 	            $khr[] = $khrusers[0]['SUM(`totalkhr`)'];


// 	            $totalkhr = $khr[0] * 100;


// 	        }

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

		    			<?php $today = date("m/d/Y");?>

		    			<span><a href="reports.php?userid=<?php echo $_SESSION['userid'];?>&stage1=1&stage2=&stage3=&stage4=&date=<?php echo $today;?>">Reports</a></span>

		    			<?php if($_SESSION['userlevel'] == "A1"){?>

		    			<span> | </span>

		    			<span><a href="disable.php">Disable check boxes</a></span>

		    			<?php }?>


		    			
		    	</div>

		    	<div class="row">

		    		<form action="reports.php" method="POST">

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 username-class">

						<p class="text-center"><strong>Users</strong></p>
						<hr/>

						<?php 
						
						if($_SESSION['userlevel'] == 'A1' || $_SESSION['userlevel'] == 'A2' ){

						foreach ($finalusers as $key => $value) {?>
							
							<?php if(isset($_GET['userid'])){

								if($value['id'] == $_GET['userid']){?>

								<p class="check"><input type="radio" value="<?php echo $value['id'];?>" checked name="username"><span><?php echo $value['username'];?></span></p>

								<?php }else{?>

								<p class="check"><input type="radio" value="<?php echo $value['id'];?>" name="username"><span><?php echo $value['username'];?></span></p>

								<?php }
								    						
							}else{

								if($value['id'] == $_SESSION['posteduser']){?>

								<p class="check"><input type="radio" value="<?php echo $value['id'];?>" checked name="username"><span><?php echo $value['username'];?></span></p>


								<?php }else{?>

								<p class="check"><input type="radio" value="<?php echo $value['id'];?>" name="username"><span><?php echo $value['username'];?></span></p>



									<?php }

								?>


						<?php }?>
						
						<?php }}?>
					
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<p class="text-center"><strong>Stages</strong></p>
						<hr/>

						<?php if(isset($_GET['stage1']) && !empty($_GET['stage1'])){?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick2d1" data-id="1" data-subuserid="<?php echo $_SESSION['subuserid'];?>" checked name="stage[]" value="1"> 2D Stage 1</p>

						<?php }else{?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick2d1" data-id="1" data-subuserid="<?php echo $_SESSION['subuserid'];?>" checked name="stage[]" value="1"> 2D Stage 1</p>

						<?php }?>

						<?php if(isset($_GET['stage2']) && !empty($_GET['stage2'])){?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick2d2" data-id="2" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" checked value="2"> 2D Stage 2</p>

						<?php }else{?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick2d2" data-id="2" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" value="2"> 2D Stage 2</p>

						<?php }?>

						<?php if(isset($_GET['stage3']) && !empty($_GET['stage3'])){?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick3d1" data-id="3" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" checked value="3"> 3D Stage 1</p>

						<?php }else{?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick3d1" data-id="3" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" value="3"> 3D Stage 1</p>

						<?php }?>

						<?php if(isset($_GET['stage4']) && !empty($_GET['stage4'])){?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" checked id="checkbox-tick3d2" data-id="4" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" value="4"> 3D Stage 2</p>

						<?php }else{?>

							<p class="checks"><input type="checkbox" class="checkbox-tick" id="checkbox-tick3d2" data-id="4" data-subuserid="<?php echo $_SESSION['subuserid'];?>" name="stage[]" value="4"> 3D Stage 2</p>

						<?php }?>

						<input type="submit" value="Filter" id="filter-btn">

					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<p class="text-center"><strong>Datepicker</strong></p>
						<hr/>
						<p class="text-center">
						<input type="button" name="prev" data-id="<?php echo $_SESSION['subuserid'];?>" value="Previous" id="prev">

						<?php if(isset($_GET['date'])){?>

							<input type="text" name="datepicker" id="datepicker" data-id="<?php echo $_SESSION['subuserid'];?>" placeholder="DatePicker" value="<?php echo $_GET['date'];?>">
							<input type="button" name="next" data-id="<?php echo $_SESSION['subuserid'];?>" value="Next" id="next"></p>

						<?php }else{?>

								<input type="text" name="datepicker" id="datepicker" data-id="<?php echo $_SESSION['subuserid'];?>" placeholder="DatePicker" value="<?php echo date("d / m / Y");?>">
							<input type="button" name="next" data-id="<?php echo $_SESSION['subuserid'];?>" value="Next" id="next"></p>

						<?php }?>

					</div>					    			

			    </div>
			</form>

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


			$(document).on('click', '.check > input', function(){

				console.log('clicked');

			});

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

			$(document).on('click', '#filter-btns', function(){

				var stage1status = $('#checkbox-tick2d1').prop("checked") ;

				var stage2status = $('#checkbox-tick2d2').prop("checked") ;
				
				var stage3status = $('#checkbox-tick3d1').prop("checked") ;

				var stage4status = $('#checkbox-tick3d2').prop("checked") ;

				console.log(stage1);

				console.log(stage2);

				console.log(stage3);

				console.log(stage4);

				if(stage1status == true){

					var id = $('#checkbox-tick2d1').val();

					window.location = "reports.php?stage="+id+"&userid="+<?php echo $_SESSION['subuserid'];?>+"&date=<?php echo date("m/d/Y");?>";
					
				}

				if(stage2 == true){

					window.location = "reports.php?stage="+stage2+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";
					
				}


				if(stage3 == true){

					window.location = "reports.php?stage="+stage3+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";
					
				}


				if(stage4 == true){

					window.location = "reports.php?stage="+stage4+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";
					
				}												

				if(stage1 == true && stage2 == true){

					window.location = "reports.php?stage1="+stage1+"&stage2="+stage2+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";
					
				}else if(stage1 == true && stage3 == true){

					window.location = "reports.php?stage1="+stage1+"&stage3="+stage3+"&stage="+stage3+"&stage4="+stage4+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";

				}else if(stage1 == true && stage4 == true){

					window.location = "reports.php?stage1="+stage1+"&stage4="+stage4+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";

				}else if(stage2 == true && stage3 == true){


				}else if(stage2 == true && stage4 == true){				


				}else if(stage3 == true && stage4 == true){				


				}else if(stage1 == true && stage3 == true){				


				}else if(stage1 == true && stage3 == true){									


				}else if(stage1 == true && stage3 == true){				



				}

			});

			$('#next').on("click", function () {
			   
			    var date = $('#datepicker').datepicker('getDate');
			   
			    date.setTime(date.getTime() + (1000*60*60*24))
			
			    $('#datepicker').datepicker("setDate", date);
			
			});

			$('#prev').on("click", function () {
			
			    var date = $('#datepicker').datepicker('getDate');
			
			    date.setTime(date.getTime() - (1000*60*60*24))
			
			    $('#datepicker').datepicker("setDate", date);
		
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

	window.location = "reports.php?stage="+str[0]+"&userid="+userid+"&date=<?php echo date("m/d/Y");?>";
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

