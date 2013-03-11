<?php
/* Set the security flag */
define('AUTHdbSEC', true);

/* Start a php session */
session_start();

/* Load common configuration */
include('reminderCommon.php');

/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');

	$sql = "DELETE FROM reminders WHERE reminderid = '".$_REQUEST['rmId']."'";

	$result = mysql_query($sql) or die("Could not successfully update reminder ($sql) from DB: " . mysql_error());

	print mysql_affected_rows ();

?>