<?php
session_start(); //session start

//if the user is logged in don't let them on this page
if(!isset($_SESSION['sess_username'])){
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
	<?php include 'scripts/header.php' ?>
	<div id="wrapper">
		<?php include 'scripts/events.php' ?>
		<?php include 'scripts/booked.php' ?>
	</div>
	
	<div class="spacer"></div>
</body>
</html>
