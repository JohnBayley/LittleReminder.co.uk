<?php
/* Set the security flag */

define('AUTHdbSEC', true);
/* Start a php session */
session_start();
/* Load the common access and setup */
include 'reminderCommon.php';
/* Load the common auth functions */
include $authApi.'authFunctions.php';
/* Load the auth api */
include $authApi.'authApi.php';

	$username = checkUniqueUsername(mysql_real_escape_string($_REQUEST['username']));
	if ($username )
		{
		print ('<img class="imgtip" src="/images/fam/tick.png" alt="ok" title="'.$l['usernameGood'].'">');
		}
	else
		{
		print ('<img class="imgtip" src="/images/fam/error.png" alt="Bad" title="'.$l['usernameUsed'].'">');
		}

?>

