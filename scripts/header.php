<?php
header("Location: index.php");
?>

<div id='header-wrapper'>
	<div class="top-left">
		<h1>MaxiZoo</h1>
	</div>
	<div class=	"bot-right">
	<p>
		<?php //outputs username and if they're an admin
		echo 'Welcome <strong>'.$_SESSION['sess_username'];
		if($_SESSION['sess_admin']){
			echo ' [admin]';
		}
		echo '</strong> | <a href="editprofile.php?user_id=';
		echo $_SESSION['sess_user_id'];
		echo '"> Edit profile</a>';
		?>
		| <a href="logout.php">Log out</a>
	</p>
	</div>
</div>