<?php
/* Load common configuration */
include('common.php');

/* Test for the security flag */
secureCheck();
	
	$sql = "SELECT * FROM reminders r JOIN users u ON r.userid = u.userid";
		
	$result = mysql_query($sql);
	$count = 0; 
	print("<div id='listRem'><table>");
	print ("<tr>");
	print ("<th>RemId</td>");
	print ("<th>UserId</td>");
	print ("<th>Username</td>");
	print ("<th>e-mail address</td>");
	print ("<th>Reminder Date</td>");
	print ("<th>Description</td>");
	print ("<th>Period</td>");
	print ("<th>Parent</td>");
	print ("</tr>");	
				
	while($row = mysql_fetch_assoc($result))
		{

		print ("<tr>");
		print ("<td>".$row['reminderid']. "</td>");
		print ("<td>".$row['userid']. "</td>");
		print ("<td>".$row['username']. "</td>");
		print ("<td>".$row['email']. "</td>");
		print ("<td>".$row['reminder_date']. "</td>");
		print ("<td>".$row['description']."</td>");
		print ("<td>".$row['period']."</td>");
		print ("<td>".$row['parentid']."</td>");
		print ("</tr>");
		}
	
	print("</table></div>");

?>