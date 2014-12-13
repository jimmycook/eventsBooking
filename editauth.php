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

	$username = $_POST['username'];
	$password = $_POST['password'];
	$interest = $_POST['interest'];
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	//gets information by post from the form 

	$user_id = $_SESSION['sess_user_id'];
	$sql = "SELECT * FROM users WHERE user_id='".$user_id."'";
		
	$row = mysqli_fetch_array(mysqli_query($con, $sql) or die(mysqli_error($con))); 
		

	//if anything but password is blank
	if($username == "" || $interest == "" || $fname == "" || $sname == ""){
		invalidedit();
		return; //throws out if anything is blank
	}
	
	//checks if the username is already in use
	$sql = 'SELECT * FROM users WHERE username = "' . $username . '"';
	$tempr = mysqli_query($con, $sql);
	
	while ($check = mysqli_fetch_array($tempr)){
		if($username == $check['username']){
			//if it is in use
			if($username !== $_SESSION['sess_username']){
				invalidedit();
				return; //throw out
			}
		}	
	}
		
		
	session_regenerate_id();
	
	//updates username if it's different
	if($username !== $row['username']){
		mysqli_query($con, 'UPDATE users SET username = "' . $username . '" WHERE user_id = ' . $user_id);
		$_SESSION['sess_username'] = $username;
	} 
		
	//update password if it's different and not empty
	if($password !== $row['password'] && $password !== ""){
		mysqli_query($con, 'UPDATE users SET password = "' . $password . '" WHERE user_id = ' . $user_id);
	} 

	//updates interest if it's different 
	if($interest !== $row['interest']){
		mysqli_query($con, 'UPDATE users SET interest = "' . $interest . '" WHERE user_id = ' . $user_id);
		$_SESSION['sess_interest'] = $interest;
	}
		
		//updates fname if it's different
	if($fname !== $row['fname']){
		mysqli_query($con, 'UPDATE users SET f_name = "' . $fname . '" WHERE user_id = ' . $user_id);
		$_SESSION['sess_fname'] = $fname;
	}

	//updates sname if it's different
	if($sname !== $row['sname']){
		mysqli_query($con, 'UPDATE users SET s_name = "' . $sname . '" WHERE user_id = ' . $user_id);
		$_SESSION['sess_sname'] = $sname;
	}
	session_write_close();

	header('Location: index.php'); //returns out of edit form		

}

mysqli_close($con);



function invalidedit(){
	header('Location: editprofile.php?failed=1');
}
?>