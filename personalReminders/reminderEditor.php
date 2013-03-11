<?php

/* The main index page which is used to front the authentication.				*/

/* Authentication is dull so the homepage for the chosen application is called 	*/

/* which should require a login, otherwise why use auth :-) 					*/


/* Set the security flag */
define('AUTHdbSEC', true);


/* Start a php session */
session_start();


/* Load common configuration */
include('reminderCommon.php');


/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');
include($authApi . 'authApi.php');

$reminderId = '';
if (isset($_REQUEST['rmId']))
	{
	$reminderId = $_REQUEST['rmId'];
	}
$sql = "SELECT * FROM reminders r JOIN users u ON r.userid = u.userid
		WHERE r.reminderid = '".$reminderId."'

		ORDER BY reminder_date ASC";
//print $sql;
$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());

while($row = mysql_fetch_assoc($result))
	{
	$reminderDesc = $row['description'];
	$reminderDate= substr($row['reminder_date'], 8, 2)."-".substr($row['reminder_date'], 5, 2)."-".substr($row['reminder_date'], 0, 4);
	$reminderNotes = $row['notes'];
    $reminderTime = substr($row['reminder_time'], 0, 5);
	$reminderNotes = preg_replace("/<br\/>/","\n",$reminderNotes);
	$reminderId = $row['reminderid'];
	$reminderUser = $row['userid'];
	$reminderPeriod = $row['period'];
	$reminderEnabled = '';
	$reminderArchived = '';
	if ($row['reminder_enabled'] == 1)
		{
		$reminderEnabled = 'checked="checked"';
		}
	else
		{
		$reminderEnabled = '';
		}

	if ($row['reminder_archived'] == 1)
		{
		$reminderArchived = 'checked="checked"';
		}
	else
		{
		$reminderArchived = '';
		}
	}
$periodSql = "SELECT * FROM periods";
//print $sql;
$pResult = mysql_query($periodSql)or die("Could not successfully run query ($periodSql) from DB: " . mysql_error());
$options = '';
while($pRow = mysql_fetch_assoc($pResult))
	{
	if ($reminderPeriod == $pRow['period'])
		{
		$selected = 'selected="selected"';
		}
	else
		{
		$selected = '';
		}
	$options .= '<option value="'.$pRow['period'].'" '.$selected.'>'.$pRow['period_desc'].'</option>';


	}

$replaceTags = array(	'reminderId' => $reminderId,
						'reminderDesc' => $reminderDesc,
						'reminderDate' => $reminderDate,
						'reminderTime' => $reminderTime,
						'reminderEnabled' => $reminderEnabled,
						'reminderArchived' => $reminderArchived,
						'reminderComment' => $reminderNotes,
						'periodSelections' => $options);
createPage($replaceTags,$reminderTemplates.'t_reminderEditor.php');
?>