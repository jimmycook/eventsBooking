<?php
session_start();

//if the user is logged in don't let them on this page
if(!$_SESSION['sess_admin']){
	header('Location: index.php');
	exit();
} 

addEvent();

function addEvent(){
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
	if(mysqli_connect_errno()){
		echo "Connection failed"; //if connection failed to the database
	}
	else{
		$date = trim($_POST['date']);
		$time = trim($_POST['time']);
		$venue = trim($_POST['venue']);
		$name = trim($_POST['name']);
		$cost = trim($_POST['cost']);
		//gets information by post from the form 

		if($venue == "" || $name == "" || $cost == ""){
			invalid();
			mysqli_close($con);
			return; //throws out if anything is blank
		}
		else{
			$EIDget = mysqli_query($con, "SELECT event_id FROM events") or die(mysqli_error($con));
			$newEID = 1;
			while ($row = mysqli_fetch_array($EIDget)){
				if ($newEID == $row['event_id']){
					$newEID++;
				}
			}
			//gets a valid new event id

			$sql = 'INSERT INTO events VALUES ('.$newEID.', "' . $name.'", "'. $date .'", "'. $time.'", "'. $venue.'","' . $cost . '")';
			//inserts 
			mysqli_query($con, $sql); //runs the sql insert query

			header('Location: index.php'); //goes to login with registration successful message
		}
	}

	mysqli_close($con);

}

function invalid(){
	header('Location: addevent.php?failed=1');
}
?>