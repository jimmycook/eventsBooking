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
	<div id="wrapper-thin">
		<div class="spacer"></div>
		<h2>Edit event</h2>
		<form action='editeventauth.php' method='post'>
			<?php 
				//creates the form with all of the user's current information included
				$con = mysqli_connect('localhost','root','root','fmp'); //connects to the database

	
				if(mysqli_connect_errno()){
					echo 'Connection failed'; //if connection failed to the database
				}

				$sql = "SELECT * FROM events WHERE event_id = " . $_GET['event_id'];
				$qry = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($qry);

				$out = '<input type="text" name="name" class="regi" placeholder="Change event name" value = "' . $row['name'].'">';
				
				$out = $out . '<input type="text" name="cost" class="regi" placeholder="Change cost" value = "' . $row['cost'].'">';				
				$out = $out . '<input type="text" name="venue" class="regi" placeholder="Change venue" value = "' . $row['venue'].'"><input type="date" name="date" class="regi" min="2015-07-01">
			<input type="time" name="time" class="regi"><input type="hidden" name="event_id" value = "'.$_GET['event_id'].'" class="regi">';
				$out = $out . '<input type="submit" value="Edit" id="submit-button" class="submit-button">';

				echo $out;
			?>		
		</form>			
		<div class="smalltext pullmid"><p><a href="index.php">Cancel</a></p></div>
		<?php 			
			//error message based on the url	
			if ($_GET['failed'] == 1){
 				echo '<div class="invalid"><p>Edit failed</p></div>';
			}
		?>
	</div>

	<div class="spacer"></div>
	
	<div class="footer">James Cook, 2014</div>
</body>

</html>
