<?php
/*****************************************************************************/
/*****************************************************************************/
/* Cron refresh All Reminders                                                */
/*                                                                           */
/* Check for any reminders that have expired and if there is a period then   */
/* create a new reminder in the future according to the period.              */
/* e.g.                                                                      */
/* It's the 2nd Jan and a yearly reminder expired yesterday on the 1s Jan    */
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
	echo ("Expired Reminders & Maintenance www.littlereminder.co.uk. : Refreshed on ".date('l F jS, Y').$cr);
	echo ("----------------------------------------------------------".$cr.$cr);


		/* Expired Reminders */
		$updateCount = 0;
		/* List the reminders that have not had an expiry notice sent about them */
		/* If there is an expiry notice then there was no period */
		/*TODO : SHould this just deal with expired reminders?? */
		$sql = "    SELECT  u.userid,
		                    r.description,
		                    r.notes,
		                    r.reminder_date,
		                    r.reminderid,
		                    r.period,
		                    u.email,
		                    u.firstname,
		                    u.surname,
                            p.period_desc,
                            p.periodCode
				FROM reminders r
				INNER JOIN users u	ON r.userid = u.userid
				LEFT JOIN periods p ON p.period= r.period
				WHERE reminderid NOT IN	( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 888)
				AND reminder_date < CURDATE()
				AND reminder_date != '0000-00-00'
				AND reminder_enabled = 1
				AND reminder_archived = 0
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql);
		echo ("Updating reminders to the new dates ".$cr);
		echo ("----------------------------------------------------------".$cr);
		while($row = mysql_fetch_assoc($result))
			{
            if($row['period']  != 0)
                {
                /* There is a period so use it to calculate the update */
                /* Get the reminder date */
                $reminder_date = $row['reminder_date'];
                /* There is a period to this reminder so lets refresh it to a date in the future. */
                do {
                    $reminder_date = date('d-m-Y',strtotime( $reminder_date .' + '.$row['periodCode'].' ' ));
                    }
                while (strtotime($reminder_date) < strtotime('now'));
                /* Right, now we have a new date let's update the reminder */
                $newDay= substr($reminder_date, 0, 2);
                $newMonth= substr($reminder_date, 3, 2);
                $newYear= substr($reminder_date, 6, 4);
                //echo ("Update".$loopCount." to ".$reminder_date."<br />");
                //$reminder_date = $reminder_date + 1;
                $updateSql = "  UPDATE reminders SET reminder_date='"	. $newYear . "/"
                                                                        . $newMonth . "/"
                                                                        . $newDay . "'
                                WHERE reminderid = '".$row['reminderid']."'";
                $reminder_date = date('d-m-Y',strtotime( $newYear."/".$newMonth."/".$newDay));
                /* Update the reminder in the db.*/
                $udResult = mysql_query($updateSql);
                if (mysql_affected_rows() == 1)
                    {
                    $updateCount++;
                    echo ($row['period_desc']." reminder No.".$row['reminderid']." updated from ".date('d-m-Y',strtotime( $row['reminder_date'] ))." to  ".date('d-m-Y',strtotime($reminder_date)).$cr);

                    /*Email Start */
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
                            WHERE reminderid = '".$row['reminderid']."'
                            ORDER BY r.reminder_date ASC";
                    $result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
                    $row = mysql_fetch_assoc($result);
                    /* Ack updated reminders */
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

                    $message = file_get_contents ($reminderMailTemplates."reminder_updatedAck.html");
                    /*Swapout the tags in the results */
                    foreach ($taglist as $tag => $data)
                        {
                        $message = eregi_replace('{'.$tag.'}', $data ,$message);
                        }
                    /* Build the email headers*/
                        $headers = "From: ".$adminEmail . "\r\n";
                        $headers .= "Content-type: text/html\r\n";
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
                    }
                    /* Email End */
                /* No need to delete the notifications log as the reminder date forms a part of the email notification sent log */
                }
			}

	if ($updateCount == 1)
		{
		echo ($cr.$cr."Updated ".$updateCount." reminder");
		}
	else
		{
		echo ($cr.$cr."Updated ".$updateCount." reminders");
		}

	/* End of expired section */

?>