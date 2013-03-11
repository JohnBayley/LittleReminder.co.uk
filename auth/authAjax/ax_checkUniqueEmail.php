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
	if (isset($_REQUEST['username']) && $_REQUEST['username'] != "")
		{
		$username = mysql_real_escape_string($_REQUEST['username']);
		$email = mysql_real_escape_string($_REQUEST['email']);
		$email = checkUniqueUserEmail($username,$email);
		}
	else
		{
		$email = mysql_real_escape_string($_REQUEST['email']);
		$email = & checkUniqueEmail($email);
		}
	
	if ($email)
		{print ('<img class="imgtip" src="/images/fam/tick.png" alt="ok" title="'.$l[passwordGood].'">');}
	else
		{print ('<img class="imgtip" src="/images/fam/error.png" alt="Bad" title="'.$l[passwordUsed].'">');}

?>

