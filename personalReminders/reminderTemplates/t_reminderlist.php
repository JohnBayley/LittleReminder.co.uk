<table class='list'>
 <tr>
  <td class ="main" rowspan="2">
   <h3>Reminder Manager </h3>

	<table class="calendarholder">
	 <tr>
	  <td class="calendarholder">
		<table class="calendar">
		 <tr>
			<td class="year" colspan="7">
			    <span id='yearDisplay' ></span>
			</td>
		 </tr>
		 <tr>
		 	<td class="month"><a href="#" onclick="javascript:monthDn(1)"> title="Go to previous month"><img src="/images/leftarrow.png" border=0 ></a></td>
			<td class="month" colspan="5" ><span id='monthDisplay' ></span>FF</td>
			<td class="month"><img src="/images/rightarrow.png" onclick="monthUp(1)"></td>
		 </tr>
		 <tr>
			<td class="weekday" id='wd1'>Mo</td>
			<td class="weekday" id='wd2'>Tu</td>
			<td class="weekday" id='wd3'>We</td>
			<td class="weekday" id='wd4'>Th</td>
			<td class="weekday" id='wd5'>Fr</td>
			<td class="weekday" id='wd6'>Sa</td>
			<td class="weekday" id='wd7'>Su</td>
		 </tr>
		 <tr>
			<td class="date" id='d1'></td>
			<td class="date" id='d2'></td>
			<td class="date" id='d3'></td>
			<td class="date" id='d4'></td>
			<td class="date" id='d5'></td>
			<td class="date" id='d6'></td>
			<td class="date" id='d7'></td>
		 </tr>
		 <tr>
			<td class="date" id='d8'></td>
			<td class="date" id='d9'></td>
			<td class="date" id='d10'></td>
			<td class="date" id='d11'></td>
			<td class="date" id='d12'></td>
			<td class="date" id='d13'></td>
			<td class="date" id='d14'></td>
		 </tr>
		 <tr>
			<td class="date" id='d15'></td>
			<td class="date" id='d16'></td>
			<td class="date" id='d17'></td>
			<td class="date" id='d18'></td>
			<td class="date" id='d19'></td>
			<td class="date" id='d20'></td>
			<td class="date" id='d21'></td>
		 </tr>
		 <tr>
			<td class="date" id='d22'></td>
			<td class="date" id='d23'></td>
			<td class="date" id='d24'></td>
			<td class="date" id='d25'></td>
			<td class="date" id='d26'></td>
			<td class="date" id='d27'></td>
			<td class="date" id='d28'></td>
		 </tr>
		 <tr>
			<td class="date" id='d29'></td>
			<td class="date" id='d30'></td>
			<td class="date" id='d31'></td>
			<td class="date" id='d32'></td>
			<td class="date" id='d33'></td>
			<td class="date" id='d34'></td>
			<td class="date" id='d35'></td>
		 </tr>
		 <tr>
			<td class="date" id='d36'></td>
			<td class="date" id='d37'></td>
			<td class="date" id='d38'></td>
			<td class="date" id='d39'></td>
			<td class="date" id='d40'></td>
			<td class="date" id='d41'></td>
			<td class="date" id='d42'></td>
		 </tr>
		</table>
	  </td>
	 </tr>
	</table>
	<table>
	 <tr>
	  <td>
		<br>
		<form method='post' action='reminderAdd.php' enctype='multipart/form-data' name="reminderform" id='reminderorm' onSubmit='return checkform()'>
		<input name="reminderDate" id="reminderDate" class="rDate">
		<input name="reminderMonth" id="reminderMonth" class="rDate">
		<input name="reminderYear" id="reminderYear" class="rwDate">
		<input name="remindertype" id="reminderType"><br>
		<input type='image' src='/images/buttons.en/send.png' value='Send'>
	  </td>
	 </tr>
	</table>

  </td>
  <td class="notes">
	<table class="tightborderless">
		<tr>
			<td class=remindertop></td>
		</tr>
		<tr>
			<td class=reminderbody>{reminders}</td>
		</tr>
		<tr>
			<td class=reminderbottom>Found : {remindercount}</td>
		</tr>
	</table>
	<br>
</td>
</tr>
<tr>
  <td class="notes">
  <br>
  	<table class="tightborderless">
		<tr>
			<td class=remindertop></td>
		</tr>
		<tr>
			<td class=reminderbody>
			 	<div id="reminder1" class="reminder">MOT</div>
 				<div id="reminder2" class="reminder">Insurance</div>
				 <div id="reminder3" class="reminder">Tax</div>
				 <hr>
				 <div id="reminder4" class="reminder">Birthday</div>
				 <div id="reminder5" class="reminder">Anniversary</div>
			</td>
		</tr>
		<tr>
			<td class=reminderbottom></td>
		</tr>
	</table>
</td>
</tr>
</table>