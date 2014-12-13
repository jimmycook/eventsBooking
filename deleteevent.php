<?php
session_start();

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
	exit();
} 

//if the user is an admin
if($_SESSION['sess_admin']){

	//check if event id is set
	if(!isset($_GET['event_id'])){
		//if not redirect out
		header('Location: index.php');
		return;
	}
	//otherwise delete the event specified
	deleteEvent();

}

function deleteEvent(){
	//gets the details
	$event_id = $_GET['event_id'];
	$user_id = $_SESSION['sess_user_id'];
	
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database
	if(mysqli_connect_errno()){
		echo "Connection failed"; //if connection failed to the database
	}

	//deletes all bookings for set event from bookings
	$sql = 'DELETE FROM bookings WHERE event_id = ' . $event_id;
	mysqli_query($con, $sql);
	//deletes the event from events
	$sql = 'DELETE FROM events WHERE event_id = ' . $event_id;
	mysqli_query($con, $sql);
	mysqli_close($con);
	header("Location: index.php");	
}
?>