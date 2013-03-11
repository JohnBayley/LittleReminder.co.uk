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
$description = $_REQUEST['description'];
if ($description != "")
	{
	$sql = "UPDATE reminders SET description='". $description . "'						
			WHERE reminderid = '".$_REQUEST['rmId']."'";

	$result = mysql_query($sql);
	if (mysql_affected_rows() == 1)
		{
		$returnStr .= 'Reminder description updated<br />'.$description.'<br />';  									
		}
	}	
			 
									
print ($returnStr);

?>