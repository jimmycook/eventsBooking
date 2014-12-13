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

	<style>
		

	</style>
</head>

<body>
	<div id="wrapper-thin">
		<div class='spacer'></div>

		<h2>Log in</h2>
		<p></p>
		<form action='auth.php' method='post'>
			
			<?php 
				//if the username cookie is set add it in the the form
				if (isset($_COOKIE['username'])) {
					echo '<input type="text" name="username" class="login" placeholder="Username" value = "' . $_COOKIE['username'].'">';
				} else {
					echo '<input type="text" name="username" class="login" placeholder="Username">';
				} 
			?>

			<div style="height: 2px;"></div>
			<input type="password" name="password" class="login" placeholder="Password">
			<br />
			<input type="submit" value="Log in" id="submit-button" class="submit-button">
		
		</form>
		
		<div class="smalltext pullmid"><p><a href="register.php">Create an account</a></p></div>
		<?php
			//messages based on url

			//successful registration message
			if ($_GET['regi'] == 2){
 				echo '<div class="invalid"><p>Registration successful</p></div>';
 			}
 			//login error
			elseif ($_GET['login'] == 1){
				echo '<div class="invalid"><p>Invalid username/password</p></div>';
			}
			else{

			}
		?>
	
	<div class="spacer"></div>

	</div>
	
	<div class="footer">James Cook, 2014</div>
</body>
</html>
