<?php 

if(isset($_POST['id'])){

	session_destroy();

	unset($_SESSION['refUID']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['userlevel']);
	unset($_SESSION['fullname']);
	unset($_SESSION['phone']);
	unset($_SESSION['address']);
	unset($_SESSION['error']);
	unset($_SESSION['success']);

	session_unset();

	echo "session destroy";

}else{

	echo "not accessible";
}

?>