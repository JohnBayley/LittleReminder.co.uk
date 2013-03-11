<?php
/* Set the security flag */
define('AUTHdbSEC', true);

/* Start a php session */
session_start();

/* Load common configuration */
include('reminderCommon.php');

/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');



$returnStr = '';

$rmId = $_REQUEST['rmId'];
$archive = $_REQUEST['archive'];
if ($archive == "0" || $archive == "1")
	{
	$sql = "UPDATE reminders SET reminder_archived='". $archive . "'						
			WHERE reminderid = '".$_REQUEST['rmId']."'";

	$result = mysql_query($sql);
	if (mysql_affected_rows() == 1)
		{
		if ($archive == "0")
			{
			$returnStr .= 'Reminder is no longer archived<br />';  									
			}
		else
			{
			$returnStr .= 'Reminder is now archived<br />';  									
			}
		}
	}
			 
									
print ($returnStr);

?>