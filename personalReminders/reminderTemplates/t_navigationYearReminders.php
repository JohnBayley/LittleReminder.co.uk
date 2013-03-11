<ul>	  

	 
	 

<?php 
	include('common.php');


	
	
		 	
			  		
		
		
	if (isset ($_SESSION["username"]))
	  	{	
		print ('<li><a href="javascript:goToToday()" title="Jump to Today">Jump to Today</a> </li>');

		print ('<li id="imgLeft"><a href="javascript:yearDn();"><img class="navImg" src="/images/leftArrow.gif"></a></li>');
		print ('<li id="display"><a href="javascript:yearPopup()" id="yearDisplay"  title="Select Year"></a></li>');
		print ('<li id="imgRight"><a href="javascript:yearUp();"><img class="navImg" src="/images/rightArrow.gif"></li>');



		print ('<li><a href="javascript:createNew()" title="Create a new Reminder">Create a New Reminder</a> </li>');

		print (' <li><a href="javascript:showPlan()" title="My Reminder Execution Plan">My Reminder Plan</a> </li>');

		print (' <li><a href="homepage.php" title="Month View">Month View</a> </li>');	
		}
	  	
?>
	   
	   


 
	 </ul>
	 
	 <script language='JavaScript' type='Text/javascript'>
	 		var adminOpt = '';
			var la = '<p>';
			var lb = '<a href="/homepage.php">My Reminders</a> | '; 
				
			var lc= '	<?php
	if (isset ($_SESSION["username"]))
	  	{
	  	print ('<a href="/logoff.php">Log Out</a> | '); 	
	  	}




	   ?>
	   		';					
			var ld = '<a href="/useredit.php">My Account</a> | ';
			var le = '<a href="/help.html">Help</a>';		
			var lf = '</p>';
	<?php
			if (isset ($_SESSION["admin"]))
				{
				if ($_SESSION['admin'] ==1)
					{
					print ('adminOpt = "<p><a href=\"useradmin.php\">User Administration</a></p>";');

					}
				}
	   ?>
			
	 document.getElementById("header-links").innerHTML = la +lc + lb + ld + le + lf + adminOpt;
	 
	 </script>