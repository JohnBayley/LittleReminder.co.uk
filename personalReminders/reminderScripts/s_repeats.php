<?php
/* Test for the security flag */
secureCheck();

echo ("<div id='mainTable'>");
echo ("<form action='repeats.php' method='post' id='repeatsForm'>");
echo ("<table>");
echo ("<tr>");
echo ("	<th class='no'>No.</th>");
echo ("	<th class='description'>Description</th>");
echo ("	<th class='date'>Date</th>");
echo ("	<th class='period'>Period</th>");
echo ("	<th class='status'>Status</th>");
echo ("	<th class='count'>emails sent</th>");
echo ("	<th class='enabled'>Enabled</th>");
echo ("	<th class='enabled'>Archived</th>");
echo ("	<th class='actions'>Edit</th>");
echo ("	<th class='block'>Block Change</th>");
echo ("</tr>");
echo ("<tr>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>&nbsp;</td>");
echo ("	<td class='headHelper'>All &nbsp;<input type='checkbox' id='all' onclick='javascript:selectAll()' title='Select All reminders on this page'/></td>");
echo ("</tr>");


$baseSql = "SELECT
                    reminderid,
					description,
					notes,
					reminder_date,
					reminder_time,
					reminder_enabled,
					reminder_archived,
					p.period_desc,
					p.periodCode,
					CASE WHEN reminder_date < CURDATE() THEN
						'Expired'
					ELSE
						'Active'
					END AS reminder_status,
					(	SELECT count(rs.reminderid)
						FROM remindersent rs
						WHERE r.reminderid = rs.reminderid )AS reminder_count
			FROM reminders r LEFT JOIN users u ON r.userid = u.userid
			LEFT JOIN periods p ON p.period= r.period
			WHERE u.username = LOWER('".$_SESSION['username']."') ";

$clauseSql = "	";
$descSearch = "	";
if (isset($_REQUEST['expired']) && $_REQUEST['expired'] == 'true')
	{
	$clauseSql = "	AND r.reminder_date < CURDATE() ";
	}
if (isset($_REQUEST['all']) && $_REQUEST['all'] == 'true')
	{
	$clauseSql = " ";
	}
if (isset($_REQUEST['thisYear']) && $_REQUEST['thisYear'] == 'true')
	{
	$clauseSql = " AND YEAR(reminder_date) = YEAR(CURDATE()) ";
	}
if (isset($_REQUEST['lastYear']) && $_REQUEST['lastYear'] == 'true')
	{
	$clauseSql = " AND (YEAR(reminder_date)) = (YEAR(CURDATE()) -1) ";
	}
if (isset($_REQUEST['future']) && $_REQUEST['future'] == 'true')
	{
	$clauseSql = " AND r.reminder_date >= CURDATE() ";
	}
if (isset($_REQUEST['descriptionSearch']) && $_REQUEST['descriptionSearch'] != '')
	{
	$descSearch = strtolower($_REQUEST['descriptionSearch']);
	$descSql = " AND (  LOWER(r.description) LIKE ('%".$descSearch."%')
	                    OR
	                    LOWER(r.notes) LIKE ('%".descSearch."%')) ";
	}
else
	{
	$descSql = "";
	}

if (isset($_REQUEST['period']) && $_REQUEST['period'] != '')
	{
	$periodSql = " AND r.period = ".$_REQUEST['period']." ";
	}
else
	{
	$periodSql = "";
	}
$orderSql = " ORDER BY reminder_date ASC ";

$sql = $baseSql . $clauseSql. $descSql. $periodSql. $orderSql;
//print ($sql);

$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
$reminderCount = 0;
$reminderList = 1;
$now = date('Y-m-d H:i:s');

while($row = mysql_fetch_assoc($result))

	{
		$reminderId = $row['reminderid'];
		$status = $row['reminder_status'];
		$desc = $row['description'];
	    $desc = preg_replace("/".$descSearch."/","<span class='searchHit'>".$descSearch."</span>",$desc);
	    $notes = preg_replace("/\'/","`",$row['notes']);
        $notes = preg_replace("/[^A-Za-z0-9\s\`]+/","",$notes);
        //$notesHtml = preg_replace("/".$desc."/","<b>".$desc."</b>",$notes);
        $enabled = '';
        $archived = '';
		$reminder_date= substr($row['reminder_date'], 8, 2)."-".substr($row['reminder_date'], 5, 2)."-".substr($row['reminder_date'], 0, 4);
		if ($row['reminder_enabled'] == 1)
			{
			$enabled = '<a href="javascript:disableReminder(\''.$reminderId.'\')" title="Enable this reminder" id="reminderEnable'.$reminderId.'"><img src="/images/fam/tick.png" alt="enabled" title="This reminder is enabled"/></a>';
			}
		else
			{
			$enabled = '<a href="javascript:enableReminder(\''.$reminderId.'\')" title="Disable this reminder" id="reminderEnable'.$reminderId.'"><img src="/images/fam/cross.png" alt="disabled"  title="This reminder is disabled" /></a>';
			}
		if ($row['reminder_archived'] == 1)
			{
			$archived = '<a href="javascript:unArchiveReminder(\''.$reminderId.'\')" title="Un-archive this reminder" id="reminderArchive'.$reminderId.'"><img src="/images/fam/tick.png" alt="archived" title="This reminder is archived"/></a>';
			}
		else
			{
			$archived = '<a href="javascript:archiveReminder(\''.$reminderId.'\')" title="Archive this reminder" id="reminderArchive'.$reminderId.'"><img src="/images/fam/dash_grey.png" alt="not archived" title="This reminder is not archived"/></a>';
			}
		echo ("<tr id='reminder".$reminderId."'>\n");
			echo ("<td class='no ".$status."'>\n");
			echo ($reminderList);
			echo ("</td>\n");
			echo ("<td class='description ".$status."' title='".$notes."'>\n");
			echo ($desc);
			echo (" ".$row['reminder_time']);
			echo ("</td>\n");
			echo ("<td class='date ".$status."'>\n");
			echo ($reminder_date);
			echo ("</td>\n");
			echo ("<td class='period ".$status."'>\n");
			echo ($row['period_desc']);
			echo ("</td>\n");
			echo ("<td class='status ".$status."'>\n");
			echo ($status);
			echo ("</td>\n");
			echo ("<td class='count ".$status."'>\n");
			echo ($row['reminder_count']);
			echo ("</td>\n");
			echo ("<td class='count ".$status."'>\n");
			echo ($enabled);
			echo ("</td>\n");
			echo ("<td class='count ".$status."'>\n");
			echo ($archived);
			echo ("</td>\n");
			echo ("<td class='actions'>\n");
				echo ("<a class='rmEdit' href='/personalReminders/reminderEditor.php?rmId=".$reminderId."' title='Edit reminder : ".$desc."'>");
				echo ("<img src='/images/fam/date_edit.png' /></a> &nbsp; | &nbsp;");
				echo ("<a class='toolTipTop' href='javascript:delReminder(\"".$reminderId."\")' title='Delete'>");
				echo ("<img src='/images/fam/date_delete.png' /></a>");
			echo ("</td>\n");
			echo ("<td class='block ".$status."'>\n");
				echo ("<input type='hidden' id='reminderDate".$reminderCount."' name='reminderDate".$reminderCount."' value='".$reminder_date."' />");
				echo ("<input type='checkbox' id='check".$reminderCount."' name='check".$reminderCount."' />");
				echo ("<input type='hidden' id='reminderLocate".$reminderCount."' name='reminderLocate".$reminderCount."' value='".$reminderId."' />");
				echo ("<input type='hidden' id='reminderPeriodCode".$reminderCount."' name='reminderPeriodCode".$reminderCount."' value='".$row['periodCode']."' />");
			echo ("</td>\n");
		echo ("</tr>\n");
		$reminderCount++;
        $reminderList++;
	}
echo ("</table>");

echo ("<ins><input type='hidden' name='reminderCount' value='".$reminderCount."' />");
echo ("<input type='hidden' name='updateRepeats' value='true' />");
echo ("<input type='hidden' id='updateMode' name='updateMode' value='none' /></ins>");


echo ("</form>");
echo ("</div>");
echo ("<script type='text/javascript'>");

if ($reminderCount == 1)
	{
	echo ("document.getElementById('leftinfo').innerHTML = 'Found 1 Reminder';");
	}
else
	{
	echo ("document.getElementById('leftinfo').innerHTML = 'Found ".$reminderCount." Reminders';");
	echo ("reminderCount = ".$reminderCount.";");

	}
echo ("</script>");

?>
