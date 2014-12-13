<?php
session_start(); //session start
ob_start();

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
	header('Location: index.php');
} 

if(!isset($_GET['event_id'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>FlexiFlash Multimedia Promotions</title>
	<meta name="author" content="Jimmy Cook">
	<!-- Date: 2014-08-28 -->
	<link rel="stylesheet" type="text/css" href="css/general.css">
</head>

<body>

	<div id="wrapper-thin">
	<div class="spacer"></div>

	<?php

	//if the user is logged in don't let them on this page
	if(!isset($_SESSION['sess_username'])){
		header('Location: index.php');
	} 

	$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

		
	if(mysqli_connect_errno()){
		echo 'Connection failed'; //if connection failed to the database
	}
	//gets the event details from the database and outputs the name as the header
	$event_id = $_GET['event_id'];

	$result = mysqli_query($con, 'SELECT * FROM events WHERE event_id = '. $event_id .';');
	$row = mysqli_fetch_array($result); 

	echo '<h3 class="pullmid">' . $row['name'] . '</h3>';
	?>

	<form action='bookingauth.php' method='post'>
		Do you have a hospitality voucher? <br />
		<div style="height: 10px;"></div>
		<input type="radio" name="voucher" value="true">Yes        
		<input type="radio" name="voucher" checked value="false"> No
		<br /> 
		<div style="height: 10px;"></div>

		Have you paid using our payment service? <br />
		<div style="height: 10px;"></div>

		<input type="radio" name="paid" value="true">Yes       
		<input type="radio" name="paid" value="false" checked> No
		<br />
		<div style="height: 10px;"></div>
		<br />
		<input type="submit" value="Book" id="submit-button" class="submit-button">
		<?php echo '<input type="hidden" name="event_id" value="' . $_GET['event_id'] . '">'; ?>
	</form>
	<p class="pullmid"><a href="index.php">Cancel</a></p>
	<br />
	<?php
		//if the bothyes session, output error message
		if ($_SESSION['bothyes'] == true){
 			echo '<div class="invalid"><p>Please only select yes once</p></div>';
 		}	
		else
		{
		}
		
	?>
	

	</div>
	<?php //resets the both yes session
		session_regenerate_id();
		$_SESSION['bothyes'] = false;
		session_write_close();
	?>
	<div class="footer">James Cook, 2014</div>
</body>
</html>
