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
		<h2>Edit your profile</h2>
		<form action='editauth.php' method='post'>
			<?php 
				//creates the form with all of the user's current information included
				$out = '<input type="text" name="username" class="regi" placeholder="Change username" value = "' . $_SESSION['sess_username'].'">';
			
				$out = $out . '<input type="password" name="password" class="regi" placeholder="Change password">';

				$out = $out . '<input type="text" name="fname" class="regi" placeholder="Change first name" value = "'. $_SESSION['sess_fname'] . '">';

				$out = $out . '<input type="text" name="sname" class="regi" placeholder="Change surname" value = "'.$_SESSION['sess_sname'] . '">';
				$out = $out . '<select class="interest" name="interest">';
				$out = $out . '<option value="" disabled>Area of interest</option>';
				$out = $out . '<option value="books" ';
				if($_SESSION['sess_interest']=='books'){
					$out = $out . 'selected';
				}
				$out = $out . '>Books</option>';
				$out = $out . '<option value="music" ';
				if($_SESSION['sess_interest']=='music'){
					$out = $out . 'selected';
				}
				$out = $out . '>Music</option>';
				$out = $out . '</select>';
				$out = $out . '<br />';
				$out = $out . '<input type="submit" value="Edit" id="submit-button" class="submit-button">';
				echo $out;
			?>		
		</form>			
		<div class="smalltext pullmid"><p><a href="index.php">Cancel</a></p></div>
		<?php 			
			//error message based on the url	
			if ($_GET['failed'] == 1){
 				echo '<div class="invalid"><p>Profile edit failed</p></div>';
			}
		?>
	</div>

	<div class="spacer"></div>
	
	<div class="footer">James Cook, 2014</div>
</body>

</html>
