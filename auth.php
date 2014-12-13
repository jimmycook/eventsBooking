<?php
ob_start();
session_start(); //session start

//if the user is logged in don't let them on this page
if(isset($_SESSION['sess_username'])){
	header('Location: loggedin.php');
	exit();
} 

setcookie('username', ''); //deletes cookies

login(); //runs login script

function login(){

	$username = $_POST['username'];

	$password = $_POST['password']; //gets username and password by post



	$con = mysqli_connect('localhost','root','root','fmp'); //connect to the database

	$sql = "SELECT * FROM users WHERE username='".$username."';"; //sql statement to pull user's information if the user exists	



	if(mysqli_connect_errno()){

		echo "Connection failed"; //connection failed failsafe

	}
	else{

		$result = mysqli_query($con, $sql); //runs the query puts the result into $result

		$row = mysqli_fetch_array($result); //fetches array results from the query

		if($username == "" || $password == ""){ 

			invalidlogin($username); //input validation for blank username or password

		}

		elseif($row['username'] == $username){ //username check 

			if($row['password'] == $password){ //password check for that user

				// write to session

				session_regenerate_id();

				if($row['perm'] == 0){

					$_SESSION['sess_admin'] = false; 

				}
				elseif($row['perm'] == 1){

					$_SESSION['sess_admin'] = true; 

				} //permissions level session

				$_SESSION['sess_user_id'] = $row['user_id']; //sets userid session

				$_SESSION['sess_username'] = $row['username'];	//username session

				$_SESSION['sess_fname'] = $row['f_name']; //first name session

				$_SESSION['sess_sname'] = $row['s_name']; //surname session

				$_SESSION['sess_interest'] = $row['interest']; //interest session

				session_write_close();

				header('Location: loggedin.php'); //goes to log in page

			}
			else{

				invalidlogin($username); //throws back with username cookie

			}	
		}
		else{

			invalidlogin(""); //throws back with no username cookie

		}
	}

	mysqli_close($con); //close sql connection

}

function invalidlogin($uname){
	setcookie('username', $uname);
	header('Location: index.php?login=1'); //invalid log ons throw back to index with cookies to create an error message
}

?>
