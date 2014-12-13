<?php

session_start(); //session start

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
} 
generateBookingsList();

function generateBookingsList(){
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	if(mysqli_connect_errno()){
		echo 'Connection failed'; //if connection failed to the database
	}

	//checks if user is an admin, and either shows all bookings, or just the users
	if(!$_SESSION['sess_admin']){ //if not an admin, show just the user's bookings
		
		//checks for some bookings, if there are show the header
		$result = mysqli_query($con, 'SELECT * FROM bookings;');
		while($headercheck = mysqli_fetch_array($result)){
			if($headercheck['user_id'] == $_SESSION['sess_user_id']){
				echo '<h1>Bookings</h1>';
				break;
			}
		}
		

		$resultloop = mysqli_query($con, 'SELECT * FROM bookings');
		//loops for all bookings
		while($row = mysqli_fetch_array($resultloop)){
			if($row['user_id'] == $_SESSION['sess_user_id']){	
				//outputs booking details and a delete link for the user if the booking is there's
				$eventdetails = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM events WHERE event_id = '.$row['event_id']));

				$output = '<div>
					<p>You are booked in for '.$eventdetails['name'].' | ';

				//adds payment status information
				if($row['paid'] == true){
					$output = $output . "Payment accepted";
				}
				elseif($row['free'] == true){
					$output = $output . "Free admission";
				}
				else{	
					$output = $output . "Unpaid";
				}
				$output = $output . ' | <a href="deletebooking.php?event_id='.$eventdetails['event_id'].'">Delete booking</a></p>
				</div>';
				echo $output;

			}
		}

	}
	elseif($_SESSION['sess_admin']){ //if they are an admin
		//if there are bookings, show the booking header
		$result = mysqli_query($con, 'SELECT * FROM bookings');

		if($headercheck = mysqli_fetch_array($result)){

			echo '<h1>Bookings</h1>';
		}

		$resultloop = mysqli_query($con, 'SELECT * FROM bookings');
		//loops for all bookings
		while( $row = mysqli_fetch_array($resultloop) ){
			//outputs booking details, including username, and a delete link for the admin
			$eventdetails = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM events WHERE event_id = '.$row['event_id']));
			$userdetails = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM users WHERE user_id = '.$row['user_id']));
			$output = '<div>
					<p><strong>'.$userdetails['username'].'</strong> booked <strong>'.$eventdetails['name'].'</strong> | ';

			//adds payment status information
			if($row['paid'] == true){
				$output = $output . "Payment accepted";
			}
			elseif($row['free'] == true){
				$output = $output . "Free admission";
			}
			else{	
				$output = $output . "Unpaid";
			}

			$output = $output .' | <a href="deletebooking.php?booking_id='.$row['booking_id'].'">Delete booking</a></p>
				</div>';
			echo $output;

			
		}

	}
		

	mysqli_close();
}

?>