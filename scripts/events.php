<?php

session_start(); //session start

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
} 

generateEventsList();

function generateEventsList(){
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
	if(mysqli_connect_errno()){
		echo 'Connection failed'; //if connection failed to the database
	}

	//gets all event_ids from the database
	$result = mysqli_query($con, 'SELECT event_id FROM events;');
	//checks if we need the events header
	$headercheck = mysqli_fetch_array($result);
	
	//paragraph tag for output string
	$out = '<p>';

	//checks if the user is an admin
	if($_SESSION['sess_admin']){
		//adds header and 
		echo '<h1>Events</h1>';
		//outputs the add an event link for admins
		$out = $out . '<a href="addevent.php">Add an event</a> | ';
	}
	elseif($headercheck){ 
		//if not an admin but there are events just add the header
		echo '<h1>Events</h1>';
	}
	else{
		//returns without a header
		return;
	}

	//adds relevent acending/descending link, and selects the relevant sql query based on the url
	if($_GET['eorder'] == 'desc'){

		$out = $out . '<a href=".">Order ascending<a>';
		
		$resultevent = mysqli_query($con, 'SELECT name, event_id, venue, DATE_FORMAT(date, "%d/%m/%Y") AS "date", TIME_FORMAT(time, "%H:%i") as time, cost  FROM events ORDER BY name DESC') or die(mysqli_error($con));
	
	}
	else{

		$out = $out . '<a href="?eorder=desc">Order descending<a>';

		$resultevent = mysqli_query($con, 'SELECT name, event_id, venue, DATE_FORMAT(date, "%d/%m/%Y") AS "date", TIME_FORMAT(time, "%H:%i") as time, cost FROM events ORDER BY name ASC') or die(mysqli_error($con));

	}

	//outputs the header
	$out = $out . "</p>";
	echo $out;
	
	//while there are lines in the array, create our output string
	while($row = mysqli_fetch_array($resultevent)){
		$out ='<div class="event">
				<h4>' . $row['name']	 . ' </h4> <p>Eventid: ' . $row['event_id'] . '</p>
				<p>' . $row['venue'] . ' on ' . $row['date'] . ' at ' . $row['time'] . '</p>
				<p>£' . $row['cost']; 
		
		//checks if there's a booking for this user, and if not adds the booking link
		$sql = 'SELECT booking_id FROM bookings WHERE event_id = '.$row['event_id'].' AND user_id = '.$_SESSION['sess_user_id'];
		$resultbookings = mysqli_query($con, $sql) or die(mysqli_error($con));
 		$rowbookings = mysqli_fetch_array($resultbookings);

		if($rowbookings['booking_id'] == ''){ 
			$out = $out . ' | <a href="bookings.php?event_id=' . $row['event_id']. '">Book ticket</a></p>';	
		} 	
		
		//adds delete event functionality for admins
		if($_SESSION['sess_admin']){ 
			$out = $out . '<p><a href="deleteevent.php?event_id=' . $row['event_id'] . '">Delete event</a> | <a href="editevent.php?event_id=' . $row['event_id'] . '">Edit event</a></p>';
		}
		
		//outputs
		$out = $out . '</div>';
		echo $out;
	}
	

}
?>

