<?php
session_start(); //session start


//if the user is logged in don't let them on this page
if(isset($_SESSION['sess_username'])){
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
		<h2>Create an account</h2>
		<form action='regiauth.php' method='post'>
			<?php 
				if (isset($_COOKIE['username'])) {
					echo '<input type="text" name="username" class="regi" placeholder="Username" value = "' . $_COOKIE['username'].'">';
				} else {
					echo '<input type="text" name="username" class="regi" placeholder="Username">';
				} 
			?>
			<input type="password" name="password" class="regi" placeholder="Password">

			<input type="text" name="fname" class="regi" placeholder="First name">

			<input type="text" name="sname" class="regi" placeholder="Surname">	
			<select class="interest" name="interest">
				<option value="" disabled selected>Area of interest</option>
				<option value="books">Books</option>
				<option value="music">Music</option>
			</select>	
			<br />	
			<input type="submit" value="Register" id="submit-button" class="submit-button">
					
		</form>			
		<div class="smalltext pullmid"><p><a href="index.php">Have an account?</a></p></div>
		<?php 				
			if ($_GET['regi'] == 1){
 				echo '<div class="invalid"><p>Registration failed</p></div>';
			}
		?>
	</div>

	<div class="spacer"></div>
	
	<div class="footer">James Cook, 2014</div>
</body>

</html>
