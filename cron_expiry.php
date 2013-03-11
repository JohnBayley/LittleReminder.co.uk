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

		$createdCount = 0;
		$reminderCount = 0;
		/* List the reminders that have not had an expiry notice sent about them */
		$sql = "SELECT u.userid, r.description, r.notes, r.reminder_date, r.reminderid, r.period,  u.email, u.firstname, u.surname
				FROM reminders r INNER JOIN users u
				ON r.userid = u.userid
				WHERE reminderid NOT IN	( SELECT rs.reminderid FROM remindersent rs
					WHERE r.reminderid = rs.reminderid  AND r.reminder_date = rs.reminder_date
					AND rs.type = 888)
				AND reminder_date < CURDATE()
				AND reminder_date != '0000-00-00'
				ORDER BY r.reminder_date ASC";
		$result = mysql_query($sql)or die("Could not successfully run query ($sql) from DB: " . mysql_error());

		while($row = mysql_fetch_assoc($result))
			{
			/* Warn Expired reminders */
			list($year, $month, $day) = split('[/.-]', $row['reminder_date']);
			$newRemDate = $year."-".$month."-".$day;
			$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));

			$now = date("l F jS, Y", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));



			//print (($createdCount + 1).") Found expired reminder ".$row['reminderid']." on ".$row['reminder_date']."  -  ");
			/* Build a new reminder to replace this one */
			$num_rows = 0;

			/* Test for expired reminders */
			while($num_rows == 0)
				{
				$resultfut = mysql_query("SELECT * FROM reminders WHERE parentid = '".$row['reminderid']."' and reminder_date > now()");

				$num_rows = mysql_num_rows($resultfut);

				//print ("future reminder count = ".$num_rows."<br>");

				/* Test to see if there is a future reminder now */


				if ($num_rows == 0)
					{
					/*Determine the new date */
					if (($row['period'] == 365) || ($row['period'] == 0))
						{
						$newRemDate = date("Y-m-d",strtotime ($newRemDate." + 1 year"));
						//print ("Additional year for reminder " . $row['reminderid']." expiring ".$row['reminder_date']." to ".$newRemDate."<br>");
						}
					elseif ($row['period'] == 30)
						{
						$newRemDate = date("Y-m-d",strtotime ($newRemDate." + 1 month"));
						//print ("Additional month for reminder " . $row['reminderid']." expiring ".$row['reminder_date']." to ".$newRemDate."<br>");
						}
					elseif ($row['period'] == 90)
						{
						$newRemDate = date("Y-m-d",strtotime ($newRemDate." + 3 month"));
						//print ("Additional 3 months for reminder " . $row['reminderid']." expiring ".$row['reminder_date']." to ".$newRemDate."<br>");
						}
					elseif ($row['period'] == 180)
						{
						$newRemDate = date("Y-m-d",strtotime ($newRemDate." + 6 month"));
						//print ("Additional 6 months for reminder " . $row['reminderid']." expiring ".$row['reminder_date']." to ".$newRemDate."<br>");
						}
					else
						{
						$newRemDate = date("Y-m-d",strtotime ($newRemDate." + ".$row['period']." day"));
						//print ("Additional ".$row['period']." days for reminder " . $row['reminderid']." expiring ".$row['reminder_date']." to ".$newRemDate."<br>");
						}

					/* Insert the new reminder */
					$sqlins = "INSERT INTO reminders VALUES (	NULL, '" . $row['userid'] . "','"
													 			. $newRemDate. "','"
													 			.$row['description']. "','"
													 			.$row['period']."','"
													 			.$row['notes']."','" . $row['reminderid']."')";

					$resultins = mysql_query($sqlins) or die("Could not successfully insert reminder ($sqlins) from DB: " . mysql_error());
					$newRemId =  mysql_insert_id();
					print ("Created new reminder ".$newRemId." due to expire on ".$newRemDate."<br>");
					$createdCount++;

					/* Record the notice of creation of a new reminder */

					$newsql = "INSERT INTO remindersent VALUES (	NULL, '". $newRemId . "','"
																		. $row['userid'] . "','"
																		. $newRemDate . "',
																		CURDATE(),999)";

					$resultins = mysql_query($newsql) or die("Could not successfully insert reminder ($newsql) from DB: " . mysql_error());

					/* If is is a past reminder expire immediately */
					if (strtotime($newRemDate) < strtotime($now))
						{
						$expsql = "INSERT INTO remindersent VALUES (	NULL, '". $newRemId . "','"
																			. $row['userid'] . "','"
																			. $newRemDate . "',
																			CURDATE(),888)";

						$resultexp = mysql_query($expsql) or die("Could not successfully insert reminder ($expsql) from DB: " . mysql_error());

						}
					else
						{
						/* Expire the offending reminder */
						$expsql = "INSERT INTO remindersent VALUES (	NULL, '". $row['reminderid'] . "','"
													. $row['userid'] . "','"
													. $row['reminder_date'] . "',
													CURDATE(),888)";

						$resultexp = mysql_query($expsql) or die("Could not successfully insert reminder ($expsql) from DB: " . mysql_error());

						print ("Sent email to ". $row['email'] . " about expired reminder<br>");

						$niceDate = date("l F jS, Y", mktime(0,0,0,$month,$day,$year));
						$niceNewRemDate = date("l F jS, Y", strtotime($newRemDate));
						$now = date("l F jS, Y", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));

						$taglist = array(	'username'		=>$row['username'],
											'firstname'		=>$row['firstname'],
											'surname'		=>$row['surname'],
											'email'			=>$row['email'],
											'description' 	=>$row['description'],
											'reminder_date' =>$niceDate,
											'new_date' 		=>$niceNewRemDate,
											'expiredpage'	=>"http://www.littlereminder.co.uk/personalReminders/repeats.php?expired=true",
											'notes' 		=>$row['notes']);

						$message = file_get_contents ($authLanguages."reminder_expired.html");
						foreach ($taglist as $tag => $data)
							{
							$message = eregi_replace('{'.$tag.'}', $data ,$message);
							}

						/* Send the acknowledgement email		*/
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
							print ("Reminder expiry note for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."<br>");
							}
						else
							{
							if (mail ( $row['email'], 'Reminder Expiry - '.$row['description'], $message, $headers))
								{
								print ("Reminder expiry note for ".$row[description]." due on ".$niceDate." sent to ".$row['email']."\n");
								}
							}
						$reminderCount++;
						}
					}
				}
			}
	if ($reminderCount == 1)
		{
		print ("<br>\n\nSent ".$reminderCount." expiry notice");
		}
	else
		{
		print ("<br>\n\nSent ".$reminderCount." expiry notices");
		}

	if ($createdCount == 1)
		{
		print ("<br>\n\nCreated ".$createdCount." new reminder");
		}
	else
		{
		print ("<br>\n\nCreated ".$createdCount." new reminders");
		}

	/* End of expired section */
	mysql_close($dbh);
?>