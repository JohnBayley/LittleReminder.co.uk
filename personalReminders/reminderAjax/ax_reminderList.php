<?php
/* Set the security flag */
define('AUTHdbSEC', true);

/* Start a php session */
session_start();

/* Load common configuration */
include('reminderCommon.php');

/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');
$listOptionsUpdate = "";
$listOptionsUpdate .= "$('#activeReminder').attr('checked', true);";
/* Validate the user */



$reminderCount = 0;

echo ("<script language='JavaScript' type='Text/javascript'>\n");
echo ("parent.reminders = [];\n");
echo ("</script>\n");
$baseSql = "    SELECT  username,
                        firstname,
                        surname,
                        reminderid,
                        reminder_date,
                        description,
                        notes,
                        period,
                        reminder_time,
                        reminder_enabled,
                        reminder_archived,
                        CASE
                            WHEN reminder_enabled = 0 THEN 30
                            WHEN reminder_archived = 1 THEN 20
                            WHEN reminder_date < curdate() THEN 10
                            ELSE 0
                        END reminder_order
                FROM reminders r JOIN users u ON r.userid = u.userid
		        WHERE u.username = '".$_SESSION['username']."' ";

if (isset($_REQUEST['activeReminder']) && $_REQUEST['activeReminder'] != "" && $_REQUEST['activeReminder'] == "true")
	{
	$activeSql = "  ";
	$listOptionsUpdate .= "$('#activeReminder').attr('checked', true);";
	}
else
	{
	$activeSql = " AND reminder_date <  CURDATE() ";
	$listOptionsUpdate .= "$('#activeReminder').attr('checked', false);";
	}

if (isset($_REQUEST['archivedReminder']) && $_REQUEST['archivedReminder'] != "" && $_REQUEST['archivedReminder'] == "true")
	{
	$archSql = "  ";
	$listOptionsUpdate .= "$('#archivedReminder').attr('checked', true);";
	}
else
	{
	$archSql = " AND reminder_archived = 0 ";
	$listOptionsUpdate .= "$('#archivedReminder').attr('checked', false);";
	}
if (isset($_REQUEST['disabledReminder']) && $_REQUEST['disabledReminder'] != "" && $_REQUEST['disabledReminder'] == "true")
	{
	$disabledSql = "  ";
	$listOptionsUpdate .= "$('#disabledReminder').attr('checked', true);";
	}
else
	{
	$disabledSql = " AND reminder_enabled = 1 ";
	$listOptionsUpdate .= "$('#disabledReminder').attr('checked', false);";
	}

if (isset($_REQUEST['expiredReminder']) && $_REQUEST['expiredReminder'] != "" && $_REQUEST['expiredReminder'] == "true")
	{
	$expiredSql = "  AND reminder_date <  CURDATE() ";
	$listOptionsUpdate .= "$('#expiredReminder').attr('checked', true);";
	}
else
	{
	$expiredSql = " AND reminder_date >=  CURDATE() -30 ";
	$listOptionsUpdate .= "$('#expiredReminder').attr('checked', false);";
	}

$orderSql = " ORDER BY reminder_order, reminder_date ASC ";



$sql = $baseSql. $activeSql. $archSql . $expiredSql.$disabledSql. $orderSql;
//echo $sql;
$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());

while($row = mysql_fetch_assoc($result))
	{
	$reminderCount++;
	$reminder_date= substr($row['reminder_date'], 8, 2)."-".substr($row['reminder_date'], 5, 2)."-".substr($row['reminder_date'], 0, 4);
	$reminderDesc = preg_replace("/\'/","`",$row['description']);
	$reminderDesc = preg_replace("/[^A-Za-z0-9\s\`]+/","",$reminderDesc);

	$reminderNotes = preg_replace("/\'/","`",$row['notes']);
	$reminderTime = substr($row['reminder_time'],0,5);
    $reminderNotes = preg_replace("/[^A-Za-z0-9\s\`]+/","",$reminderNotes);
	$username = htmlspecialchars($row['username']);
	$userfn = htmlspecialchars($row['firstname']);
	$usersn = htmlspecialchars($row['surname']);
	$reminderTime .= " ";
	
	if ($reminderNotes == "")
		{
		$reminderNotes = $reminderDesc;
		}
	$image = "date_active.png";
	$imageAlt = "Active";
	$reminderPrefix = "";
	$reminderClass = "rmActive";
	if (strtotime($row['reminder_date'])<strtotime("now"))
		{
		$image = "date_expired.png";
		$imageAlt = "Expired";
		$reminderPrefix = "Expired Reminder";
		$reminderClass = "rmExpired";
		}
	if ($row['reminder_archived'] == 1)
		{
		$image = "date_archived.png";
		$imageAlt = "Archived";
		$reminderPrefix = "Archived Reminder";
		$reminderClass = "rmArchived";
		}
	if ($row['reminder_enabled'] == 0)
		{
		$image = "date_disabled.png";
		$imageAlt = "Disabled";
		$reminderPrefix = "Disabled Reminder";
		$reminderClass = "rmDisabled";
		}
	echo ("<img src='/images/fam/".$image."' alt='".$imageAlt."' title = '".$reminderPrefix."'/>");
	echo ("<a class='reminderPopupLink ".$reminderClass."' rel='/personalReminders/reminderAjax/ax_reminderPopup.php' title='".$reminderNotes." due on " .$reminder_date."- Click to go to this reminder' id='".$row['reminderid']."-".$row['userid']."' href='javascript:jumpToDate(\"".$row['reminderid']."\")' >");


	echo ($reminderDesc.$reminderTime.$reminder_date."</a><br />\n");

	echo ("<script type='text/javascript'>\n");
	echo ("addReminder('".$row['reminder_date']."','".$reminderDesc."','".$row['reminderid']."','".$row['notes']."','".$row['period']."','".$row['reminder_enabled']."','".$row['reminder_time']."');\n");
	echo (" ".$listOptionsUpdate." ");
	echo ("</script>\n");

	}
?>