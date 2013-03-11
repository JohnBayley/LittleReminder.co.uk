<?php

$username = $_SESSION['username'];
print ("<table>\n");
print ("<tr>\n");
print ("<th>Day</th>\n");
print ("<th>Reminder Desc</th>\n");
print ("<th>Status</th>\n");
print ("<th>Id</th>\n");
print ("</tr>\n");
$prevYear = 0;
$prevMonth = 0;
$prevDay = 0;
$reminderCount = 0;
$clauseSql = "	";
$descSearch = "";
$showTxt = "All Reminders";
if (isset($_REQUEST['expired']) && $_REQUEST['expired'] == 'true')
	{
	$clauseSql = "	AND r.reminder_date < CURDATE() ";
	$showTxt = "Expired Reminders";
	}
if (isset($_REQUEST['all']) && $_REQUEST['all'] == 'true')
	{
	$clauseSql = " ";
	}
if (isset($_REQUEST['thisYear']) && $_REQUEST['thisYear'] == 'true')
	{
	$clauseSql = " AND YEAR(reminder_date) = YEAR(CURDATE()) ";
	$showTxt = "This Years Reminders";
	}
if (isset($_REQUEST['lastYear']) && $_REQUEST['lastYear'] == 'true')
	{
	$clauseSql = " AND (YEAR(reminder_date)) = (YEAR(CURDATE()) -1) ";
	$showTxt = "Last Years Reminders";
	}
if (isset($_REQUEST['future']) && $_REQUEST['future'] == 'true')
	{
	$clauseSql = " AND r.reminder_date >= CURDATE() ";
	$showTxt = "Future Reminders";
	}
if (isset($_REQUEST['descriptionSearch']) && $_REQUEST['descriptionSearch'] != '')
	{
	$descSearch = strtolower($_REQUEST['descriptionSearch']);
	$descSql = " AND (  LOWER(r.description) LIKE ('%".$descSearch."%')
	                    OR
	                    LOWER(r.notes) LIKE ('%".descSearch."%')) ";
	$showTxt .= " and reminders with description Like <b>&quot;".$descSearch."&quot;</b> ";
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
$sql = "SELECT * FROM
            (
		        (
		        SELECT  u.userid AS userid,
		                'due' AS reminder_period,
		                r.reminderid ,
		                r.reminder_date AS reminder_date,
		                r.description,
		                (
		                    SELECT  sent_date
		                    FROM remindersent rs
		                    WHERE r.reminderid = rs.reminderid
		                    AND r.reminder_date = rs.reminder_date
		                    AND type = 0
		                ) AS sent_date,
		        0 as type
		        FROM reminders r INNER JOIN users u ON r.userid = u.userid
				WHERE u.username = '".$username."'
				AND r.reminder_date >= CURDATE()
				".$clauseSql." ".$descSql." ".$periodSql."
				)
				UNION ALL
				(
				SELECT  u.userid AS userid,
				        'tomorrow' AS reminder_period,
				        r.reminderid ,
				        DATE_SUB(r.reminder_date, INTERVAL 1 DAY) AS reminder_date,
				        r.description,
				        (
				        SELECT sent_date
				        FROM remindersent rs
				        WHERE r.reminderid = rs.reminderid
				        AND r.reminder_date = rs.reminder_date
				        AND type = 1
				        ) AS sent_date,
				1 as type
				FROM reminders r INNER JOIN users u ON r.userid = u.userid
				WHERE u.username = '".$username."'
				AND r.reminder_date >= CURDATE()
				".$clauseSql." ".$descSql." ".$periodSql."
				)
				UNION ALL
				(
				SELECT  u.userid AS userid,
				        'week' AS reminder_period,
				        r.reminderid ,
				        DATE_SUB(r.reminder_date, INTERVAL 7 DAY) AS reminder_date,
				        r.description,
				        (
                            SELECT sent_date
                            FROM remindersent rs
                            WHERE r.reminderid = rs.reminderid
                            AND r.reminder_date = rs.reminder_date
                            AND type = 7
				        ) AS sent_date,
				7 as type
				FROM reminders r INNER JOIN users u ON r.userid = u.userid
				WHERE u.username = '".$username."'
				AND r.reminder_date >= CURDATE()
				".$clauseSql." ".$descSql." ".$periodSql."
				)

				UNION ALL
                (
                SELECT  u.userid AS userid,
                        'fortnight' AS reminder_period,
                        r.reminderid,
                        DATE_SUB(r.reminder_date, INTERVAL 14 DAY) AS reminder_date,
                        r.description,
                        (
                            SELECT sent_date
                            FROM remindersent rs
                            WHERE r.reminderid = rs.reminderid
                            AND r.reminder_date = rs.reminder_date
                            AND type = 14
                        ) AS sent_date,
                14 as type
                FROM reminders r INNER JOIN users u ON r.userid = u.userid
				WHERE u.username = '".$username."'
				AND r.reminder_date >= CURDATE()
				".$clauseSql." ".$descSql." ".$periodSql."
				)
				UNION ALL
				(
				SELECT  u.userid AS userid,
                        'month' AS reminder_period,
                        r.reminderid ,
                        DATE_SUB(r.reminder_date, INTERVAL 28 DAY) AS reminder_date,
                        r.description,
                        (
                            SELECT sent_date
                            FROM remindersent rs
                            WHERE r.reminderid = rs.reminderid
                            AND r.reminder_date = rs.reminder_date
                            AND type = 28
                        ) AS sent_date,
				        28 as type
				FROM reminders r INNER JOIN users u ON r.userid = u.userid
				WHERE u.username = '".$username."'
				AND r.reminder_date >= CURDATE()
				".$clauseSql." ".$descSql." ".$periodSql."
				)
			) AS AA
			ORDER BY reminder_date ASC";
$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
    while($row = mysql_fetch_assoc($result))
        {
        $reminderCount++;
        list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
        if (($prevYear != $year) || ( $prevMonth != $month))
            {
            $prevYear = $year;
            $prevMonth = $month;
            $dispMonth = date("F", mktime(0,0,0,$month));
            print ("<tr><td class='dateSection' colspan='4'>".$dispMonth." ".$year."</td><tr>");
            }
        if (isset($row['sent_date']))
            {
            print ("<tr>");
            print ("<td class='pre_".$row['reminder_period']."'>".$day."</td>");
            print ("<td class='pre_".$row['reminder_period']."'>".$row['description']." - ".$row['reminder_period']."</td>");
            print ("<td class='pre_".$row['reminder_period']." sentReminder'>Sent ".$row['sent_date']."</td>");
            print ("<td class='pre_".$row['reminder_period']."'>".$row['reminderid']."</td>");
            print ("</tr>\n");
            }

		else
            {
            $now = date('Y-m-d H:i:s');
            if (strtotime($now) >= strtotime($row['reminder_date']))
                {
                print ("<tr>");
                print ("<td class='pre_".$row['reminder_period']."'>".$day."</td>");
                print ("<td class='pre_".$row['reminder_period']."'>".$row['description']." - ".$row['reminder_period']."</td>");
                print ("<td class='pre_".$row['reminder_period']."'>Skipped</td>");
                print ("<td class='pre_".$row['reminder_period']."'>".$row['reminderid']."</td>");
                print ("</tr>\n");
                }

			else
                {
                print ("<tr>");
                print ("<td class='pre_".$row['reminder_period']."'>".$day."</td>");
                print ("<td class='pre_".$row['reminder_period']."'>".$row['description']." - ".$row['reminder_period']."</td>");
                print ("<td class='pre_".$row['reminder_period']."'>Pending</td>");
                print ("<td class='pre_".$row['reminder_period']."'>".$row['reminderid']."</td>");
                print ("</tr>\n");
                }
            }
        }
print ("</table>");
print ("<script type='text/javascript'>");
print ("document.getElementById('leftinfo').innerHTML = 'Found ".$reminderCount." reminder email plans.';");
print ("document.getElementById('descriptionSearch').value = '".$descSearch."';");
print ("document.getElementById('nowShowing').innerHTML = 'Showing ".$showTxt."';");
print ("</script>");
?>

