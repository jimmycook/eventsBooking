<?php
session_start(); //start session


if(!isset($_SESSION['sess_username'])){
	header("Location: index.php");
}
else if(!$_SESSION['sess_admin']) {
	header('Location: user.php');
}
else if($_SESSION['sess_admin']) {
	header('Location: admin.php');
}
else{
	header('Location: index.php');
}
//redirects to the appropriate place based on the session values
?>