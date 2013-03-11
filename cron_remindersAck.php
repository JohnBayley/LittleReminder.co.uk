<?php
/*****************************************************************************/
/*****************************************************************************/
/* Cron refresh All Reminders                                                */
/*                                                                           */
/* Check for any reminders that have expired and if there is a period then   */
/* create a new reminder in the future according to the period.              */
/* e.g.                                                                      */
/* It's the 2nd Jan and a yearly reminder expired yesterday on the 1st Jan   */
/* so update the reminder date to be next year and clear any alerts          */
/*****************************************************************************/
/*****************************************************************************/
/* Set the security flag */
define('AUTHdbSEC', true);
$cr = "\n";
$debugMode = false;
if ($debugMode)
    {
    $cr = "<br />\n";
    }

/* Enable debug mode to inhibit email and output to a browser window */

/* Load common configuration */
include('../common/reminderCommon.php');

/* Reminder Expiry */
/* 999	= Acknoledge new 	*/
/* 28	= Month Before		*/
/* 14	= Two Weeks Before	*/
/* 7	= Week Before		*/
/* 1	= Day Before		*/
/* 0	= Due Date			*/
/* 888	= Expired			*/

/* Print a title */
	echo ("Reminder Notifications www.littlereminder.co.uk. : Sent on ".date('l F jS, Y').$cr);
	echo ("----------------------------------------------------------------------------------------------------------------------------".$cr.$cr);
    echo ("New Reminders..".$cr);
    echo ("----------------------------------------------------------".$cr);
		/* New Reminders */
		$reminderCount = 0;
		$sql = "    SELECT  u.userid,
		                    r.description,
		                    r.notes,
		                    r.reminder_date,
		                    r.reminderid,
		                    u.email,
		                    u.firstname,
		                    u.surname,
		                    DATE_SUB(r.reminder_date, INTERVAL 1 DAY) AS tomorrow,
		                    DATE_SUB(r.reminder_date, INTERVAL 7 DAY) AS week,
		                    DATE_SUB(r.reminder_date, INTERVAL 14 DAY) AS fortnight,
		                    DATE_SUB(r.reminder_date, INTERVAL 28 DAY) AS month
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE reminderid NOT IN	(   SELECT rs.reminderid FROM remindersent rs
					                        WHERE r.reminderid = rs.reminderid
					                        AND r.reminder_date = rs.reminder_date
					                        AND rs.type = 999)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			/* Ack new reminders */
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			list($year, $month, $day) = split('[/.-]', $row['month']);
			$niceMonth = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			$now = date("l F jS, Y", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
			if (strtotime($row['month'])<strtotime($now))
				{
				$niceMonth = $niceMonth . " : As this date is passed this reminder will be skipped.";
				}
			list($year, $month, $day) = split('[/.-]', $row['fortnight']);
			$niceFortnight = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			if (strtotime($row['fortnight'])<strtotime($now))
				{
				$niceFortnight = $niceFortnight . " : As this date is passed this reminder will be skipped.";
				}
			list($year, $month, $day) = split('[/.-]', $row['week']);
			$niceWeek = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			if (strtotime($row['week'])<strtotime($now))
				{
				$niceWeek = $niceWeek . " : As this date is passed this reminder will be skipped.";
				}
			list($year, $month, $day) = split('[/.-]', $row['tomorrow']);
			$niceTomorrow = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			if (strtotime($row['tomorrow'])<strtotime($now))
				{
				$niceTomorrow = $niceTomorrow . " : As this date is passed this reminder will be skipped.";
				}
			$notes = $row['notes'];
			if ($row['notes'] == "")
			    {
			    $notes = "You have not entered any notes.";
			    }
			$taglist = array(	'username'		=>$row['username'],
								'firstname'		=>$row['firstname'],
								'surname'		=>$row['surname'],
								'email'			=>$row['email'],
								'period'		=> 'One Month',
								'reminder_month' =>$niceMonth,
								'reminder_fortnight' =>$niceFortnight,
								'reminder_week' =>$niceWeek,
								'reminder_tomorrow' =>$niceTomorrow,
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

            $message = file_get_contents ($reminderMailTemplates."reminder_ack.html");
            /*Swapout the tags in the results */
            foreach ($taglist as $tag => $data)
                {
                $message = eregi_replace('{'.$tag.'}', $data ,$message);
                }
            /* Build the email headers*/
            $headers = "Date: ".date('r')."\n";
            $headers .= "Return-Path: ".$adminEmail."\n";
            $headers .= "From: ".$adminEmail."\n";
            $headers .= "Message-ID: <".md5(uniqid(time()))."@littlereminder.co.uk>\n";
            $headers .= "X-Priority: 3\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            $headers .= 'Content-Type: text/html; charset="iso-8859-1"'."\n";
			if ($debugMode == true)
				{
				if (strtotime($niceDate) > strtotime($now))
					{
					echo ("Reminder Acknowledgement for ".$row[reminderid]." due on ".$niceDate." sent to ".$row['email']." <br>");
					}
				else
					{
					echo ("Reminder Acknowledgement for ".$row[reminderid]." due on ".$niceDate." skipped as it is in the past <br>");
					}
				}
			else
				{
				if (strtotime($niceDate) > strtotime($now))
					{
					if (mail ( $row['email'], 'Reminder Acknowledgement - '.$row['description'], $message, $headers))
						{
						echo ("Reminder Acknowledgement for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
						}
					}
				else
					{
					echo ("Reminder Acknowledgement for ".$row[description]." due on ".$niceDate." skipped as it is in the past <br>");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																    . $row['userid'] . "','"
																    . $row['reminder_date'] . "',
																    CURDATE(),999)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}
	if ($reminderCount == 1)
		{
		echo ("Sent ".$reminderCount." new reminder acknowledgement".$cr.$cr.$cr);
		}
	else
		{
		echo ("Sent ".$reminderCount." new reminder acknowledgements".$cr.$cr.$cr);
		}

	/*******************************************************************************/

?>