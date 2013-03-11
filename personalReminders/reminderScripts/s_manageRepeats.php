<?php

/* Test for the security flag */
secureCheck();

if (isset($_REQUEST['reminderCount'])&&$_REQUEST['reminderCount']!="")

	{
	$delCount = 0;
    $loopCount = 0;
	$updateCount = 0;
	$noUpdateCount = 0;
	$reminderCount = $_REQUEST['reminderCount'];

	while ($loopCount<=$reminderCount)

		{
		$sql = '';
		if(isset($_REQUEST['reminderLocate'.$loopCount]))
			{
			if(isset($_REQUEST['check'.$loopCount]))
					{
					if ($_REQUEST['updateMode'] == 'enableUpdate')
						{
						$sql = "UPDATE reminders SET reminder_enabled = 1
								WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
						}
					if ($_REQUEST['updateMode'] == 'disableUpdate')
						{
						$sql = "UPDATE reminders SET reminder_enabled = 0
								WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
						}
					if ($_REQUEST['updateMode'] == 'archiveUpdate')
						{
						$sql = "UPDATE reminders SET reminder_archived = 1
								WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
						}
					if ($_REQUEST['updateMode'] == 'unarchiveUpdate')
						{
						$sql = "UPDATE reminders SET reminder_archived = 0
								WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
						}
					if ($_REQUEST['updateMode'] == 'autoUpdate')
						{
						/* build the date of this reminder */
						$reminder_date= strtotime(substr($_REQUEST['reminderDate'.$loopCount], 0, 2)."-".substr($_REQUEST['reminderDate'.$loopCount], 3, 2)."-".substr($_REQUEST['reminderDate'.$loopCount], 6, 4));
						$reminder_date =date('d-m-Y',$reminder_date);
						/* Recalculate a date */
						if ($_REQUEST['reminderPeriodCode'.$loopCount] != '')
						    {
                            do {
                                if (strtotime($reminder_date) < strtotime('now'))
                                    {
                                    $reminder_date =date('d-m-Y',strtotime( $reminder_date.' + '.$_REQUEST['reminderPeriodCode'.$loopCount]));
                                    }
                                }

                            while (strtotime($reminder_date) < strtotime('now'));

                            $newDay= substr($reminder_date, 0, 2);
                            $newMonth= substr($reminder_date, 3, 2);
                            $newYear= substr($reminder_date, 6, 4);
                            //print ("Update".$loopCount." to ".$reminder_date."<br />");
                            //$reminder_date = $reminder_date + 1;
                            $sql = "UPDATE reminders SET reminder_date='"	. $newYear . "/"
                                                                            . $newMonth . "/"
                                                                            . $newDay . "'
                                    WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
                            //print ($sql);
                            }
                        else {
                            $noUpdateCount++;
                            }
						}
					if ($_REQUEST['updateMode'] == 'Delete')
						{
                            $sql = "DELETE FROM reminders
                                    WHERE reminderid = '".$_REQUEST['reminderLocate'.$loopCount]."'";
                            $delCount++;
						}
					if ($sql != "")
						{
						$result = mysql_query($sql) or die("Could not successfully update reminder ($sql) from DB: " . mysql_error());
						if (mysql_affected_rows() == 1)
							{
							$updateCount++;
							}
						}
					}
			}

        $loopCount ++;
        }

	}
$returnVal = "";
if ($delCount >0 )
	{
	if ($updateCount == 1)
		{
		$returnVal = 'showData("Deleted","One reminder deleted.");';
		}
	if ($updateCount > 1)
		{
		$returnVal = 'showData("Deleted","'.$updateCount.' reminders deleted.");';
		}
	}
else
	{
	if ($updateCount >0 )
		{

		if ($updateCount == 1)
			{
			$returnVal = 'showData("Updated","One reminder updated.");';
			}
		if ($updateCount > 1)
			{
			$returnVal = 'showData("Updated","'.$updateCount.' reminders updated.");';
			}

		}
	}
if ($returnVal == "")
    {
    $returnVal = 'showData("Updated","'.$updateCount.' reminders updated.");';
    }
if ($noUpdateCount == 1)
    {
    $returnVal .= "\n".'showData("Update Fail","1 reminder could not be updated as it had no repeat period.");';
    }
if ($noUpdateCount > 1)
    {
    $returnVal .= "\n".'showData("Update Fail","'.$noUpdateCount.' reminders could not be updated as they had no repeat period.");';
    }
return $returnVal;
?>