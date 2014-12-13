<?php
session_start();

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
	exit();
} 

deleteBooking();

function deleteBooking(){

	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database
	if(mysqli_connect_errno()){
		echo "Connection failed"; //if connection failed to the database			
	}
	//if the booking id is on the url
	if( isset( $_GET['booking_id'] )){
		//deletes the line with that booking id from the database
		$booking_id = $_GET['booking_id'];
		$sql = 'DELETE FROM bookings WHERE booking_id = ' . $booking_id;
		mysqli_query($con, $sql);

	}
	elseif(isset($_GET['event_id'])){ //if the event id is set
		$event_id = $_GET['event_id'];
		$user_id = $_SESSION['sess_user_id'];
		
		//selects the bookings for this user and that event id
		$sql = 'SELECT * FROM bookings WHERE user_id = '.$user_id.' AND event_id = '.$event_id;
		$bookinginfo = mysqli_fetch_array(mysqli_query($con, $sql));
		
		//sets the booking id from that query
		$booking_id = $bookinginfo['booking_id'];

		//deletes that booking
		$sql = 'DELETE FROM bookings WHERE booking_id = ' . $booking_id;
		mysqli_query($con, $sql);
		
	}
	mysqli_close($con);
	header("Location: index.php");	

}
?>