<!-- navigation -->
<div  id="menu">
	<table>
		<tr>
			<td>
				<a href="javascript:prevMonth()">
					<span class="dateNavigation" id="prevMonth">&lt;Previous</span>
				</a>
			</td>
			<td>
				<a href="javascript:listMonths()">
					<span class="dateNavigation" id="currentMonth">October</span>
					<span class="dateNavigation" id="currentYear">2012</span>
				</a>
			</td>
			<td>
				<a href="javascript:nextMonth()">
					<span class="dateNavigation" id="nextMonth">Next&gt;</span>
				</a>
			</td>
		</tr>
	</table>
</div>
<div id="listTableHolder">
	<table class="monthlist shadow" id="monthListTable">
	 <tr>
	  <td id="monthlist0"></td>
	 </tr>
	 <tr>
	  <td id="monthlist1"></td>
	 </tr>
	 <tr>
	  <td id="monthlist2"></td>
	 </tr>
	 <tr>
	  <td id="monthlist3"></td>
	 </tr>
	  <tr>
	  <td id="monthlist4"></td>
	 </tr>
	  <tr>
	  <td id="monthlist5"></td>
	 </tr>
	  <tr>
	  <td id="monthlist6"></td>
	 </tr>
	  <tr>
	  <td id="monthlist7"></td>
	 </tr>
	  <tr>
	  <td id="monthlist8"></td>
	 </tr>
	  <tr>
	  <td id="monthlist9"></td>
	 </tr>
	  <tr>
	  <td id="monthlist10"></td>
	 </tr>
	  <tr>
	  <td id="monthlist11"></td>
	 </tr>
	</table>

<table class="yearlist shadow" id="yearListTable">
 <tr>
  <td id="yearlist0"></td>
 </tr>
 <tr>
  <td id="yearlist1"></td>
 </tr>
 <tr>
  <td id="yearlist2"></td>
 </tr>
 <tr>
  <td id="yearlist3"></td>
 </tr>
 <tr>
  <td id="yearlist4"></td>
 </tr>
 <tr>
  <td id="yearlist5"></td>
 </tr>
 <tr>
  <td id="yearlist6"></td>
 </tr>
 <tr>
  <td id="yearlist7"></td>
 </tr>
</table>
</div>
<div id="wrap">
	<div id="reminderList">
		<div id="currentRemindersHolder">
			<div id="currentRemindersHead"></div>
			<div id="currentReminders"></div>
			<div id="currentReminderTools" class="ui-corner-all"><a href="javascript:showTools()"><img src="/images/fam/calendar_edit.png" alt="x" /> Reminder Options</a></div>
			<div id="currentReminderToolsHolder" class="ui-corner-all">
			    <fieldset class="ui-corner-all"><legend class="ui-corner-all">Show Reminders</legend>
			    <input type="checkbox" id="activeReminder" name="activeReminder">
			    <label for="activeReminder">Active Reminders</label><br />
			    <input type="checkbox" id="archivedReminder" name="archivedReminder">
			    <label for="archivedReminder">Archived Reminders</label><br />
			    <input type="checkbox" id="disabledReminder" name="disabledReminder">
			    <label for="disabledReminder">Disabled Reminders</label><br />
			    <input type="checkbox" id="expiredReminder" name="expiredReminder">
			    <label for="expiredReminder">Expired Reminders</label>
			    </fieldset>
			    <br />
			    <a href="javascript:hideTools()"><img src="/images/fam/cancel.png" alt="x" /> Close</a> &nbsp;&nbsp;
			    <a href="javascript:hideTools()"><img src="/images/fam/arrow_refresh.png" alt="Go" /> Refresh</a>
			</div>
			<div class="remindersBottom"></div>
		</div>
		<div id="quickRemindersHolder">
			<div id="quickRemindersHead"></div>
			<div id="quickReminders">
				<div id="birthday" class="ui-corner-all draggable reminderPortlet toolLinkQR" title="Drag me to the calendar to create a new Birthday Reminder">Birthday</div>
				<div id="anniversary" class="ui-corner-all draggable reminderPortlet toolLinkQR" title="Drag me to the calendar to create a new Anniversary Reminder">Anniversary</div>
				<div id="mot" class="ui-corner-all draggable reminderPortlet toolLinkQR" title="Drag me to the calendar to create a new MOT Reminder">MOT</div>
				<div id="tax" class="ui-corner-all draggable reminderPortlet toolLinkQR" title="Drag me to the calendar to create a new TAX Reminder">TAX</div>
				<div id="custom" class="ui-corner-all draggable reminderPortlet toolLinkQR" title="Drag me to the calendar to create a new custom Reminder">Custom</div>

			</div>
			<div class="remindersBottom"></div>
		</div>
	</div>
	<div id="calendarHolder" class="ui-corner-all">
		<img class="monthVertical" id="monthVertical" src="/images/calendar/october.png" alt="currentMonth" />
		<table id="calendarMain">
			<tr>
				<th class="day" id="day1"></th>
				<th class="day" id="day2"></th>
				<th class="day" id="day3"></th>
				<th class="day" id="day4"></th>
				<th class="day" id="day5"></th>
				<th class="day" id="day6"></th>
				<th class="day" id="day7"></th>
			</tr>
			<tr>
				<td class= "dateBox" id="d1"></td>
				<td class= "dateBox" id="d2"></td>
				<td class= "dateBox" id="d3"></td>
				<td class= "dateBox" id="d4"></td>
				<td class= "dateBox" id="d5"></td>
				<td class= "dateBox" id="d6"></td>
				<td class= "dateBox" id="d7"></td>
			</tr>
			<tr>
				<td class= "dateBox" id="d8"></td>
				<td class= "dateBox" id="d9"></td>
				<td class= "dateBox" id="d10"></td>
				<td class= "dateBox" id="d11"></td>
				<td class= "dateBox" id="d12"></td>
				<td class= "dateBox" id="d13"></td>
				<td class= "dateBox" id="d14"></td>
			</tr>
			<tr>
				<td class= "dateBox" id="d15"></td>
				<td class= "dateBox" id="d16"></td>
				<td class= "dateBox" id="d17"></td>
				<td class= "dateBox" id="d18"></td>
				<td class= "dateBox" id="d19"></td>
				<td class= "dateBox" id="d20"></td>
				<td class= "dateBox" id="d21"></td>
			</tr>
			<tr>
				<td class= "dateBox" id="d22"></td>
				<td class= "dateBox" id="d23"></td>
				<td class= "dateBox" id="d24"></td>
				<td class= "dateBox" id="d25"></td>
				<td class= "dateBox" id="d26"></td>
				<td class= "dateBox" id="d27"></td>
				<td class= "dateBox" id="d28"></td>
			</tr>
			<tr>
				<td class= "dateBox" id="d29"></td>
				<td class= "dateBox" id="d30"></td>
				<td class= "dateBox" id="d31"></td>
				<td class= "dateBox" id="d32"></td>
				<td class= "dateBox" id="d33"></td>
				<td class= "dateBox" id="d34"></td>
				<td class= "dateBox" id="d35"></td>
			</tr>
			<tr>
				<td class= "dateBox" id="d36"></td>
				<td class= "dateBox" id="d37"></td>
				<td class= "dateBox" id="d38"></td>
				<td><a href="/personalReminders/reminderCreator.php" class="rmEdit" id="rmCreateLink">New Reminder</a></td>
				<td class="rmTool" id="clip" title="Drop reminders here to store them while you change date">Clipboard</td>
				<td class="rmTool" id="edit" title="Drag and drop a reminder here to popup the edit window.">Drag here to edit</td>
				<td class="rmTool" id="wpb" title="Drop reminders here to delete">
					<img src="/images/trashcan.gif" alt="Drop reminders here to delete" />
				</td>
			</tr>
		</table>
	</div>
</div>

<div style="display:none;">
<a href="/personalReminders/reminderEditor.php" class="rmEdit" id="rmEditLink">Edit Reminder</a>
</div>