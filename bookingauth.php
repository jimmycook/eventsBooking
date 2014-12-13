<?php
ob_start();
session_start();

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
	exit();
} 


book();

function book(){
	//gets all the info by post or session
	$event_id = $_POST['event_id'];
	$user_id = $_SESSION['sess_user_id'];		
	$voucher = $_POST['voucher'];
	$paid = $_POST['paid'];

	//if both were set to yes
	if($_POST['voucher'] == 'true' && $_POST['paid'] == 'true'){
		//adds to session both yes
		session_regenerate_id();
		
		$_SESSION['bothyes'] = true;

		session_write_close();
		//redirects back
		header('Location: bookings.php?event_id='.$_POST['event_id']);
	}
	else{

		$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

		if(mysqli_connect_errno()){
			echo "Connection failed"; //if connection failed to the database
		}		

		//gets booking id
		$newBID = $user_id . $event_id;

		//inserts into the database
		$sql = "INSERT INTO bookings VALUES ('" . $newBID . "', '" . $user_id . "', '" . $event_id . "', " . $paid . ", " . $voucher . ")"; 
		mysqli_query($con, $sql); 
			

		mysqli_close($con);

		header("Location: index.php");
	}
	
}

?>