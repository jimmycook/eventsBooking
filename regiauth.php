<?php
session_start();

//if the user is logged in don't let them on this page
if(isset($_SESSION['sess_username'])){
	header('Location: loggedin.php');
	exit();
} 

setcookie('username', '', 1);
registeruser();

function registeruser(){
	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
	if(mysqli_connect_errno()){
		echo "Connection failed"; //if connection failed to the database
	}
	else{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$interest = $_POST['interest'];
		$fname = $_POST['fname'];
		$sname = $_POST['sname'];
		//gets information by post from the form 

		$sql = "SELECT * FROM users WHERE username='".$username."'";
		
		$row = mysqli_fetch_array(mysqli_query($con, $sql) or die(mysqli_error($con))); 
		
		//throws out if username is a duplicate
		$sql = 'SELECT * FROM users WHERE username = "' . $username . '"';
		$check = mysqli_fetch_array(mysqli_query($con, $sql));
		if(isset($check['username'])){
			invalidregi("");
			return; 
		}

		//throws out if anything is blank
		if($username == "" || $password == "" || $interest == "" || $fname == "" || $sname == ""){
			invalidregi($username);
			mysqli_close($con);
			return; 
		}
		else{ //if no errors
			//generate user_id
			$UIDget = mysqli_query($con, "SELECT user_id FROM users") or die(mysqli_error($con));
			$newUID = 1;
			while($row = mysqli_fetch_array($UIDget)){
				if($newUID == $row['user_id']){
					$newUID++;
				}
			}

			$sql = 'INSERT INTO users VALUES ('. $newUID.', "' . $username.'", "'. $password .'", "'. $fname.'", "'. $sname.'","' . $interest . '", 0)';
			//inserts 
			mysqli_query($con, $sql); //runs the sql insert query
			setcookie('username', $username); //sets the username cookie for going back to login

			header('Location: index.php?regi=2'); //goes to login with registration successful message
		}		
	}

	mysqli_close($con);

}

function invalidregi($uname){
	setcookie('username', $uname);
	header('Location: register.php?regi=1');
}
?>