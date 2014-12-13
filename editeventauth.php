<?php
session_start();

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
	exit();
} 


$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
if(mysqli_connect_errno()){
	echo "Connection failed"; //if connection failed to the database
}
else{

	$name = $_POST['name'];
	$cost = $_POST['cost'];
	$venue = $_POST['venue'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	//gets information by post from the form 

	$event_id = $_POST['event_id'];
	$sql = "SELECT * FROM events WHERE event_id='".$event_id."'";
		
	$row = mysqli_fetch_array(mysqli_query($con, $sql) or die(mysqli_error($con))); 
		

	if($name == "" || $cost == "" || $venue == "" || $event_id == ""){
		invalidedit($event_id);
		return; //throws out if anything is blank
	}	
			
	if($name !== $row['name']){
		mysqli_query($con, 'UPDATE events SET name = "' . $name . '" WHERE event_id = ' . $event_id);
	} 
		
	if($cost !== $row['cost']){
		mysqli_query($con, 'UPDATE events SET cost = "' . $cost . '" WHERE event_id = ' . $event_id);
	} 

	if($venue !== $row['venue']){
		mysqli_query($con, 'UPDATE events SET venue = "' . $venue . '" WHERE event_id = ' . $event_id);

	}
	
	if($time !== ""){
		mysqli_query($con, 'UPDATE events SET time = "' . $time . '" WHERE event_id = ' . $event_id);
	}

	if($date !== ""){
		mysqli_query($con, 'UPDATE events SET date = "' . $date . '" WHERE event_id = ' . $event_id);

	}

	header('Location: index.php'); //returns out of edit form		

}

mysqli_close($con);



function invalidedit($id){
	header('Location: editevent.php?failed=1&event_id='.$id);
}
?>