<?php 
 
function pc_permute($items, $perms = array( )) {
    if (empty($items)) {
        $return = array($perms);
    }  else {
        $return = array();
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
         list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             $return = array_merge($return, pc_permute($newitems, $newperms));
             // print_r($return); 
         }
    }
    return $return;
} 


session_start();

include('database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$counttxt3d = count($_POST['txt3d']);

	$countusd = count($_POST['usd']);

	$countkhr = count($_POST['khr']);

	// checks if one row or more than one row of a form has been posted //

	if($counttxt3d == 1 && $countkhr == 1 || $countusd == 1 ){

		$txt3d = mysqli_real_escape_string( $conn, $_POST['txt3d'][0] );
	
		$usd = mysqli_real_escape_string( $conn, $_POST['usd'][0] );
	
		$khr = mysqli_real_escape_string( $conn, $_POST['khr'][0] );

		$radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

		// check whether multiple checkbox or checkboxlevel has been posted //

		$countcheck = count($_POST['checkbox']);
		
		$stagecheck = count($_POST['Stage_checkbox']);


		$counttxt3d = implode($txt3d, ',' );

		$counttxt3d = count($counttxt3d);

		// var_dump(strlen($txt3d));

		if($counttxt3d < 3){

			$error['txt3d'] = "txt3d value should be of 3 digits."; 
			
		}

		if($txt3d == ""){

			$error['txt3d'] = "txt3d value cannot be empty"; 
		}

		if($txt3d != "" && ( $usd != "" || $khr != "") || ( $usd != "" && $khr != "")){

			if($countcheck == 0 && $stagecheck == 0){

				$error['checkbox'] = "Please select at least one of the checkbox";

			}elseif($countcheck > 0 || $stagecheck > 0){


				if($countcheck > 1 && $stagecheck == 1){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

					}

					$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					array_push($checkboxlevel, $stagelevel);

				}elseif($countcheck > 1 && $stagecheck == 0){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

						$arra[] = $checkboxlevel[$j];

					}
					
				}elseif($countcheck == 0 && $stagecheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

				}elseif($countcheck == 1 && $stagecheck == 1){

					$checkboxlevel[0] = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

					$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					// $arra[] = $checkboxlevel[0];

					// print_r($arra);

					array_push($checkboxlevel, $stagelevel);

					// print_r($arra);
				}elseif ($countcheck == 1) {
					# code...
					$checkboxlevel[0] = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );
				}

				// if some exception occurs about minimum and maximum value for txt3d value then validation should be put here. //

				// print_r($checkboxlevel);

				$userid = $_SESSION['userid'];

				$order_id = uniqid();

				if(is_array($checkboxlevel)){

					$checkboxlevel = implode(',', $checkboxlevel);
					
				}

				// if($usd == ""){

				// 	$usd = 0;
				
				// }elseif($khr == ""){

				// 	$khr = 0;

				// }

				// var_dump($radio);

				$newtxt3d = array();
				
				$incrementval = 0;

				$newval = str_split($txt3d);

				// print_r($newval);

				if($radio == '5L' || $radio == '5C' || $radio == '5R'){

	                if($radio == '5L'){

	                	for($i = 0 ; $i < 5 ; $i++){

	                        array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(100*$i);

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 100;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];

	                        		if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = $newtxt3d[$i]."0";

	                        		}
	                        	}
	                        }

	                        $incrementval = 5;

	                    }

	                    $txt3d = $newtxt3d;
	                    
                    }elseif($radio == '5C'){

	                	for($i = 0 ; $i < 5 ; $i++){

	                        array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(10*$i);

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 100;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];

	                        		if(count(str_split($newtxt3d[$i])) < 3){

	                        			$newtxt3d[$i] = $newtxt3d[$i]."0";

	                        		}	                        		
	                        	}
	                        }

	                        $incrementval = 5;

	                    }

	                    $txt3d = $newtxt3d;
	                    
                    }elseif($radio == '5R'){

	                	for($i = 0 ; $i < 5 ; $i++){

	                        array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(1*$i);

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 100;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];

	                        		if(count(str_split($newtxt3d[$i])) < 3){

	                        			$newtxt3d[$i] = $newtxt3d[$i]."0";

	                        		}
	                        	}
	                        }

	                        $incrementval = 5;

	                    }

	                    $txt3d = $newtxt3d;
	                    
                    }else{}


                }elseif($radio == '10L' || $radio == '10C' || $radio == '10R'){

               $newval = str_split($txt3d);

                    if($radio == '10L'){

                    	for($i = 0 ; $i < 10 ; $i++){

                        	array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(100*$i);

	                        echo $newtxt3d[$i];

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 1000;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];
	                        	}
	                        }

	                        echo "<br/>";

	                        echo "-----------------";

	                        echo $newtxt3d[$i];

	                        echo "-----------------";
	                        echo "<br/>";

	                        $incrementval = 10;

                    	}
                    	
                    	$txt3d = $newtxt3d;

                    }elseif($radio == '10C'){

                    	for($i = 0 ; $i < 10 ; $i++){

	                    	array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(100*$i);

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 1000;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];
	                        	}
	                        }

	                        $incrementval = 10;



                    	}
                    	
                    	$txt3d = $newtxt3d;

                    }elseif($radio == '10R'){
	                 	
	                 	for($i = 0 ; $i < 10 ; $i++){

	                    	array_push($newtxt3d, implode('',$newval));

	                        $newtxt3d[$i] = $newtxt3d[$i]+(100*$i);

	                        if($newtxt3d[$i] > 999){

	                        	$newtxt3d[$i] = $newtxt3d[$i] % 1000;

	                        	if(count(str_split($newtxt3d[$i])) < 3){

	                        		$newtxt3d[$i] = "0".$newtxt3d[$i];
	                        	}
	                        }

	                        $incrementval = 10;

                    	}
                    	
                    	$txt3d = $newtxt3d;

                    }else{}

                }elseif($radio == '5OD'){

					for($i = 0 ; $i < 5 ; $i++){

						if($i == 0){

							// echo $txt3d;

							// $txt3d = $txt3d;

							$newtxt3d[$i] = $txt3d;

						}else{

							$newtxt3d[$i] = $txt3d + 2;

							$txt3d = $newtxt3d[$i]; 
							
							$incrementval = 5; 

						}

						// echo $txt3d;
					}

				}elseif($radio == '5X'){

					$newval  = str_split($txt3d);

	                $value = pc_permute($newval);
	                // echo "<pre>";
	                // print_r($value);
	    
	                $d3txtfinal  = array();

	                for($i = 0 ; $i < count($value) ; $i++){

	                    array_push($newtxt3d, implode('', $value[$i]));

	                	// echo gettype(implode('', $value[$i]));
	                }


	                $incrementval = count($newtxt3d);
	                // echo "<pre>";
	                $newtxt3d = array_unique($newtxt3d);

	                $newarray = $newtxt3d;

	                // $newtxt3d = $newtxt3d;

					$newtxt3d = array_values(array_filter($newarray));

				}

				// die(';eneter her');

				// echo "incrementval " . $incrementval;

				// print_r($newtxt3d);
// 
				// die(); 

				// echo $radio;

				// echo $txt3d;

				// if($radio == '5OD'){

				// 	echo "txt3d is ".$txt3d - 2;
					
				// }elseif($radio == '5S'){

				// 	echo "txt3d is ".$txt3d - 1;

				// }elseif($radio == '10S'){

				// 	echo "txt3d is ".$txt3d - 1;

				// }
	                        // print_r($newtxt3d);


				$arrayid = array();

				if($incrementval == 0){

				// echo "txt3d is ".$txt3d;
					$users = array(


							'user_id' => $userid,

							'order_id' => $order_id,

							'txt3d' => $txt3d,

							'usd' => $usd,

							'khr' => $khr,

							'radiobox' => $radio,

							'checklevel' => $checkboxlevel 

						);

					$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel`, `stage`, `type` ) VALUES( '$userid', '$order_id', '$txt3d', '$usd', '$khr', '$radio', '$checkboxlevel', '1', '3dbetform' )";
						// print_r($query);
						// die();
						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid = $last_id;


						} else {
													
							$error['error'] = "Unable to place bet.";
												
						}

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}

				  			$count = count($order);

				  			// print_r($order);

				  			// print_r($count);

				  			$finalvaluekhr = 0; 

				  			$finalvalueusd = 0;

							$checkorder = explode(',', $order[0]['checklevel']); 

							// print_r($checkorder);

							$countcheckorder = count($checkorder);

							// print_r($countcheckorder);

							if(end($checkorder) == 'L 19'){

								$countcheckorder = $countcheckorder - 1;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 19 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 19 );
							
							}elseif(end($checkorder) == 'L 20'){

								$countcheckorder = $countcheckorder - 1;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 20 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 20 );


							}elseif(end($checkorder) == 'L 21'){

								$countcheckorder = $countcheckorder - 1;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 21 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 21 );

								
							}elseif(end($checkorder) == 'L 22'){

								$countcheckorder = $countcheckorder - 1;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 22 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 22 );								
							}else{

								$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

								// echo 'finalusdvalue is ' . $finalusdvalue . "usd id " . $order[0]['usd'];

								// echo 'finalkhrvalue is ' . $finalkhrvalue;

								if($finalvalueusd == 0){

									$finalvalueusd = "";
								
								}elseif($finalvaluekhr == 0){

									$finalvaluekhr = "";

								}

							 }	

							 $orderid = $order[0]['order_id'];

								$query= "UPDATE 2dbetform SET totalusd = '$finalvalueusd', totalkhr = '$finalvaluekhr' WHERE order_id='$orderid'";

							// print_r($query);

							// die();

							if ($conn->query($query) === TRUE) {

								$sql = "SELECT * FROM `2dbetform` WHERE `order_id` = '$orderid'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$orders[] = $row;

				  			}
				
								$success['success'] = "Bet placed successfully.";


							}else{

								$error['error'] = "Bet placed but unable to fetch last bid details.";
								
							}		

						}









































				
						$success['success'] = "Bet placed successfully.";


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }

				}elseif($incrementval > 0){

				$checkorder = count($arra);

				// print_r($checkorder);

				$usdval[] = $usd;
				
				$khrval[] = $khr;

				// print_r($usdval);

				// print_r($khrval);

				// $stageorder = count($arra);

				$checkboxlevel = explode(',', $checkboxlevel);

				// $countcheckorder = $counttxt3d;

				$finalvalueusd = 0;

				$finalvaluekhr = 0;

				// print_r($counttxt3d);
				
				for($j = 0 ; $j < $incrementval; $j++ ){								

					$countcheckorder = count($arra);

				// 	// echo "<br/>";
				// 	// print_r($khr);

				//	// die();

				// 	$finalvalueusd = 0;

				// 	$finalvaluekhr = 0;
				// 				// echo $j;
				// 				// echo $counttxt3d;
				// echo "<pre>";
				// print_r($usd[$j]);

					// echo gettype($countcheckorder);

							if(end($checkboxlevel) == 'L 19'){

								$countcheckorder = $countcheckorder - 1;

				// 				// echo $countcheckorder;
				// 				// echo count($checkboxlevel);

									
										// print_r($usd);
				// 						// print_r($usdval);
				// 						// print_r($khr[0]);
				// 						print_r($khrval);
										$finalvalueusd = ( $usd  * $countcheckorder ) + ( $usd[$j] * 19 );

										$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 19 );

				// 						// echo "<br/>";

										// echo $finalvalueusd;

				// 						// echo "<br/>";

				// 						// echo $finalvalueusd;
										
				// 						// echo "<br/>";

				// 						// echo $countcheckorder;

				// 						// echo "<br/>";

								}elseif(end($checkboxlevel) == 'L 20'){

				// 				$countcheckorder = $countcheckorder - 1;

				// 						$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 20 );

				// 						$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 20 );									

								}elseif(end($checkboxlevel) == 'L 21'){

				// 				$countcheckorder = $countcheckorder - 1;

				// 						$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 21 );

				// 						$finalvaluekhr =  ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 21 );
									
								}elseif(end($checkboxlevel) == 'L 22'){

				// 				$countcheckorder = $countcheckorder - 1;

				// 						$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 22 );

				// 						$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 22 );

									
								}else{


									$finalvalueusd = $usdval[0][$j] * count($arra);


									$finalvaluekhr = $khrval[0][$j] * count($arra);					

									// print_r($usdval[0][$j]);
									// print_r(count($arra));

									// print_r($khrval[0][$j]);
				 				
				 					// print_r($countcheckorder);

								}




































						// die('assas');
						
						// for($j = 0; $j < $incrementval; $j++){

						// 	$users[$j] = array(


						// 		'user_id' => $userid,

						// 		'order_id' => $order_id,

						// 		'txt3d' => $newtxt3d[$j],

						// 		'usd' => $usd,

						// 		'khr' => $khr,

						// 		'radiobox' => $radio,

						// 		'checklevel' => $checkboxlevel 

						// 	);



						if($newtxt3d[$j] == ""){

							continue;
						
						}else{

							if(is_array($checkboxlevel)){
								
								$checkboxlevel = implode(',', $checkboxlevel);

						}

						$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel`, `stage`, `type`, `totalusd`, `totalkhr` ) VALUES( '$userid', '$order_id', '$newtxt3d[$j]', '$usd', '$khr', '$radio', '$checkboxlevel', '1', '3dbetform', '$finalvalueusd', '$finalvaluekhr' )";

						// echo "<pre>";
						
						// print_r($query);
						
						// die();

						$order = array();

						if ($conn->query($query) === TRUE) {

							$last_id = mysqli_insert_id($conn);

							$arrayid[$j] = $last_id; 

							// $sql = "SELECT * FROM `2dbetform` WHERE `id` = '$last_id'";
					    	
						 //    $result = mysqli_query($conn, $sql);

						 //        if (mysqli_num_rows($result) > 0) {

					  //           	while($row = mysqli_fetch_assoc($result)) {
					            	
							//         	$order[] = $row;

					  //           	}
					
									// $success['success'] = "Bet placed successfully.";

					    //         }else{

									// $error['error'] = "Bet placed but unable to fetch last bid details.";
					            	
					    //         }
											

							} else {
														
								$error['error'] = "Unable to place bet.";
													
							}
						}


					}
				}

				$countarrayid = count($arrayid);

				$finalvalueusd = 0;

				$finalvaluekhr = 0;

				if($countarrayid == 5 || $countarrayid == 10 || $countarrayid == 6 || $countarrayid == 3){

					// die('inside');

					for($k = 0 ; $k < $countarrayid ; $k++){

						$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
						$result = mysqli_query($conn, $sql);

					 	if (mysqli_num_rows($result) > 0) {

				  			while($row = mysqli_fetch_assoc($result)) {
				            	
								$order[] = $row;

				  			}

								$checkorder = explode(',', $order[$k]['checklevel']);
								
								$stageorder = explode(',', $order[$k]['Stagelevel']);
								
								$countcheckorder = count($checkorder);

								if(end($checkorder) == 'L 19'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $order[$k]['usd']  * $countcheckorder ) + ( $order[$k]['usd'] * 19 );

										$finalvaluekhr = ( $order[$k]['khr']  * $countcheckorder ) + ( $order[$k]['khr'] * 19 );
								
								}elseif(end($checkorder) == 'L 20'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $order[$k]['usd']  * $countcheckorder ) + ( $order[$k]['usd'] * 20 );

										$finalvaluekhr = ( $order[$k]['khr']  * $countcheckorder ) + ( $order[$k]['khr'] * 20 );									

								}elseif(end($checkorder) == 'L 21'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $order[$k]['usd']  * $countcheckorder ) + ( $order[$k]['usd'] * 21 );

										$finalvaluekhr = ( $orders[$k]['khr']  * $countcheckorder ) + ( $orders[$k]['khr'] * 21 );
									
								}elseif(end($checkorder) == 'L 22'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $order[$k]['usd']  * $countcheckorder ) + ( $order[$k]['usd'] * 22 );

										$finalvaluekhr = ( $order[$k]['khr']  * $countcheckorder ) + ( $order[$k]['khr'] * 22 );

									
								}else{

									$finalvalueusd = $order[$k]['usd'] * $countcheckorder;

									$finalvaluekhr = $order[$k]['khr'] * $countcheckorder;

									if($finalvalueusd == 0){

										$finalvalueusd = "";
								
									}elseif($finalvaluekhr == 0){

										$finalvaluekhr = "";

									}									

								}

								$orderid = $order[$k]['order_id'];

								// print_r($orderid);

								$query= "UPDATE 2dbetform SET totalusd = '$finalvalueusd', totalkhr = '$finalvaluekhr' WHERE order_id='$orderid'";

							// print_r($query);

							// die();

							if ($conn->query($query) === TRUE) {

							$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
							$result = mysqli_query($conn, $sql);

						 	if (mysqli_num_rows($result) > 0) {

					  			while($row = mysqli_fetch_assoc($result)) {
					            	
									$orders[] = $row;

					  		}

				  			// echo "<pre>";
				  			// print_r($order);

				  			// die();
				
								$success['success'] = "Bet placed successfully.";


							}else{

								$error['error'] = "Bet placed but unable to fetch last bid details.";
								
							}


							}else{

								$error['error'] = "Unable to update total figure.";

							}


				        }else{

							$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				        }
					}

				}
		
			}

		
		}else{

			$error['usdandkhrerror'] = "Either usd or khr must have a value."; 
		}

	}else{


		// echo $counttxt3d;

		// echo $countusd;

		// echo $countkhr;

		// $finalvalueusd = 0;

						// $finalvaluekhr = 0;

		$txt3d = array();

		$usd = array();

		$khr = array();

		for( $i = 0 ; $i < $counttxt3d ; $i++){

			if($_POST['txt3d'][$i] == ""){

				$error['txt3d'] = "txt3d value row is empty.";
			
			}elseif($_POST['txt3d'][$i] != ""){

				$txt3d[$i] = mysqli_real_escape_string( $conn, $_POST['txt3d'][$i] );

				if(strlen($txt3d[$i]) < 3){

				 	$error['error'] = "txt3d cannot be smaller than 3.";

				 }
				
			}else{

				$error['txt3d'] = "Something unexpected occured in txt3d value.";

			}

		}


		for( $i = 0 ; $i < $countusd ; $i++){

			if($_POST['usd'][$i] == ""){

				// $error['usd'] = "usd row is empty.";

			}elseif($_POST['usd'][$i] != ""){

				$usd[$i] = mysqli_real_escape_string( $conn, $_POST['usd'][$i] );
				
			}else{

				$error['usd'] = "Something unexpected occured in usd value.";

			}

		}


		for( $i = 0 ; $i < $countkhr ; $i++){

			if($_POST['khr'][$i] == ""){

				// $error['khr'] = "khr row is empty.";

			}elseif($_POST['khr'][$i] != ""){

				$khr[$i] = mysqli_real_escape_string( $conn, $_POST['khr'][$i] );
				
			}else{

				$error['khr'] = "Something unexpected occured in khr value.";

			}

		}

		// $usd_empty = in_array("", $usd, true);
		
		// $khr_empty = in_array("", $khr, true);

		// var_dump($usd_empty);
		// var_dump($khr_empty);

		// if($usd_empty && $khr_empty){

		// 	echo "true";

		// }else{

		// 	echo "false";
		// }

		$countcheck = count($_POST['checkbox']);

		$stagecheck = count($_POST['Stage_checkbox']);

		$arra = array();

		if($countcheck == 0 && $stagecheck == 0){

				$error['checkbox'] = "Please select at least one of the checkbox";

			}elseif($countcheck > 0 || $stagecheck > 0){

				if( $countcheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

				}elseif($countcheck > 1 && $stagecheck == 1){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

						$arra[] = $checkboxlevel[$j];

					}

					$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					array_push($arra, $stagelevel);

				}elseif($countcheck > 1 && $stagecheck == 0){

					for( $j = 0; $j < $countcheck ; $j++ ){

						$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

						$arra[] = $checkboxlevel[$j];

					}
					
				}elseif($countcheck == 0 && $stagecheck == 1){

					$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					array_push($arra, $checkboxlevel );

				}elseif($countcheck == 1 && $stagecheck == 1){

					$checkboxlevel[0] = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

					$arra[] = $checkboxlevel[0];

					array_push($arra, $stagelevel);

				}

			}

			// print_r($arra);

		if(!empty($usd) || !empty($khr)){

			// echo "row not empty";

			$userid = $_SESSION['userid'];

				$order_id = uniqid();

				if(is_array($arra)){

					$checkboxlevel = implode(',', $arra);
					
				}

				// print_r($checkboxlevel);
				// var_dump($stagelevel);







		// check whether multiple checkbox or checkboxlevel has been posted //

			$radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

			if($radio != ""){

				$error['error'] = "Radio option cannot be selected in this case.";

			}elseif($radio == ""){

				$usdval[] = $usd;
				$khrval[] = $khr;

				// $usdval[] = $usdval[0];
				// $khrval[] = $khrval[0];
				print_r($usdval[0]);
				print_r($khrval[0]);

				$checkorder = count($checkboxlevel);

				// print_r($arra);

				$stageorder = count($arra);

				$checkboxlevel = explode(',', $checkboxlevel);
				
				$countcheckorder = $counttxt3d;

				$finalvalueusd = 0;

				$finalvaluekhr = 0;
				
				for($j = 0 ; $j < $counttxt3d; $j++ ){								

					$countcheckorder = count($arra);
					// echo "<br/>";
					// print_r($khr);

					// die();

					$finalvalueusd = 0;

					$finalvaluekhr = 0;
								// echo $j;
								// echo $counttxt3d;
						

								if(end($checkboxlevel) == 'L 19'){

								$countcheckorder = $countcheckorder - 1;

								// echo $countcheckorder;
								// echo count($checkboxlevel);

									
										// print_r($usd[0]);
										// print_r($usdval);
										// print_r($khr[0]);
										// print_r($khrval);
										$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 19 );

										$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 19 );

										// echo "<br/>";

										// echo $finalvalueusd;

										// echo "<br/>";

										// echo $finalvalueusd;
										
										// echo "<br/>";

										// echo $countcheckorder;

										// echo "<br/>";

								}elseif(end($checkboxlevel) == 'L 20'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 20 );

										$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 20 );									

								}elseif(end($checkboxlevel) == 'L 21'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 21 );

										$finalvaluekhr =  ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 21 );
									
								}elseif(end($checkboxlevel) == 'L 22'){

								$countcheckorder = $countcheckorder - 1;

										$finalvalueusd = ( $usd[$j]  * $countcheckorder ) + ( $usd[$j] * 22 );

										$finalvaluekhr = ( $khr[$j]  * $countcheckorder ) + ( $khr[$j] * 22 );

									
								}else{


									$finalvalueusd = $usd[0][$j] * count($arra);


									$finalvaluekhr = $khr[0][$j] * count($arra);					

									// print_r($usdval[0][$j]);

									// print_r($khrval[0][$j]);
									// print_r($countcheckorder);

								}


								// echo "<br/>";

								// print_r($finalvalueusd);
								
								// echo "<br/>";
								
								// print_r($finalvaluekhr);









					// if($usd[$j] == ""){

					// 	$usd[$j] = 0;
					// }

					// if($khr[$j] == ""){

					// 	$khr[$j] = 0;
					// }



					// 	$users[$j] = array(


					// 			'user_id' => $userid,

					// 			'order_id' => $order_id,

					// 			'txt3d' => $txt3d[$j],

					// 			'usd' => $usd[$j],

					// 			'khr' => $khr[$j],

					// 			'radiobox' => $radio,

					// 			'checklevel' => $checkboxlevel 

					// 		);

							if(is_array($checkboxlevel)){

								$checkboxlevel = implode(',', $checkboxlevel);
								
							}

							$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `2dtxt`, `usd`, `khr`, `radiobox`, `checklevel`, `stage`, `type`, `totalusd`, `totalkhr` ) VALUES( '$userid', '$order_id', '$txt3d[$j]', '$usd[$j]', '$khr[$j]', '$radio', '$checkboxlevel', '1', '3dbetform', '$finalvalueusd', '$finalvaluekhr' )";
							// print_r($query);
							// die();
							$order = array();

							if ($conn->query($query) === TRUE) {

								$last_id = mysqli_insert_id($conn);

								$arrayid[$j] = $last_id; 

								// echo $arrayid[$j];

							} else {
														
								$error['error'] = "Unable to place bet.";
													
							}

						// }

				}


				$countarrayid = count($arrayid);


					// for($k = 0 ; $k < $countarrayid ; $k++){

						// $sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
						// $result = mysqli_query($conn, $sql);

					 	// if (mysqli_num_rows($result) > 0) {

				  	// 		while($row = mysqli_fetch_assoc($result)) {
				            	
							// 	$order[] = $row;

				  	// 		}
				  	// 		// echo "<pre>";
				  	// 		// print_r($order);


				   //      }else{

							// $error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
				   //      }
					// }
			}		

		}

		// $countcheck = count($_POST['checkbox']);
		
		// $stagecheck = count($_POST['Stage_checkbox']);

		// $arra = array();

		// if($countcheck == 0 && $stagecheck == 0){

		// 		$error['checkbox'] = "Please select at least one of the checkbox";

		// 	}elseif($countcheck > 0 || $stagecheck > 0){


		// 		if( $countcheck == 1){

		// 			$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['checkbox'][0] );

		// 		}elseif($countcheck > 1 && $stagecheck == 1){

		// 			for( $j = 0; $j < $countcheck ; $j++ ){

		// 				$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

		// 				$arra[] = $checkboxlevel[$j];

		// 			}

		// 			$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

		// 			array_push($arra, $stagelevel);

		// 		}elseif($countcheck > 1 && $stagecheck == 0){

		// 			for( $j = 0; $j < $countcheck ; $j++ ){

		// 				$checkboxlevel[$j] = mysqli_real_escape_string( $conn, $_POST['checkbox'][$j] );

		// 				$arra[] = $checkboxlevel[$j];

		// 			}

		// 		}elseif($countcheck == 0 && $stagecheck == 1){

		// 			$checkboxlevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

		// 			array_push($arra, $checkboxlevel );

		// 		}elseif($countcheck == 1 && $stagecheck == 1){

		// 			$checkboxlevel[0] = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

		// 			$stagelevel = mysqli_real_escape_string( $conn, $_POST['Stage_checkbox'][0] );

		// 			$arra[] = $checkboxlevel[0];

		// 			array_push($arra, $stagelevel);

		// 		}

		// 	}

		// if(!empty($usd) && !empty($khr)){

		// 	$userid = $_SESSION['userid'];

		// 		$order_id = uniqid();

		// 		if(is_array($arra)){

		// 			$checkboxlevel = implode(',', $arra);

		// 		}else{

		// 		}

		// check whether multiple checkbox or checkboxlevel has been posted //


			// $radio = mysqli_real_escape_string( $conn, $_POST['optradio'] );

			// if($radio != ""){

			// 	$error['error'] = "Radio option cannot be selected in this case.";

			// }elseif($radio == ""){

			// 	for($j = 0 ; $j < $counttxt3d; $j++ ){

			// 		$users[$j] = array(


			// 				'user_id' => $userid,

			// 				'order_id' => $order_id,

			// 				'txt3d' => $txt3d[$j],

			// 				'usd' => $usd[$j],

			// 				'khr' => $khr[$j],

			// 				'radiobox' => $radio,

			// 				'checklevel' => $checkboxlevel 

			// 			);

			// 			$query= "INSERT INTO 2dbetform( `user_id`, `order_id`, `txt3d`, `usd`, `khr`, `radiobox`, `checklevel` ) VALUES( '$userid', '$order_id', '$txt3d[$j]', '$usd[$j]', '$khr[$j]', '$radio', '$checkboxlevel' )";

			// 			$order = array();

			// 			if ($conn->query($query) === TRUE) {

			// 				$last_id = mysqli_insert_id($conn);

			// 				$arrayid[$j] = $last_id; 

			// 			} else {
													
			// 				$error['error'] = "Unable to place bet.";
												
			// 			}

			// 	}

			// 	$countarrayid = count($arrayid);

			// 		for($k = 0 ; $k < $countarrayid ; $k++){

			// 			$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
			// 			$result = mysqli_query($conn, $sql);

			// 		 	if (mysqli_num_rows($result) > 0) {

			// 	  			while($row = mysqli_fetch_assoc($result)) {
				            	
			// 					$orders[] = $row;

			// 	  			}


			// 	  			$checkorder = explode(',', $orders[$k]['checklevel']);
								
			// 					$stageorder = explode(',', $orders[$k]['Stagelevel']);
								
			// 					$countcheckorder = count($checkorder);


			// 					if(end($checkorder) == 'L 23'){

			// 					$countcheckorder = $countcheckorder - 1;

			// 							$finalvalueusd = $finalvalueusd +  ( $orders[$k]['usd']  * $countcheckorder ) + ( $orders[$k]['usd'] * 23 );

			// 							$finalvaluekhr = $finalvaluekhr +  ( $orders[$k]['khr']  * $countcheckorder ) + ( $orders[$k]['khr'] * 23 );
								
			// 					}elseif(end($checkorder) == 'L 25'){

			// 					$countcheckorder = $countcheckorder - 1;

			// 							$finalvalueusd = $finalvalueusd +  ( $orders[$k]['usd']  * $countcheckorder ) + ( $orders[$k]['usd'] * 25 );

			// 							$finalvaluekhr = $finalvaluekhr +  ( $orders[$k]['khr']  * $countcheckorder ) + ( $orders[$k]['khr'] * 25 );									

			// 					}elseif(end($checkorder) == 'L 27'){

			// 					$countcheckorder = $countcheckorder - 1;

			// 							$finalvalueusd = $finalvalueusd +  ( $orders[$k]['usd']  * $countcheckorder ) + ( $orders[$k]['usd'] * 27 );

			// 							$finalvaluekhr = $finalvaluekhr +  ( $orders[$k]['khr']  * $countcheckorder ) + ( $orders[$k]['khr'] * 27 );
									
			// 					}elseif(end($checkorder) == 'L 29'){

			// 					$countcheckorder = $countcheckorder - 1;

			// 							$finalvalueusd = $finalvalueusd +  ( $orders[$k]['usd']  * $countcheckorder ) + ( $orders[$k]['usd'] * 29 );

			// 							$finalvaluekhr = $finalvaluekhr +  ( $orders[$k]['khr']  * $countcheckorder ) + ( $orders[$k]['khr'] * 29 );

									
			// 					}else{

			// 						$finalvalueusd = $finalvalueusd + $orders[$k]['usd'] * $countcheckorder;

			// 						$finalvaluekhr = $finalvaluekhr + $orders[$k]['khr'] * $countcheckorder;

			// 						if($finalvalueusd == 0){

			// 							$finalvalueusd = "";
								
			// 						}elseif($finalvaluekhr == 0){

			// 							$finalvaluekhr = "";

			// 						}									

			// 					}

			// 					$orderid = $orders[$k]['order_id'];

			// 					$query= "UPDATE 2dbetform SET totalusd = '$finalvalueusd', totalkhr = '$finalvaluekhr' WHERE order_id='$orderid'";


			// 				if ($conn->query($query) === TRUE) {

			// 					$sql = "SELECT * FROM `2dbetform` WHERE `id` = '$arrayid[$k]'";
				    	
			// 			$result = mysqli_query($conn, $sql);

			// 		 	if (mysqli_num_rows($result) > 0) {

			// 	  			while($row = mysqli_fetch_assoc($result)) {
				            	
			// 					$order[] = $row;

			// 	  			}

			// 					$success['success'] = "Bet placed successfully.";


			// 				}else{

			// 					$error['error'] = "Bet placed but unable to fetch last bid details.";
								
			// 				}


			// 				}else{

			// 					$error['error'] = "Unable to update total figure.";

			// 				}


			// 	        }else{

			// 				$error['error'] = "Bet placed but unable to fetch last bid details.";
				            	
			// 	        }
			// 		}

			// }
			
		// }
	
	}


	// end of form parameters //

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

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

}



;?>


<!DOCTYPE html>
<html>
<head>

	<title>3D Betform | Lottery System</title>

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


			<?php if(isset($_GET['usd-error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_GET['usd-error'];?>

			</div>

			<?php }?>

			<?php if(isset($_GET['khr-error'])){?>

			<div class="alert alert-danger">
					
				<?php echo $_GET['khr-error'];?>

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

		    	<div>
		    		
		      		<?php if(isset($success['success'])){

						// check if only one row is inserted //
						
						$count = count($order);
						// echo $count;

						$finalvalueusd = 0;

						$finalvaluekhr = 0;

						if($count == 1){

							$checkorder = explode(',', $order[0]['checklevel']); 

							$countcheckorder = count($checkorder);

							if(end($checkorder) == 'L 19'){

								// $countcheckorder = 23;

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 23;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 19 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 19 );
							
							}elseif(end($checkorder) == 'L 20'){

								// $countcheckorder = 25;

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 23;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 20 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 20 );


							}elseif(end($checkorder) == 'L 21'){

								// $countcheckorder = 27;


								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 23;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 21 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 21 );

								
							}elseif(end($checkorder) == 'L 22'){

								// $countcheckorder = 29;

								// $countcheckorder = 23;

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 23;

								$finalvalueusd = ( $order[0]['usd']  * $countcheckorder ) + ( $order[0]['usd'] * 22 );

								$finalvaluekhr = ( $order[0]['khr']  * $countcheckorder ) + ( $order[0]['khr'] * 22 );								
							}else{

							// if($order[0]['usd'] != 0.00 && $order[0]['khr'] != 0.00){

							// 	echo "sdss";

							// 	$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

							// 	$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

							// }elseif($order[0]['usd'] != 0.00 || $order[0]['khr'] != 0.00){

								$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

								// var_dump($finalvaluekhr);



								if($finalvalueusd == 0){

									$finalvalueusd = "";
								
								}elseif($finalvaluekhr == 0){

									$finalvaluekhr = "";

								}


							 // }elseif($order[0]['usd'] != 0.00 || $order[0]['khr'] == 0.00){

							 // 	echo "khr zero";
							
							 // }elseif($order[0]['khr'] != 0.00 || $order[0]['usd'] == 0.00){

							 // 	echo "usd zero";
							 // }

							 }				


						?>


						<div id='screen-view-container'><input type='button' value='Print' onclick="javascript:printerDiv('print-table-up')" /></div>

							<div class="table-responsive" id="print-table-up">          
							
							  	<table class="table table-primary">
							
								    <thead>
							
								      <tr class="table-primary">
								        <th>3d</th>
								        <th>USD</th>
								        <th>KHR</th>
								        <th>PO</th>
								      </tr>
							
								    </thead>
							
								    <tbody>
								      <tr>
								      	<td><?php echo $order[0]['2dtxt'];?></td>
								      	<td><?php echo $order[0]['usd'];?></td>
								      	<td><?php echo $order[0]['khr'];?></td>
								      	<td>( <?php echo $order[0]['checklevel'];?> )</td>
								      </tr>

								      <tr>
								      	<td>Total</td>
								      	<td><?php echo $finalvalueusd;?></td>
								      	<td><?php echo $finalvaluekhr;?></td>
								      	<td><?php echo $order[0]['created_at'];?></td>
								      </tr>
							
								    </tbody>
							
								</table>
							
							</div>

						<?php }elseif($count > 1){?>

							<?php $count; 

							$finalvalueusd = 0;

							$finalvaluekhr = 0;
							// echo "<pre>";
							// print_r($order);

							for($i = 0 ; $i < $count; $i++){

								$checkorder = explode(',', $order[$i]['checklevel']);
								$stageorder = explode(',', $order[$i]['Stagelevel']);

								// print_r($order);
								// print_r($stageorder);
								// print_r($checkorder);
								
								$countcheckorder = count($checkorder);


								if(end($checkorder) == 'L 19'){

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 23;

										$finalvalueusd = $finalvalueusd + ( $order[$i]['usd']  * $countcheckorder ) + ( $order[$i]['usd'] * 19 );

										$finalvaluekhr = $finalvaluekhr + ( $order[$i]['khr']  * $countcheckorder ) + ( $order[$i]['khr'] * 19 );
								
								}elseif(end($checkorder) == 'L 20'){

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 25;

										$finalvalueusd = $finalvalueusd + ( $order[$i]['usd']  * $countcheckorder ) + ( $order[$i]['usd'] * 20 );

										$finalvaluekhr = $finalvaluekhr +( $order[$i]['khr']  * $countcheckorder ) + ( $order[$i]['khr'] * 20 );									

								}elseif(end($checkorder) == 'L 21'){

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 27;

										$finalvalueusd = $finalvalueusd + ( $order[$i]['usd']  * $countcheckorder ) + ( $order[$i]['usd'] * 21 );

										$finalvaluekhr = $finalvaluekhr + ( $order[$i]['khr']  * $countcheckorder ) + ( $order[$i]['khr'] * 21 );
									
								}elseif(end($checkorder) == 'L 22'){

								$countcheckorder = $countcheckorder - 1;
									// $countcheckorder = 29;

									// if($checkorder[$i] == "L 29"){
										
									// 	echo "final usd value is " . $finalvalueusd."<br/>";
									// 	echo "final usd value is " . $order[$i]['usd']."<br/>";

									// 	$finalvalueusd = $finalvalueusd + ($oder[$i]['usd']*29) ;

									// 	$finalvaluekhr = $finalvaluekhr + $order[$i]['khr']  * 29;

									// 	echo "if L 29 " . $finalvalueusd."<br/>";

									// }else{

										$finalvalueusd = $finalvalueusd + ( $order[$i]['usd']  * $countcheckorder ) + ( $order[$i]['usd'] * 22 );

										$finalvaluekhr = $finalvaluekhr + ( $order[$i]['khr']  * $countcheckorder ) + ( $order[$i]['khr'] * 22 );

										// echo "order usd ". $order[$i]['usd']."<br/>";
										// echo "countcheckorder ". $countcheckorder."<br/>";
										// echo "L 29 ". ($order[$i]['usd']*29)."<br/>";
										// echo "final usd  ". $finalvalueusd."<br/>";
										
									// }

									
								}else{

									$finalvalueusd = $order[$i]['usd'] * $countcheckorder * $count;

									$finalvaluekhr =  $order[$i]['khr'] * $countcheckorder * $count;

									if($finalvalueusd == 0){

										$finalvalueusd = "";
								
									}elseif($finalvaluekhr == 0){

										$finalvaluekhr = "";

									}			
									// echo "<pre>";
									// print_r($order[$i]['usd']);						
									// print_r($countcheckorder);						

								}

								// if($order[0]['usd'] != 0.00){

								// 	$finalvalueusd = $order[0]['usd'] * $countcheckorder * $count;

								// }elseif($order[0]['khr'] != 0.00){

								// 	$finalvaluekhr = $order[0]['khr'] * $countcheckorder * $count;

								// }else

								// if($order[$i]['usd'] != 0.00 && $order[$i]['khr'] != 0.00){

									
								// 	$finalvalueusd = $order[$i]['usd'] * $countcheckorder;

								// 	$finalvaluekhr = $order[$i]['khr'] * $countcheckorder;

								// 	echo "usd not empty ".$finalvalueusd." and khr not empty ". $finalvaluekhr."<br/>";
								
								// }elseif($order[$i]['usd'] == 0.00 && $order[$i]['khr'] != 0.00){
									

								// 	$finalvalueusd = $order[$i]['usd'] * $countcheckorder;

								// 	$finalvaluekhr = $order[$i]['khr'] * $countcheckorder;

								// 	echo "usd empty " .$finalvalueusd ." and khr not empty". $finalvaluekhr."<br/>";

								// }elseif($order[$i]['usd'] != 0.00 && $order[$i]['khr'] == 0.00){
								
									// echo "usd not empty ".$finalvalueusd." and khr empty ".$finalvaluekhr."<br/>";
								// }


							}	
								 // echo "<br/>";
								 // print_r($finalvaluekhr);
								 // print_r($finalvalueusd);


							 ?>

							<div id='screen-view-container'><input type='button' value='Print' onclick="javascript:printerDiv('print-table')" /></div>

								<div class="table-responsive" id="print-table">          
							
							  	<table class="table table-primary">
							
								    <thead>
							
								      <tr class="table-primary">
								        <th>3d</th>
								        <th>USD</th>
								        <th>KHR</th>
								        <th>PO</th>
								      </tr>
							
								    </thead>
							
								    <tbody>

								<?php foreach ($order as $key => $value) {?>
								      <tr>
								      	<td><?php echo $value['2dtxt'];?></td>
								      	<td><?php echo $value['usd'];?></td>
								      	<td><?php echo $value['khr'];?></td>
								      	<td>( <?php echo $value['checklevel'];?> )</td>
								      </tr>

								<?php }?>

								      <tr>
								      	<td>Total</td>
								      	<td><?php echo $finalvalueusd;?></td>
								      	<td><?php echo $finalvaluekhr;?></td>
								      	<td><?php echo $order[0]['created_at'];?></td>
								      </tr>
							
								    </tbody>
							
								</table>
							
							</div> 

			      		<?php  } }?>
	    			
		    	</div>

				<form action="3d1-betform.php" method="POST" id="3dform">
              
            		<input type="hidden" id="lastStage" value="1" />

                	<div class="card-header"><h3 id="Stage" data-Stage="1">Stage 1</h3></div>
              		
              		<div class="first-line">

              			<span class="btn btn-primary" id="add" data-level="1">+</span>

                		<div class="form-group">
                
                  			<!-- <label for="3d">3D:</label> -->
                
                  			<input type="text" id="3d1" class="form-control 3d" name="txt3d[]" placeholder="3D value">
                
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

		            	<label class="radio-inline"><input type="radio" name="optradio" value="5X">X</label>
		              
		                <label class="radio-inline"><input type="radio" name="optradio" value="5L">5 L</label>
		              
		                <label class="radio-inline"><input type="radio" name="optradio" value="5C">5 C</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="5R">5 R</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10L">10 L</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10C">10 C</label>

		                <label class="radio-inline"><input type="radio" name="optradio" value="10R">10 R</label>

		            </div>

 		            <div class="checkbox upper">
 	               
    		            <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="A" name="checkbox[]" id="A">A</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="B" name="checkbox[]" id="B">B</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="C" name="checkbox[]" id="C">C</label>
		
		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="D" name="checkbox[]" id="D">D</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="H" name="checkbox[]" id="H">H</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="I" name="checkbox[]" id="I">I</label>

		                <label class="checkbox-inline"><input type="checkbox" class="singleCheckbox" value="N" name="checkbox[]" id="N">N</label>

		            </div>

			            <input type="hidden" value="" id="checkbox-val">

		            <div class="checkbox lower">
                
		                <label class="checkbox-inline"><input type="checkbox" id="l19" value="L 19" class="checkStage" name="Stage_checkbox[]">L 19</label>
		                
		                <label class="checkbox-inline"><input type="checkbox" id="l20" value="L 20" class="checkStage" name="Stage_checkbox[]">L 20</label>

		                <label class="checkbox-inline"><input type="checkbox" id="l21" value="L 21" class="checkStage" name="Stage_checkbox[]">L 21</label>

		                <label class="checkbox-inline"><input type="checkbox" id="l22" value="L 22" class="checkStage" name="Stage_checkbox[]">L 22</label>
		                
		            </div>

              		<button type="submit" class="btn btn-default">Submit</button>
            
           		</form>            

			</div>

		</section>

	</div>

	<script type="text/javascript">

		$(document).ready(function(){

		var ab  = $.now();

		var date = new Date(ab*1000);

		console.log(date);

		var level = 1;

 		$(document).on('click', '#add', function(event){

 			event.preventDefault();

              $('.first-line').append('<div class="fields"><span class="btn btn-primary plus-sign" style="visibility:hidden;">+</span><div class="form-group"> <input type="text" id="3d1" class="form-control 2d" name="txt3d[]" placeholder="3D value"> </div><div class="form-group"> <input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="USD"> </div><div class="form-group"> <input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="KHR"> </div></div>');

 			level++

		});

 	});

  var permArr = [];

  var usedChars = [];

  function permute(input) {
    
    var i, ch;
    
    for (i = 0; i < input.length; i++) {
      
      ch = input.splice(i, 1)[0];
      
      usedChars.push(ch);
    
    if (input.length == 0) {
    
      permArr.push(usedChars.slice());
    
    }
    
    permute(input);
    
    input.splice(i, 0, ch);
    
    usedChars.pop();
  
  }
  
    return permArr

  };
  
  $(document).ready(function(){

    $('#adds').click(function(event){

      var level = $('#lastlevel').val();

      console.log("level is " + level);

      var txt3d = $('#3d'+level).val();

      var usd = $('#usd'+level).val();

      var khr = $('#khr'+level).val();

      console.log("3d value is " + txt3d);

      if( txt3d != '' && txt3d.length == 3 &&(usd != '' || khr != '')){

        var radioValue = $("input[name='optradio']:checked").val();

        console.log(radioValue);
        
        if(radioValue){
        
          console.log("Your are a - " + radioValue);
          
          txt3d = parseInt(txt3d);

          if(radioValue == '5OD'){

            if(level > '4'){

               swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              // ab = ab.split("");

              console.log(ab.length);

              // var val = parseInt(ab[1]);
          
              // var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              // var result = textVal + 1;

              // txt3d = txt3d + 2;
              // console.log("after abplus " + result );

              // result = result.toString();

              // ab = ab[0]+result+ab[2];

              // ab = ab.split("");
              // var result = JSON.stringify(permute(ab))
              var result = getPermutations(ab);

              console.log("result is " + result);
              // result = JSON.stringify(result);
              // var rr = result.split(" " , result);
              console.log(result[1]);

              level ++;

              $('#lastlevel').val(level); 

              for($i = 0 ; $i < result.length ; $i ++ ){

                if($i == 0){
                  continue;
                }
                level = $i + 1;
              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+result[$i]+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>');

            }

            }

          }else if(radioValue == '5L'){

            if(level > '4'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[0]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = result+ab[1]+ab[2];

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }

          }else if(radioValue == '5C'){

             if(level > '4'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[1]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = ab[0]+result+ab[2];

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="1">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }

           }else if(radioValue == '5R'){

             if(level > '4'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[2]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = ab[0]+ab[1]+result;

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }
            
          }else if(radioValue == '10L'){

             if(level > '9'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[0]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = result+ab[1]+ab[2];

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }    

          }else if(radioValue == '10C'){

             if(level > '9'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[1]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = ab[0]+result+ab[2];

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }

          }else if(radioValue == '10R'){

             if(level > '9'){

             swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              var ab = txt3d.toString();
              
              ab = ab.split("");

              var val = parseInt(ab[2]);
          
              var textVal = parseInt(val || "0");
          
              // ab[0] = ab[0]+1;
              var result = textVal + 1;

              // txt3d = txt3d + 2;
              console.log("after abplus " + result );

              result = result.toString();

              ab = ab[0]+ab[1]+result;

              console.log("ab result is " + ab);

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d'+level+'" class="form-control 3d" name="txt3d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+ab+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }

          }else{

            swal("Oops!", "Please handle checkbox validation error!", "warning");

            // nothing goes here all checkbox conditions have been checked above

          }

          }else{

            swal("Oops!", "Please select any of the radiobutton!", "warning");

          }  

        }else{

          swal("Oops!", "Please input all fields before adding extra fields!", "warning");
       
        }

    });

  });

  $(document).on('click', '.radio-inlines', function(){


      var d3val = $('#3d1').val();

      var usdval = $('#usd1').val();

      var khrval = $('#khr1').val();

      // console.log(d3val);

      // console.log(usdval);

      // console.log(khrval);

      $('#lastlevel').val('1');

      $('.first-line').html(' <div class="card-header"><h3 id="level" data-level="1">Level 1</h3></div><div class="form-group"> <label for="3d">3d:</label> <input type="text" id="3d1" class="form-control 3d" name="txt3d[]" placeholder="Only 3 digit number between 101-999 allowed" value="'+d3val+'"> </div><div class="form-group"><label for="usd">USD:</label><input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 )" value="'+usdval+'"> </div><div class="form-group"><label for="khr">KHR:</label><input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khrval+'"></div>');

    });


  $(document).on('keypress', '.3d', function(event){

        var data = $(this).attr('id');

        var targetValue = $(this).val();

        console.log("target value is " + targetValue);

        if (event.which ===8 || event.which === 13 || event.which === 37 || event.which === 39 || event.which === 46) { 
          return;

        }

       if (event.which > 47 &&  event.which < 58  && targetValue.length < 3) {

          // if( targetValue > 101 && targetValue < 999 ){
        
            var c = String.fromCharCode(event.which);

            var val = parseInt(c);
          
            var textVal = parseInt(targetValue || "0");
          
            var result = textVal + val;

            if (result < 0 || result > 99) {
          
               event.preventDefault();
          
            }
       
       }
       
       else {
       
           event.preventDefault();
       
       }


    });

  $(document).on('keypress', '.usd', function(event){

        var data = $(this).attr('id');

        var targetValue = $(this).val();

        console.log(targetValue);

        console.log(event.keyCode);

        if (event.which ===8 || event.which === 13 || event.which === 37 || event.which === 39 || event.which === 46) { 
          return;

        }

        // if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          
        //   event.preventDefault();
        
        // }else{
        
        if (event.which > 47 &&  event.which < 58  && targetValue.length < 6) {
        
          var c = String.fromCharCode(event.which);

          var val = parseInt(c);
        
          var textVal = parseInt(targetValue || "0");
        
          var result = textVal + val;

          if ( result < 0 ) {
        
             event.preventDefault();
        
          }

          if (targetValue === "0") {
        
            $(this).val(val);
        
            event.preventDefault();
        
          }
       
       }

       
       else {
       
           event.preventDefault();
       
       }

    });

  $(document).on('click', '.checkStage', function(){

    var checked = $(this).prop('checked');

 console.log("stage check is " + checked);

    if(checked){

      var checkboxValue = $(this).val();

      $('#checkbox-val').val(checkboxValue);

      console.log(checkboxValue);

     if(checkboxValue == 'L 19'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);
  
        $('#l20').prop('checked', false);
        
        $('#l21').prop('checked', false);
        
        $('#l22').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'L 20'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);

        $('#l19').prop('checked', false);
        
        $('#l21').prop('checked', false);
        
        $('#l22').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'L 21'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#I').prop('checked', false);

        $('#l19').prop('checked', false);
        
        $('#l20').prop('checked', false);
        
        $('#l22').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'L 22'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#I').prop('checked', false);
        
        $('#N').prop('checked', false);

        $('#l19').prop('checked', false);
        
        $('#l20').prop('checked', false);
        
        $('#l21').prop('checked', false);

        // $('.singleCheckbox').prop('checked', false);

      }

    }else{

      console.log('checkbox unclicked');

      $('#checkbox-val').val('lower');

    }

  });


  $(document).on('click', '.singleCheckbox', function(){

    var checked = $(this).prop('checked');

     console.log("checked is " + checked);

     var value = $(this).val();

     console.log("checked value is " + value);

     var levelval = $('#checkbox-val').val();

     console.log('level val is ' + levelval);

     if(checked == true && levelval == 'L 19'){

        $('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);
     	
     }else if(checked == true && levelval == 'L 20'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);

     }else if(checked == true && levelval == 'L 21'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#I').prop('checked', false);

     }else if(checked == true && levelval == 'L 22'){

     	$('#A').prop('checked', false);
  
        $('#B').prop('checked', false);
  
        $('#C').prop('checked', false);
  
        $('#D').prop('checked', false);

        $('#H').prop('checked', false);
        
        $('#I').prop('checked', false);
        
        $('#N').prop('checked', false);

     }

  });

  $(document).on('click', '.btn-defaults', function(event){

    var txt3d = $('#3d1').val();

    var usd = $('#usd1').val();

    var khr = $('#khr1').val();

    console.log(txt3d);

    console.log(usd);

    console.log(khr);

    if(txt3d != "" && txt3d.length == 3){

      if((usd != "") || (khr != "" && khr.length == 3)){

        var status = $('#checkbox-val1').val();

        console.log('status is ' + status);
        
        // console.log($(this).parent().find('.upper').find('.checkbox-inline').find('.singleCheckbox').attr('checked'));
        
        // console.log($(this).parent().find('.lower').find('.checkbox-inline').find('.singleCheckbox').prop('checked'));
        
        if(status == 'upper'){

          // event.preventDefault();
          
          // swal("Oops!", "Checkbox checked!", "warning");

        }else if(status == 'lower'){

          event.preventDefault();

          console.log('status is false but still it is showing this message');
          
          swal("Oops!", "None of the checkbox is checked!", "warning");

        }else{

          event.preventDefault();

          swal("Oops!", "Please check any of the checkboxes before moving further.", "warning");          

        }

        // $('#3dform').submit();

          // event.preventDefault();
          
          // swal("Oops!", "Condition satisfied!", "warning"); 

      }else{

        event.preventDefault();

        swal("Oops!", "Please input either USD or KHR in valid format!", "warning");
      }

    }else{

      event.preventDefault();
           
      swal("Oops!", "Please input 3D field with minimum 3 digits between 101-999 before moving forward!", "warning");

    }

  });

   function getPermutations(string) {
      var results = [];

      if (string.length === 1) 
      {
        results.push(string);
        return results;
      }

      for (var i = 0; i < string.length; i++) 
      {
        var firstChar = string[i];
        var otherChar = string.substring(0, i) + string.substring(i + 1);
        var otherPermutations = getPermutations(otherChar);
        
        for (var j = 0; j < otherPermutations.length; j++) {
          results.push(firstChar + otherPermutations[j]);
        }
      }
      return results;
    }
    
    var permutation = getPermutations('YES');
    console.log("Total permutation: "+permutation.length);
    console.log(permutation);

</script>

<script language="javascript" type="text/javascript">
		
		function printerDiv(divID) {
		//Get the HTML of div

		var divElements = document.getElementById(divID).innerHTML;

		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;

		//Reset the pages HTML with divs HTML only

		     document.body.innerHTML = 

		     "<html><head><title></title></head><body>" + 
		     divElements + "</body>";



		//Print Page
		window.print();

		//Restore orignal HTML
		document.body.innerHTML = oldPage;

		}
	
	</script>

</body>
</html>