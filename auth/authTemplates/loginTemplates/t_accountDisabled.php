<div id="info"> 
	<h1>Account Disabled</h1>
	<h3>Your account is disabled</h3>
	<p>You have reached the login attempt limit. For security reasons your account is disabled.</p>
	<p>Request a reconfirmation to reset it <a href="/auth/recover.php?username=
	<?php 
		if(isset ($_REQUEST["logname"]) )
			{
			print $_REQUEST["logname"];
			}
		elseif 	(isset ($_SESSION["username"]) )
			{
			print $_SESSION["username"];
			}
			 ?>
	">here</a></p>


</div>
