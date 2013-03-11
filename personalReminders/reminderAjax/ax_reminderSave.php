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
$rmId = '';
if ($_REQUEST['rmId'] == 'new')
	{
	$addSql = "INSERT INTO reminders (userid,description,reminder_date,period) VALUES ('" . $_SESSION['userid'] . "','"
													. ereg_replace ("'","`",$_REQUEST['rmDesc']). "','"
													. $_REQUEST['rmYear'] . "/" 
													. $_REQUEST['rmMonth'] . "/"
													. $_REQUEST['rmDay'] . "',
													'".$_REQUEST['rmPeriod']."')";		
	$lastInsertSql = "SELECT LAST_INSERT_ID() AS rmNo FROM DUAL;";				
	/* Start an atomic operation with the database */
	$transaction = mysql_query("START TRANSACTION");
	$result = mysql_query($addSql);
	$result = mysql_query($lastInsertSql);
	$row = mysql_fetch_assoc($result);
	$transaction = mysql_query("COMMIT");
	/*Transaction is closed */							
	$result = $row['rmNo'];
	if (mysql_affected_rows() == 1)
		{
		$returnStr .= 'Created new Reminder <br />';  									
		}
	$rmId = $result;
	}
else
	{
	$rmId = $_REQUEST['rmId'];
	$getReminderSql = "SELECT * FROM reminders WHERE reminderid = '".$_REQUEST['rmId']."'";
	$testResult = mysql_query($getReminderSql);
	$testRow = mysql_fetch_assoc($testResult);	
	
	$sql = "UPDATE reminders SET reminder_date='"	 . $_REQUEST['rmYear'] . "/" 
													 . $_REQUEST['rmMonth'] . "/"
													 . $_REQUEST['rmDay'] . "'							
													 
			WHERE reminderid = '".$_REQUEST['rmId']."'";							 
	$result = mysql_query($sql);
	if (mysql_affected_rows() == 1)
		{
		$returnStr .= 'Updated Reminder for '.$testRow['description'].' Date to '.$_REQUEST['rmDay']."-".$_REQUEST['rmMonth']."-".$_REQUEST['rmYear'].'<br />';  									
		}
	
	if ($testRow['reminder_time'] != $_REQUEST['rmTime'] && $_REQUEST['rmTime'] != '')
		{
		$sql = "UPDATE reminders SET reminder_time='" . $_REQUEST['rmTime'] ."'							
														 
				WHERE reminderid = '".$_REQUEST['rmId']."'";							 
		$result = mysql_query($sql);
		if (mysql_affected_rows() == 1)
			{
			$returnStr .= 'Updated Reminder time to '.$_REQUEST['rmTime'].'.<br />';  									
			}	
		}
	
	if ($testRow['description'] != $_REQUEST['rmDesc'] && $_REQUEST['rmDesc'] != '')
		{
		$sql = "UPDATE reminders SET description='"	 . $_REQUEST['rmDesc'] . "'						
														 
				WHERE reminderid = '".$_REQUEST['rmId']."'";

		$result = mysql_query($sql);
		if (mysql_affected_rows() == 1)
			{
			$returnStr .= 'Updated Reminder for '.$testRow['description'].' Description to '.$_REQUEST['rmDesc'].'<br />';  									
			}
		
		}
	if ($testRow['period'] != $_REQUEST['rmNotes'] && $_REQUEST['rmPeriod'] != '')
		{
		$sql = "UPDATE reminders SET period='"	 . $_REQUEST['rmPeriod'] . "'						
														 
				WHERE reminderid = '".$_REQUEST['rmId']."'";

		$result = mysql_query($sql);
		if (mysql_affected_rows() == 1)
			{
			$returnStr .= 'Updated Reminder for '.$testRow['description'].' Period to '.$_REQUEST['rmPeriod'].'<br />';  									
			}
		
		}
	if ($testRow['reminder_enabled'] != $_REQUEST['rmEnabled'] && $_REQUEST['rmEnabled'] != '')
		{
		$sql = "UPDATE reminders SET reminder_enabled='". $_REQUEST['rmEnabled'] . "'						
														 
				WHERE reminderid = '".$_REQUEST['rmId']."'";


		$result = mysql_query($sql);
		if (mysql_affected_rows() == 1)
			{
			if ($_REQUEST['rmEnabled'] == 1)
				{
				$returnStr .= 'Reminder for '.$testRow['description'].' is enabled<br />';  									
				}
			else
				{
				$returnStr .= 'Reminder for '.$testRow['description'].' is disabled<br />';  									
				}
			}
		
		}		
	if ($testRow['notes'] != $_REQUEST['rmNotes'] && $_REQUEST['rmNotes'] != '')
		{
        $reminderNotes = preg_replace("/\'/","`",$_REQUEST['rmNotes']);
        $reminderNotes = preg_replace("/\"/","``",$reminderNotes);
        $reminderNotes = preg_replace("/[^A-Za-z0-9\s\`]+/","",$reminderNotes);
        $reminderNotes = preg_replace("/\n/","<br/>",$reminderNotes);
        $reminderNotes = preg_replace("/\r/","<br/>",$reminderNotes);
		$sql = "UPDATE reminders SET notes='"	 . $reminderNotes . "'						 
				WHERE reminderid = '".$_REQUEST['rmId']."'";

		$result = mysql_query($sql);
		
		if (mysql_affected_rows() == 1)
			{
			$returnStr .= 'Updated Reminder for '.$testRow['description'].' Notes to '.$_REQUEST['rmNotes'].'<br />';  									
			}
		
		}		
	}								 
									
print ($returnStr);

?>