<?php
session_start(); //session start


//if the user is logged in don't let them on this page
if(!$_SESSION['sess_admin']){
	header('Location: loggedin.php');
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
		<h2>Add an event</h2>
		<form action='eventauth.php' method='post'>
			<input type="text" name="name" class="regi" placeholder="Event name">
			<input type="text" name="cost" class="regi" placeholder="Cost">	
			<input type="text" name="venue" class="regi" placeholder="Venue">
			<input type="date" name="date" class="regi" min="2015-07-01">
			<input type="time" name="time" class="regi">
			<br />	
			<input type="submit" value="Register Event" id="submit-button" class="submit-button">
					
		</form>			
		<div class="smalltext pullmid"><p><a href="index.php">Cancel</a></p></div>
		<?php 				
			//outputs error message based on the url
			if ($_GET['failed'] == 1){
 				echo '<div class="invalid"><p>Creation failed</p></div>';
			}
		?>
	</div>

	<div class="spacer"></div>
	
	<div class="footer">James Cook, 2014</div>
</body>

</html>
