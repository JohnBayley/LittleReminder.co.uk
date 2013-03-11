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
	echo ("Reminder Notifications www.littlereminder.co.uk. : Sent on ".date('l F jS, Y').$cr);
	echo ("----------------------------------------------------------------------------------------------------------------------------".$cr.$cr);
    echo ("Reminder Notifications..".$cr);
    echo ("----------------------------------------------------------".$cr);

	/* Start of reminders section */
		$reminderCount = 0;
		/*		Month before reminder */
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE DATE_SUB(r.reminder_date, INTERVAL 28 DAY) = CURDATE()
				AND reminderid NOT IN
					( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 28)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			// Send Reminders a month early
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
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
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

            $message = file_get_contents ($reminderMailTemplates."reminder.html");
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

	/* Combine headers and message and send the email*/

			if ($debugMode == true)
				{
				echo ("One month reminder for ".$row[reminderid]." due on ".$niceDate." sent to ".$row['email'].$cr);
				}
			else
				{
				if (mail ( $row['email'], 'One Month Reminder - '.$row['description'], $message, $headers))
					{
					echo ("One month reminder for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																. $row['userid'] . "','"
																. $row['reminder_date'] . "',
																CURDATE(),28)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}


		//		Fortnight before reminder
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE DATE_SUB(r.reminder_date, INTERVAL 14 DAY) = CURDATE()
				AND reminderid NOT IN
					( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 14)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			// Send Reminders a fortnight early
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			$notes = $row['notes'];
			if ($row['notes'] == "")
			    {
			    $notes = "You have not entered any notes.";
			    }
			$taglist = array(	'username'		=>$row['username'],
								'firstname'		=>$row['firstname'],
								'surname'		=>$row['surname'],
								'email'			=>$row['email'],
								'period'		=> 'Two Week',
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

            $message = file_get_contents ($reminderMailTemplates."reminder.html");
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

	/* Combine headers and message and send the email*/
			if ($debugMode == true)
				{
				echo ("Two Week reminder for ".$row[reminderid]." due on ".$niceDate." sent to ".$row['email'].$cr);
				}
			else
				{
				if (mail ( $row['email'], 'Two Week Reminder - '.$row['description'], $message, $headers))
					{
					echo ("Two Week reminder for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																. $row['userid'] . "','"
																. $row['reminder_date'] . "',
																CURDATE(),14)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}


		// 	Week before reminder
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE DATE_SUB(r.reminder_date, INTERVAL 7 DAY) = CURDATE()
				AND reminderid NOT IN
					( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 7)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			// Send Reminders a fortnight early
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			$notes = $row['notes'];
			if ($row['notes'] == "")
			    {
			    $notes = "You have not entered any notes.";
			    }
			$taglist = array(	'username'		=>$row['username'],
								'firstname'		=>$row['firstname'],
								'surname'		=>$row['surname'],
								'email'			=>$row['email'],
								'period'		=> 'One Week',
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

            $message = file_get_contents ($reminderMailTemplates."reminder.html");
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
	/* Combine headers and message and send the email*/
			if ($debugMode == true)
				{
				echo ("One Week reminder for ".$row[reminderid]." due on ".$niceDate." sent to ".$row['email'].$cr);
				}
			else
				{
				if (mail ( $row['email'], 'One Week Reminder - '.$row['description'], $message, $headers))
					{
					echo ("One Week reminder for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																. $row['userid'] . "','"
																. $row['reminder_date'] . "',
																CURDATE(),7)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}

		//		Day before reminder
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE DATE_SUB(r.reminder_date, INTERVAL 1 DAY) = CURDATE()
				AND reminderid NOT IN
					( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 1)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			// Send Reminders for tomorrow
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			$notes = $row['notes'];
			if ($row['notes'] == "")
			    {
			    $notes = "You have not entered any notes.";
			    }
			$taglist = array(	'username'		=>$row['username'],
								'firstname'		=>$row['firstname'],
								'surname'		=>$row['surname'],
								'email'			=>$row['email'],
								'period'		=> 'One Day',
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

			$message = file_get_contents ($authLanguages."reminder_tomorrow.html");
			foreach ($taglist as $tag => $data)
				{
				$message = eregi_replace('{'.$tag.'}', $data ,$message);
				}

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
				echo ("One more day reminder for ".$row[reminderid]." due on ".$niceDate." sent to ".$row['email'].$cr);
				}
			else
				{
				if (mail ( $row['email'], 'One more day - Reminder - '.$row['description'], $message, $headers))
					{
					echo ("One more day reminder for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																. $row['userid'] . "','"
																. $row['reminder_date'] . "',
																CURDATE(),1)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}


		//		Due Today reminder
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE r.reminder_date = CURDATE()
				AND reminderid NOT IN
					( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 0)
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());
		while($row = mysql_fetch_assoc($result))
			{
			// Send Reminders for today
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
			$notes = $row['notes'];
			if ($row['notes'] == "")
			    {
			    $notes = "You have not entered any notes.";
			    }
			$taglist = array(	'username'		=>$row['username'],
								'firstname'		=>$row['firstname'],
								'surname'		=>$row['surname'],
								'email'			=>$row['email'],
								'period'		=> 'Today',
								'reminder_date' =>$niceDate,
								'description' 	=>$row['description'],
								'notes' 		=>$notes);

            $message = file_get_contents ($reminderMailTemplates."reminder_today.html");
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

	/* Combine headers and message and send the email*/
			if ($debugMode == true)
				{
				echo ("Due Today !! reminder for ".$row[reminderid]." due today ".$niceDate." sent to ".$row['email'].$cr);
				}
			else
				{
				if (mail ( $row['email'], 'Today - Reminder - '.$row['description'], $message, $headers))
					{
					echo ("Due Today !! reminder for ".$row[description]." due today ".$niceDate." sent to ".$row['email']."\n");
					}
				}
			$writesql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
																. $row['userid'] . "','"
																. $row['reminder_date'] . "',
																CURDATE(),0)";
			$writeresult = mysql_query($writesql) or die("Could not successfully insert reminder ($writesql) from DB: " . mysql_error());
			$reminderCount ++;
			}

	//Summary

	if ($reminderCount == 1)
		{
		echo ("Sent ".$reminderCount." reminder");
		}
	else
		{
		echo ("Sent ".$reminderCount." reminders");
		}


	/*******************************************************************************/

?>