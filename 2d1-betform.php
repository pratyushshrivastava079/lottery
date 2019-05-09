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

		    			<span><a href="#">Reports</a></span>
		    			
		    			<span> | </span>

		      			<?php if(isset($_SESSION['userid'])){?>
		      				
			      			<span><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></span>
		      			
		      			<?php }else{?>

			      			<span><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></span>

		      			<?php }?>
	    			
		    	</div>
				
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


	<script type="text/javascript">
		<script type="text/javascript">
  
  $(document).ready(function(){

    $('#add').click(function(event){

      var level = $('#lastlevel').val();

      console.log("level is " + level);

      var txt2d = $('#2d'+level).val();

      var usd = $('#usd'+level).val();

      var khr = $('#khr'+level).val();

      console.log("2d value is " + txt2d);

      if( txt2d != '' && txt2d.length == 2 &&(usd != '' || khr != '')){

        var radioValue = $("input[name='optradio']:checked").val();
        
        if(radioValue){
        
          console.log("Your are a - " + radioValue);
          
          txt2d = parseInt(txt2d);

          if(radioValue == '5OD'){

            if(level > '4'){

               swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              txt2d = txt2d + 2;

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="2d">2D:</label> <input type="text" id="2d'+level+'" class="form-control 2d" name="txt2d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+txt2d+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>');

            }

          }else if(radioValue == '5S'){

            if(level > '4'){

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{

              txt2d = txt2d + 1;

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="2d">2D:</label> <input type="text" id="2d'+level+'" class="form-control 2d" name="txt2d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+txt2d+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 

            }

          }else if(radioValue == '10S'){

             if(level == 10){

            console.log('matched');

              swal("Oops!", "You cannot add more fields!", "warning");

            }else{
              console.log('not matched');

              txt2d = txt2d + 1;

              level ++;

              $('#lastlevel').val(level); 

              $('.first-line').append('<div class="card-header"><h3 id="level" data-level="'+level+'">Level '+level+'</h3></div><div class="form-group"> <label for="2d">2D:</label> <input type="text" id="2d'+level+'" class="form-control 2d" name="txt2d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+txt2d+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd'+level+'" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usd+'"/> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr'+level+'" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khr+'"/></div>'); 
    
            }

          }else{
            // console.log('nothing matched');
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

  $(document).on('click', '.radio-inline', function(){

     var d2val = $('#2d1').val();

      var usdval = $('#usd1').val();

      var khrval = $('#khr1').val();

      // console.log(d3val);

      // console.log(usdval);

      // console.log(khrval);

      $('#lastlevel').val('1');

      $('.first-line').html(' <div class="card-header"><h3 id="level" data-level="1">Level 1</h3></div><div class="form-group"> <label for="2d">2D:</label> <input type="text" id="2d1" class="form-control 2d" name="txt2d[]" placeholder="Only 2 digit number between 00-99 allowed" value="'+d2val+'"> </div><div class="form-group"> <label for="usd">USD:</label> <input type="text" id="usd1" class="form-control usd" name="usd[]" placeholder="Only 6 digit float number is allowed ( eg 1.25 or 253.75 ) " value="'+usdval+'"> </div><div class="form-group"> <label for="khr">KHR:</label> <input type="text" id="khr1" class="form-control khr" name="khr[]" placeholder="Only 6 digit integer is allowed ( eg 20 or 35 or 1500 )" value="'+khrval+'"> </div>');

    });


  $(document).on('keypress', '.2d', function(event){

        var data = $(this).attr('id');

        var targetValue = $(this).val();

        if (event.which ===8 || event.which === 13 || event.which === 37 || event.which === 39 || event.which === 46) { 
          return;

        }

       if (event.which > 47 &&  event.which < 58  && targetValue.length < 2) {
        
          var c = String.fromCharCode(event.which);

          var val = parseInt(c);
        
          var textVal = parseInt(targetValue || "0");
        
          var result = textVal + val;

          if (result < 0 || result > 99) {
        
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

          if (result < 0 || result > 99) {
        
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

  $(document).on('click', '.checkLevel', function(){

 var checked = $(this).prop('checked');

    if(checked){

      var checkboxValue = $(this).val();

      $('#checkbox-val').val('upper');

      console.log(checkboxValue);

      if(checkboxValue == 'l23'){

        $('#l29').prop('checked', false);

        $('.singleCheckbox').prop('checked', false);

      }else if(checkboxValue == 'l29'){

        $('#l23').prop('checked', false);

        $('.singleCheckbox').prop('checked', false);

      }

    }else{

      console.log('checkbox unclicked');

      $('#checkbox-val').val('lower');

    }

  });


  $(document).on('click', '.singleCheckbox', function(){

     var checked = $(this).prop('checked');

    if(checked){

        $('#checkbox-val').val('upper');
        
        $('#l23').prop('checked', false);

        $('#l29').prop('checked', false);

    }else{

        console.log('checkbox unclicked');

        $('#checkbox-val').val('lower');

        console.log($('#checkbox-val').val());

    }

  });

  $(document).on('click', '.btn-default', function(event){

    // alert('asasas');

    var txt2d = $('#2d1').val();

    var usd = $('#usd1').val();

    var khr = $('#khr1').val();

    console.log(txt2d);

    console.log(usd);

    console.log(khr);

 if(txt2d != "" && txt2d.length == 2){

      if((usd != "") || (khr != "" && khr.length == 2)){

        var status = $('#checkbox-val').val();

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
           
      swal("Oops!", "Please input 3D field with minimum 3 digits between 01-99 before moving forward!", "warning");

    }

  });

</script>
	</script>

</body>
</html>