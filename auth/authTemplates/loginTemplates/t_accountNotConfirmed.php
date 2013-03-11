<div id="info"> 
	<h1>Account not confirmed</h1>
	<h3>Account e-mail address not confirmed</h3>
	<p>Your e-mail address must be confirmed to enable your account.</p>
	<p>Request a reconfirmation <a href="/auth/useradd.php?reconfirm=true&username=
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
