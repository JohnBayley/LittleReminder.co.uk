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
$enable = $_REQUEST['enable'];
if ($enable == "0" || $enable == "1")
	{
	$sql = "UPDATE reminders SET reminder_enabled='". $enable . "'						
			WHERE reminderid = '".$_REQUEST['rmId']."'";

	$result = mysql_query($sql);
	if (mysql_affected_rows() == 1)
		{
		if ($enable == "0")
			{
			$returnStr .= 'Reminder is disabled<br />';  									
			}
		else
			{
			$returnStr .= 'Reminder is enabled<br />';  									
			}
		}
	}	
			 
									
print ($returnStr);

?>