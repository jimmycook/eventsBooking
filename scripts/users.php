<?php

session_start(); //session start

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
} 

generateUserList();

function generateUserList(){
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
	if(mysqli_connect_errno()){
		echo 'Connection failed'; //if connection failed to the database
	}

	//gets all event_ids from the database
	$result = mysqli_query($con, 'SELECT * FROM users;');
	//checks if we need the events header
	
	//paragraph tag for output string
	$out = '<p>';

	echo '<h1>Users</h1>';

	//outputs the header
	$out = $out . "</p>";
	echo $out;
	
	//while there are lines in the array, create our output string
	while($row = mysqli_fetch_array($result)){
		
		$out ='<div class="user">
				<h4>' . $row['username']	 . ' </h4> <p>UserID: ' . $row['user_id'] . '</p>
				<p>Name: ' . $row['f_name'] . ' ' . $row['s_name'] . '</p>
				<p>Interest: ' . $row['interest'] . '</p><p>';
		if($row['perm'] == 0){
			$out = $out . 'Permissions level: User</p>';
		}
		else{
			$out = $out . 'Permissions level: Admin</p>';
		}
		
		//outputs
		$out = $out . '</div>';
		echo $out;
	}
	

}
?>

