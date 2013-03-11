<?php
/* Load common configuration */
include('common.php');
/* Test for the security flag */
secureCheck();

echo ("<h3>Reminders Homepage for ".$_SESSION['username']."</h3>\n");

echo ("<hr/>\n");
echo ("<div id='homepage'>\n");
echo ("<table>\n");
echo ("<tr>\n");
echo ("<th>Recent emails</th>\n");
echo ("<th>Reminder Summary</th>\n");
echo ("</tr>\n");
echo ("<tr>\n");
echo ("<td>\n<div id='esum'><table>");

	$sql = "SELECT * FROM remindersent r JOIN users u on u.userid = r.userid JOIN reminders rm ON rm.reminderid = r.reminderid
	WHERE u.username  = '".$_SESSION["username"]."'
	ORDER BY sent_date ASC
	LIMIT 5";
	$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
	while($row = mysql_fetch_assoc($result))
		{
			list($year, $month, $day) = split('[/.-]', $row['sent_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));			
		echo ("<tr><td>".$row["description"]." sent : </td><td>".$niceDate." </td></tr>");
		}

echo ("</table></td>\n");
echo ("<td>\n<div id='esum'><table>");


	//All Reminders
	$sqlCount = "SELECT count(*) FROM users u JOIN reminders r ON u.userid = r.userid 
	WHERE u.username = '".$_SESSION["username"]."'";
	$reminderCount = mysql_result(mysql_query($sqlCount),0,0) ;
echo ("<tr><td> You have a total of ".$reminderCount." active reminders</td></tr>");


	//All Reminders
	$sqlCount = "SELECT count(*) FROM users u JOIN reminders r ON u.userid = r.userid 
	WHERE u.username = '".$_SESSION["username"]."' 
	AND reminder_date > CURDATE()
	AND reminder_date < DATE_ADD(CURDATE(), INTERVAL 1 YEAR)
	";
	$reminderCount = mysql_result(mysql_query($sqlCount),0,0) ;
echo ("<tr><td> You have ".$reminderCount." reminders for the comming year</td></tr>");

	//Annual Reminders
	$sqlCount = "SELECT count(*) FROM users u JOIN reminders r ON u.userid = r.userid 
	WHERE u.username = '".$_SESSION["username"]."' 
	AND reminder_date > CURDATE()
	AND reminder_date < DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
	";
	$reminderCount = mysql_result(mysql_query($sqlCount),0,0) ;
echo ("<tr><td> You have ".$reminderCount." reminders this month</td></tr>");

	//Expired reminders
	$sqlCount = "SELECT count(*) FROM users u JOIN reminders r ON u.userid = r.userid 
	WHERE u.username = '".$_SESSION["username"]."' 
	AND reminder_date < CURDATE()
	";
	$reminderCount = mysql_result(mysql_query($sqlCount),0,0) ;
echo ("<tr><td> You have ".$reminderCount." expired reminders</td></tr>");

	//Account type
	$sqlCount = "SELECT count(*) FROM users u JOIN business b ON u.userid = b.userid 
	WHERE u.username = '".$_SESSION["username"]."' 
	";
	$reminderCount = mysql_result(mysql_query($sqlCount),0,0) ;
if ($reminderCount > 0 )
	{
	echo ("<tr><td> You have a business account</td></tr>");
	}
else
	{
	echo ("<tr><td> You have a personal account</td></tr>");		
	}		
	
echo ("</table></td>\n");								
echo ("</tr>\n");
echo ("<tr>\n");
echo ("<td>\n");


echo ("</td>\n");
echo ("<td>\n");
echo ("</td>\n");
echo ("</tr>\n");
echo ("<tr>\n");
echo ("<th>Reminders by Period</th>\n");
echo ("<th>&nbsp;</th>\n");
echo ("</tr>\n");
echo ("<tr>\n");
echo ("<td>\n<div id='esum'><table>");


		$sql="	SELECT r.period, COUNT(*) AS TOTAL
				FROM reminders r JOIN users u ON u.userid = r.userid 
				WHERE u.username = '".$_SESSION["username"]."' AND r.period >0 AND r.period != 365
				GROUP BY r.period
				ORDER BY r.period";
		
	$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
	while($row = mysql_fetch_assoc($result))
		{
		if ($row["period"] == 1)
			{
			echo ("<tr><td>Every ".$row["period"]." day : </td><td>".$row["TOTAL"]." reminder </td></tr>");
			}
		else
			{
			echo ("<tr><td>Every ".$row["period"]." days : </td><td>".$row["TOTAL"]." reminders </td></tr>");	
			}
		}
		$sql="	SELECT COUNT(*) AS TOTAL
				FROM reminders r JOIN users u ON u.userid = r.userid 
				WHERE u.username = '".$_SESSION["username"]."' AND ( r.period =0 OR r.period = 365 )
				ORDER BY r.period";
		
	$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
	while($row = mysql_fetch_assoc($result))
		{
		if ($row["period"] == 1)
			{
			echo ("<tr><td>Every Year : </td><td>".$row["TOTAL"]." reminder </td></tr>");
			}
		else
			{
			echo ("<tr><td>Every Year : </td><td>".$row["TOTAL"]." reminders </td></tr>");	
			}
		}

echo ("</table>\n");		
echo ("</td></tr></table>\n");
echo ("</div>\n");

		
	mysql_close($dbh); 
?>