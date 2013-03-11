<div  id="menu">
	<table>
		<tr>
			<td>
				<a href="javascript:yearDn()" id="imgLeft">&lt;</a>
			</td>


			<td>

				<a id="yearDisplay"></a>
			</td>
			<td>

				<a href="javascript:goToToday()" id="year">This Year</a>
			</td>			
			<td>
				<a href="javascript:yearUp()" id="imgRight">&gt;</a>
			</td>
		</tr>
	</table>
</div>




<div id="reminderList">
	<div id="currentRemindersHolderYear">
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
</div>
<div id="yearViewCalendar" class="ui-corner-all">


	<table>
		<tr class="dateRow" >
			<td colspan="7" class="monthHeader" id="monthHeader0"></td>
		
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader1"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader2"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader3"></td>
		</tr>
		<tr class="dayRow" >
			<td class="dayCell" id="month0day0"></td>
		
			<td class="dayCell" id="month0day1"></td>
			<td class="dayCell" id="month0day2"></td>
			<td class="dayCell" id="month0day3"></td>
			<td class="dayCell" id="month0day4"></td>
			<td class="dayCell" id="month0day5"></td>
			<td class="dayCell" id="month0day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month1day0"></td>
			<td class="dayCell" id="month1day1"></td>
		
			<td class="dayCell" id="month1day2"></td>
			<td class="dayCell" id="month1day3"></td>
			<td class="dayCell" id="month1day4"></td>
			<td class="dayCell" id="month1day5"></td>
			<td class="dayCell" id="month1day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month2day0"></td>
			<td class="dayCell" id="month2day1"></td>
			<td class="dayCell" id="month2day2"></td>
		
			<td class="dayCell" id="month2day3"></td>
			<td class="dayCell" id="month2day4"></td>
			<td class="dayCell" id="month2day5"></td>
			<td class="dayCell" id="month2day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month3day0"></td>
			<td class="dayCell" id="month3day1"></td>
			<td class="dayCell" id="month3day2"></td>
			<td class="dayCell" id="month3day3"></td>
		
			<td class="dayCell" id="month3day4"></td>
			<td class="dayCell" id="month3day5"></td>
			<td class="dayCell" id="month3day6"></td>
		</tr>
		<tr class="dateRow" >
			<td class="dateCell" id="month0date1"></td>
			<td class="dateCell" id="month0date2"></td>
			<td class="dateCell" id="month0date3"></td>
			<td class="dateCell" id="month0date4"></td>
		
			<td class="dateCell" id="month0date5"></td>
			<td class="dateCell" id="month0date6"></td>
			<td class="dateCell" id="month0date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month1date1"></td>
			<td class="dateCell" id="month1date2"></td>
			<td class="dateCell" id="month1date3"></td>
			<td class="dateCell" id="month1date4"></td>
			<td class="dateCell" id="month1date5"></td>
		
			<td class="dateCell" id="month1date6"></td>
			<td class="dateCell" id="month1date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month2date1"></td>
			<td class="dateCell" id="month2date2"></td>
			<td class="dateCell" id="month2date3"></td>
			<td class="dateCell" id="month2date4"></td>
			<td class="dateCell" id="month2date5"></td>
			<td class="dateCell" id="month2date6"></td>
		
			<td class="dateCell" id="month2date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month3date1"></td>
			<td class="dateCell" id="month3date2"></td>
			<td class="dateCell" id="month3date3"></td>
			<td class="dateCell" id="month3date4"></td>
			<td class="dateCell" id="month3date5"></td>
			<td class="dateCell" id="month3date6"></td>
			<td class="dateCell" id="month3date7"></td>

		</tr>
		<tr>
			<td class="dateCell" id="month0date8"></td>
			<td class="dateCell" id="month0date9"></td>
			<td class="dateCell" id="month0date10"></td>
			<td class="dateCell" id="month0date11"></td>
			<td class="dateCell" id="month0date12"></td>
			<td class="dateCell" id="month0date13"></td>
			<td class="dateCell" id="month0date14"></td>
		
			<td class="spacer"></td>
			<td class="dateCell" id="month1date8"></td>
			<td class="dateCell" id="month1date9"></td>
			<td class="dateCell" id="month1date10"></td>
			<td class="dateCell" id="month1date11"></td>
			<td class="dateCell" id="month1date12"></td>
			<td class="dateCell" id="month1date13"></td>
			<td class="dateCell" id="month1date14"></td>
			<td class="spacer"></td>
		
			<td class="dateCell" id="month2date8"></td>
			<td class="dateCell" id="month2date9"></td>
			<td class="dateCell" id="month2date10"></td>
			<td class="dateCell" id="month2date11"></td>
			<td class="dateCell" id="month2date12"></td>
			<td class="dateCell" id="month2date13"></td>
			<td class="dateCell" id="month2date14"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month3date8"></td>
		
			<td class="dateCell" id="month3date9"></td>
			<td class="dateCell" id="month3date10"></td>
			<td class="dateCell" id="month3date11"></td>
			<td class="dateCell" id="month3date12"></td>
			<td class="dateCell" id="month3date13"></td>
			<td class="dateCell" id="month3date14"></td>
		</tr>
		<tr>
			<td class="dateCell" id="month0date15"></td>
		
			<td class="dateCell" id="month0date16"></td>
			<td class="dateCell" id="month0date17"></td>
			<td class="dateCell" id="month0date18"></td>
			<td class="dateCell" id="month0date19"></td>
			<td class="dateCell" id="month0date20"></td>
			<td class="dateCell" id="month0date21"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month1date15"></td>
			<td class="dateCell" id="month1date16"></td>
		
			<td class="dateCell" id="month1date17"></td>
			<td class="dateCell" id="month1date18"></td>
			<td class="dateCell" id="month1date19"></td>
			<td class="dateCell" id="month1date20"></td>
			<td class="dateCell" id="month1date21"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month2date15"></td>
			<td class="dateCell" id="month2date16"></td>
			<td class="dateCell" id="month2date17"></td>
		
			<td class="dateCell" id="month2date18"></td>
			<td class="dateCell" id="month2date19"></td>
			<td class="dateCell" id="month2date20"></td>
			<td class="dateCell" id="month2date21"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month3date15"></td>
			<td class="dateCell" id="month3date16"></td>
			<td class="dateCell" id="month3date17"></td>
			<td class="dateCell" id="month3date18"></td>
		
			<td class="dateCell" id="month3date19"></td>
			<td class="dateCell" id="month3date20"></td>
			<td class="dateCell" id="month3date21"></td>
		</tr>
		<tr>
			<td class="dateCell" id="month0date22"></td>
			<td class="dateCell" id="month0date23"></td>
			<td class="dateCell" id="month0date24"></td>
			<td class="dateCell" id="month0date25"></td>
		
			<td class="dateCell" id="month0date26"></td>
			<td class="dateCell" id="month0date27"></td>
			<td class="dateCell" id="month0date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month1date22"></td>
			<td class="dateCell" id="month1date23"></td>
			<td class="dateCell" id="month1date24"></td>
			<td class="dateCell" id="month1date25"></td>
			<td class="dateCell" id="month1date26"></td>
		
			<td class="dateCell" id="month1date27"></td>
			<td class="dateCell" id="month1date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month2date22"></td>
			<td class="dateCell" id="month2date23"></td>
			<td class="dateCell" id="month2date24"></td>
			<td class="dateCell" id="month2date25"></td>
			<td class="dateCell" id="month2date26"></td>
			<td class="dateCell" id="month2date27"></td>

			<td class="dateCell" id="month2date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month3date22"></td>
			<td class="dateCell" id="month3date23"></td>
			<td class="dateCell" id="month3date24"></td>
			<td class="dateCell" id="month3date25"></td>
			<td class="dateCell" id="month3date26"></td>
			<td class="dateCell" id="month3date27"></td>
			<td class="dateCell" id="month3date28"></td>				
		</tr>

		
		<tr>
			<td class="dateCell" id="month0date29"></td>
			<td class="dateCell" id="month0date30"></td>
			<td class="dateCell" id="month0date31"></td>
			<td class="dateCell" id="month0date32"></td>
			<td class="dateCell" id="month0date33"></td>
			<td class="dateCell" id="month0date34"></td>
			<td class="dateCell" id="month0date35"></td>
			<td class="spacer"></td>

			<td class="dateCell" id="month1date29"></td>
			<td class="dateCell" id="month1date30"></td>
			<td class="dateCell" id="month1date31"></td>
			<td class="dateCell" id="month1date32"></td>
			<td class="dateCell" id="month1date33"></td>
			<td class="dateCell" id="month1date34"></td>
			<td class="dateCell" id="month1date35"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month2date29"></td>

			<td class="dateCell" id="month2date30"></td>
			<td class="dateCell" id="month2date31"></td>
			<td class="dateCell" id="month2date32"></td>
			<td class="dateCell" id="month2date33"></td>
			<td class="dateCell" id="month2date34"></td>
			<td class="dateCell" id="month2date35"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month3date29"></td>
			<td class="dateCell" id="month3date30"></td>

			<td class="dateCell" id="month3date31"></td>
			<td class="dateCell" id="month3date32"></td>
			<td class="dateCell" id="month3date33"></td>
			<td class="dateCell" id="month3date34"></td>
			<td class="dateCell" id="month3date35"></td>			
		</tr>
		<tr>
			<td class="dateExtra" id="month0date36"></td>
			<td class="dateExtra" id="month0date37"></td>

			<td class="dateExtra" id="month0date38"></td>
			<td class="dateExtra" id="month0date39"></td>
			<td class="dateExtra" id="month0date40"></td>
			<td class="dateExtra" id="month0date41"></td>
			<td class="dateExtra" id="month0date42"></td>
			<td class="spacer"></td>
			<td class="dateExtra" id="month1date36"></td>
			<td class="dateExtra" id="month1date37"></td>
			<td class="dateExtra" id="month1date38"></td>

			<td class="dateExtra" id="month1date39"></td>
			<td class="dateExtra" id="month1date40"></td>
			<td class="dateExtra" id="month1date41"></td>
			<td class="dateExtra" id="month1date42"></td>
			<td class="spacer"></td>
			<td class="dateExtra" id="month2date36"></td>
			<td class="dateExtra" id="month2date37"></td>
			<td class="dateExtra" id="month2date38"></td>
			<td class="dateExtra" id="month2date39"></td>

			<td class="dateExtra" id="month2date40"></td>
			<td class="dateExtra" id="month2date41"></td>
			<td class="dateExtra" id="month2date42"></td>
			<td class="spacer"></td>
			<td class="dateExtra" id="month3date36"></td>
			<td class="dateExtra" id="month3date37"></td>
			<td class="dateExtra" id="month3date38"></td>
			<td class="dateExtra" id="month3date39"></td>
			<td class="dateExtra" id="month3date40"></td>

			<td class="dateExtra" id="month3date41"></td>
			<td class="dateExtra" id="month3date42"></td>			
		</tr>	
	</table>
	
	<table>
		<tr>
			<td colspan="7" class="monthHeader" id="monthHeader4"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader5"></td>
			<td class="spacer"></td>

			<td colspan="7" class="monthHeader" id="monthHeader6"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader7"></td>
		</tr>
		<tr class="dayRow" >
			<td class="dayCell" id="month4day0"></td>
			<td class="dayCell" id="month4day1"></td>
			<td class="dayCell" id="month4day2"></td>
			<td class="dayCell" id="month4day3"></td>

			<td class="dayCell" id="month4day4"></td>
			<td class="dayCell" id="month4day5"></td>
			<td class="dayCell" id="month4day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month5day0"></td>
			<td class="dayCell" id="month5day1"></td>
			<td class="dayCell" id="month5day2"></td>
			<td class="dayCell" id="month5day3"></td>
			<td class="dayCell" id="month5day4"></td>

			<td class="dayCell" id="month5day5"></td>
			<td class="dayCell" id="month5day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month6day0"></td>
			<td class="dayCell" id="month6day1"></td>
			<td class="dayCell" id="month6day2"></td>
			<td class="dayCell" id="month6day3"></td>
			<td class="dayCell" id="month6day4"></td>
			<td class="dayCell" id="month6day5"></td>

			<td class="dayCell" id="month6day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month7day0"></td>
			<td class="dayCell" id="month7day1"></td>
			<td class="dayCell" id="month7day2"></td>
			<td class="dayCell" id="month7day3"></td>
			<td class="dayCell" id="month7day4"></td>
			<td class="dayCell" id="month7day5"></td>
			<td class="dayCell" id="month7day6"></td>

		</tr>			
		<tr>
			<td class="dateCell" id="month4date1"></td>
			<td class="dateCell" id="month4date2"></td>
			<td class="dateCell" id="month4date3"></td>
			<td class="dateCell" id="month4date4"></td>
			<td class="dateCell" id="month4date5"></td>
			<td class="dateCell" id="month4date6"></td>
			<td class="dateCell" id="month4date7"></td>

			<td class="spacer"></td>
			<td class="dateCell" id="month5date1"></td>
			<td class="dateCell" id="month5date2"></td>
			<td class="dateCell" id="month5date3"></td>
			<td class="dateCell" id="month5date4"></td>
			<td class="dateCell" id="month5date5"></td>
			<td class="dateCell" id="month5date6"></td>
			<td class="dateCell" id="month5date7"></td>
			<td class="spacer"></td>

			<td class="dateCell" id="month6date1"></td>
			<td class="dateCell" id="month6date2"></td>
			<td class="dateCell" id="month6date3"></td>
			<td class="dateCell" id="month6date4"></td>
			<td class="dateCell" id="month6date5"></td>
			<td class="dateCell" id="month6date6"></td>
			<td class="dateCell" id="month6date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month7date1"></td>

			<td class="dateCell" id="month7date2"></td>
			<td class="dateCell" id="month7date3"></td>
			<td class="dateCell" id="month7date4"></td>
			<td class="dateCell" id="month7date5"></td>
			<td class="dateCell" id="month7date6"></td>
			<td class="dateCell" id="month7date7"></td>
		</tr>			
		
		<tr>
			<td class="dateCell" id="month4date8"></td>

			<td class="dateCell" id="month4date9"></td>
			<td class="dateCell" id="month4date10"></td>
			<td class="dateCell" id="month4date11"></td>
			<td class="dateCell" id="month4date12"></td>
			<td class="dateCell" id="month4date13"></td>
			<td class="dateCell" id="month4date14"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month5date8"></td>
			<td class="dateCell" id="month5date9"></td>

			<td class="dateCell" id="month5date10"></td>
			<td class="dateCell" id="month5date11"></td>
			<td class="dateCell" id="month5date12"></td>
			<td class="dateCell" id="month5date13"></td>
			<td class="dateCell" id="month5date14"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month6date8"></td>
			<td class="dateCell" id="month6date9"></td>
			<td class="dateCell" id="month6date10"></td>

			<td class="dateCell" id="month6date11"></td>
			<td class="dateCell" id="month6date12"></td>
			<td class="dateCell" id="month6date13"></td>
			<td class="dateCell" id="month6date14"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month7date8"></td>
			<td class="dateCell" id="month7date9"></td>
			<td class="dateCell" id="month7date10"></td>
			<td class="dateCell" id="month7date11"></td>

			<td class="dateCell" id="month7date12"></td>
			<td class="dateCell" id="month7date13"></td>
			<td class="dateCell" id="month7date14"></td>		
		</tr>
		
		<tr>
			<td class="dateCell" id="month4date15"></td>
			<td class="dateCell" id="month4date16"></td>
			<td class="dateCell" id="month4date17"></td>
			<td class="dateCell" id="month4date18"></td>

			<td class="dateCell" id="month4date19"></td>
			<td class="dateCell" id="month4date20"></td>
			<td class="dateCell" id="month4date21"></td>			
			<td class="spacer"></td>
			<td class="dateCell" id="month5date15"></td>
			<td class="dateCell" id="month5date16"></td>
			<td class="dateCell" id="month5date17"></td>
			<td class="dateCell" id="month5date18"></td>
			<td class="dateCell" id="month5date19"></td>

			<td class="dateCell" id="month5date20"></td>
			<td class="dateCell" id="month5date21"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month6date15"></td>
			<td class="dateCell" id="month6date16"></td>
			<td class="dateCell" id="month6date17"></td>
			<td class="dateCell" id="month6date18"></td>
			<td class="dateCell" id="month6date19"></td>
			<td class="dateCell" id="month6date20"></td>

			<td class="dateCell" id="month6date21"></td>			
			<td class="spacer"></td>
			<td class="dateCell" id="month7date15"></td>
			<td class="dateCell" id="month7date16"></td>
			<td class="dateCell" id="month7date17"></td>
			<td class="dateCell" id="month7date18"></td>
			<td class="dateCell" id="month7date19"></td>
			<td class="dateCell" id="month7date20"></td>
			<td class="dateCell" id="month7date21"></td>			
		</tr>

		
		<tr>
			<td class="dateCell" id="month4date22"></td>
			<td class="dateCell" id="month4date23"></td>
			<td class="dateCell" id="month4date24"></td>
			<td class="dateCell" id="month4date25"></td>
			<td class="dateCell" id="month4date26"></td>
			<td class="dateCell" id="month4date27"></td>
			<td class="dateCell" id="month4date28"></td>
			<td class="spacer"></td>

			<td class="dateCell" id="month5date22"></td>
			<td class="dateCell" id="month5date23"></td>
			<td class="dateCell" id="month5date24"></td>
			<td class="dateCell" id="month5date25"></td>
			<td class="dateCell" id="month5date26"></td>
			<td class="dateCell" id="month5date27"></td>
			<td class="dateCell" id="month5date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month6date22"></td>

			<td class="dateCell" id="month6date23"></td>
			<td class="dateCell" id="month6date24"></td>
			<td class="dateCell" id="month6date25"></td>
			<td class="dateCell" id="month6date26"></td>
			<td class="dateCell" id="month6date27"></td>
			<td class="dateCell" id="month6date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month7date22"></td>
			<td class="dateCell" id="month7date23"></td>

			<td class="dateCell" id="month7date24"></td>
			<td class="dateCell" id="month7date25"></td>
			<td class="dateCell" id="month7date26"></td>
			<td class="dateCell" id="month7date27"></td>
			<td class="dateCell" id="month7date28"></td>			
		</tr>
		
		<tr>
			<td class="dateCell" id="month4date29"></td>
			<td class="dateCell" id="month4date30"></td>

			<td class="dateCell" id="month4date31"></td>
			<td class="dateCell" id="month4date32"></td>
			<td class="dateCell" id="month4date33"></td>
			<td class="dateCell" id="month4date34"></td>
			<td class="dateCell" id="month4date35"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month5date29"></td>
			<td class="dateCell" id="month5date30"></td>
			<td class="dateCell" id="month5date31"></td>

			<td class="dateCell" id="month5date32"></td>
			<td class="dateCell" id="month5date33"></td>
			<td class="dateCell" id="month5date34"></td>
			<td class="dateCell" id="month5date35"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month6date29"></td>
			<td class="dateCell" id="month6date30"></td>
			<td class="dateCell" id="month6date31"></td>
			<td class="dateCell" id="month6date32"></td>

			<td class="dateCell" id="month6date33"></td>
			<td class="dateCell" id="month6date34"></td>
			<td class="dateCell" id="month6date35"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month7date29"></td>
			<td class="dateCell" id="month7date30"></td>
			<td class="dateCell" id="month7date31"></td>
			<td class="dateCell" id="month7date32"></td>
			<td class="dateCell" id="month7date33"></td>

			<td class="dateCell" id="month7date34"></td>
			<td class="dateCell" id="month7date35"></td>		
		</tr>
		<tr>
			<td class="dateExtra" id="month4date36"></td>
			<td class="dateExtra" id="month4date37"></td>
			<td class="dateExtra" id="month4date38"></td>
			<td class="dateExtra" id="month4date39"></td>
			<td class="dateExtra" id="month4date40"></td>

			<td class="dateExtra" id="month4date41"></td>
			<td class="dateExtra" id="month4date42"></td>
			<td class="spacer"></td>
			<td class="dateExtra" id="month5date36"></td>
			<td class="dateExtra" id="month5date37"></td>
			<td class="dateExtra" id="month5date38"></td>
			<td class="dateExtra" id="month5date39"></td>
			<td class="dateExtra" id="month5date40"></td>
			<td class="dateExtra" id="month5date41"></td>

			<td class="dateExtra" id="month5date42"></td>	
			<td class="spacer"></td>
			<td class="dateExtra" id="month6date36"></td>
			<td class="dateExtra" id="month6date37"></td>
			<td class="dateExtra" id="month6date38"></td>
			<td class="dateExtra" id="month6date39"></td>
			<td class="dateExtra" id="month6date40"></td>
			<td class="dateExtra" id="month6date41"></td>
			<td class="dateExtra" id="month6date42"></td>

			<td class="spacer"></td>
			<td class="dateExtra" id="month7date36"></td>
			<td class="dateExtra" id="month7date37"></td>
			<td class="dateExtra" id="month7date38"></td>
			<td class="dateExtra" id="month7date39"></td>
			<td class="dateExtra" id="month7date40"></td>
			<td class="dateExtra" id="month7date41"></td>
			<td class="dateExtra" id="month7date42"></td>		
		</tr>		
	</table>

	
	
	<table>
		<tr>
			<td colspan="7" class="monthHeader" id="monthHeader8"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader9"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader10"></td>
			<td class="spacer"></td>
			<td colspan="7" class="monthHeader" id="monthHeader11"></td>

		</tr>
		<tr class="dayRow" >
			<td class="dayCell" id="month8day0"></td>
			<td class="dayCell" id="month8day1"></td>
			<td class="dayCell" id="month8day2"></td>
			<td class="dayCell" id="month8day3"></td>
			<td class="dayCell" id="month8day4"></td>
			<td class="dayCell" id="month8day5"></td>
			<td class="dayCell" id="month8day6"></td>

			<td class="spacer"></td>
			<td class="dayCell" id="month9day0"></td>
			<td class="dayCell" id="month9day1"></td>
			<td class="dayCell" id="month9day2"></td>
			<td class="dayCell" id="month9day3"></td>
			<td class="dayCell" id="month9day4"></td>
			<td class="dayCell" id="month9day5"></td>
			<td class="dayCell" id="month9day6"></td>
			<td class="spacer"></td>

			<td class="dayCell" id="month10day0"></td>
			<td class="dayCell" id="month10day1"></td>
			<td class="dayCell" id="month10day2"></td>
			<td class="dayCell" id="month10day3"></td>
			<td class="dayCell" id="month10day4"></td>
			<td class="dayCell" id="month10day5"></td>
			<td class="dayCell" id="month10day6"></td>
			<td class="spacer"></td>
			<td class="dayCell" id="month11day0"></td>

			<td class="dayCell" id="month11day1"></td>
			<td class="dayCell" id="month11day2"></td>
			<td class="dayCell" id="month11day3"></td>
			<td class="dayCell" id="month11day4"></td>
			<td class="dayCell" id="month11day5"></td>
			<td class="dayCell" id="month11day6"></td>
		</tr>			
		<tr>
			<td class="dateCell" id="month8date1"></td>

			<td class="dateCell" id="month8date2"></td>
			<td class="dateCell" id="month8date3"></td>
			<td class="dateCell" id="month8date4"></td>
			<td class="dateCell" id="month8date5"></td>
			<td class="dateCell" id="month8date6"></td>
			<td class="dateCell" id="month8date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month9date1"></td>
			<td class="dateCell" id="month9date2"></td>

			<td class="dateCell" id="month9date3"></td>
			<td class="dateCell" id="month9date4"></td>
			<td class="dateCell" id="month9date5"></td>
			<td class="dateCell" id="month9date6"></td>
			<td class="dateCell" id="month9date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month10date1"></td>
			<td class="dateCell" id="month10date2"></td>
			<td class="dateCell" id="month10date3"></td>

			<td class="dateCell" id="month10date4"></td>
			<td class="dateCell" id="month10date5"></td>
			<td class="dateCell" id="month10date6"></td>
			<td class="dateCell" id="month10date7"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month11date1"></td>
			<td class="dateCell" id="month11date2"></td>
			<td class="dateCell" id="month11date3"></td>
			<td class="dateCell" id="month11date4"></td>

			<td class="dateCell" id="month11date5"></td>
			<td class="dateCell" id="month11date6"></td>
			<td class="dateCell" id="month11date7"></td>
		</tr>			
		
		<tr>
			<td class="dateCell" id="month8date8"></td>
			<td class="dateCell" id="month8date9"></td>
			<td class="dateCell" id="month8date10"></td>
			<td class="dateCell" id="month8date11"></td>

			<td class="dateCell" id="month8date12"></td>
			<td class="dateCell" id="month8date13"></td>
			<td class="dateCell" id="month8date14"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month9date8"></td>
			<td class="dateCell" id="month9date9"></td>
			<td class="dateCell" id="month9date10"></td>
			<td class="dateCell" id="month9date11"></td>
			<td class="dateCell" id="month9date12"></td>

			<td class="dateCell" id="month9date13"></td>
			<td class="dateCell" id="month9date14"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month10date8"></td>
			<td class="dateCell" id="month10date9"></td>
			<td class="dateCell" id="month10date10"></td>
			<td class="dateCell" id="month10date11"></td>
			<td class="dateCell" id="month10date12"></td>
			<td class="dateCell" id="month10date13"></td>

			<td class="dateCell" id="month10date14"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month11date8"></td>
			<td class="dateCell" id="month11date9"></td>
			<td class="dateCell" id="month11date10"></td>
			<td class="dateCell" id="month11date11"></td>
			<td class="dateCell" id="month11date12"></td>
			<td class="dateCell" id="month11date13"></td>
			<td class="dateCell" id="month11date14"></td>		
		</tr>

		
		<tr>
			<td class="dateCell" id="month8date15"></td>
			<td class="dateCell" id="month8date16"></td>
			<td class="dateCell" id="month8date17"></td>
			<td class="dateCell" id="month8date18"></td>
			<td class="dateCell" id="month8date19"></td>
			<td class="dateCell" id="month8date20"></td>
			<td class="dateCell" id="month8date21"></td>			
			<td class="spacer"></td>

			<td class="dateCell" id="month9date15"></td>
			<td class="dateCell" id="month9date16"></td>
			<td class="dateCell" id="month9date17"></td>
			<td class="dateCell" id="month9date18"></td>
			<td class="dateCell" id="month9date19"></td>
			<td class="dateCell" id="month9date20"></td>
			<td class="dateCell" id="month9date21"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month10date15"></td>

			<td class="dateCell" id="month10date16"></td>
			<td class="dateCell" id="month10date17"></td>
			<td class="dateCell" id="month10date18"></td>
			<td class="dateCell" id="month10date19"></td>
			<td class="dateCell" id="month10date20"></td>
			<td class="dateCell" id="month10date21"></td>			
			<td class="spacer"></td>
			<td class="dateCell" id="month11date15"></td>
			<td class="dateCell" id="month11date16"></td>

			<td class="dateCell" id="month11date17"></td>
			<td class="dateCell" id="month11date18"></td>
			<td class="dateCell" id="month11date19"></td>
			<td class="dateCell" id="month11date20"></td>
			<td class="dateCell" id="month11date21"></td>			
		</tr>
		
		<tr>
			<td class="dateCell" id="month8date22"></td>
			<td class="dateCell" id="month8date23"></td>

			<td class="dateCell" id="month8date24"></td>
			<td class="dateCell" id="month8date25"></td>
			<td class="dateCell" id="month8date26"></td>
			<td class="dateCell" id="month8date27"></td>
			<td class="dateCell" id="month8date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month9date22"></td>
			<td class="dateCell" id="month9date23"></td>
			<td class="dateCell" id="month9date24"></td>

			<td class="dateCell" id="month9date25"></td>
			<td class="dateCell" id="month9date26"></td>
			<td class="dateCell" id="month9date27"></td>
			<td class="dateCell" id="month9date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month10date22"></td>
			<td class="dateCell" id="month10date23"></td>
			<td class="dateCell" id="month10date24"></td>
			<td class="dateCell" id="month10date25"></td>

			<td class="dateCell" id="month10date26"></td>
			<td class="dateCell" id="month10date27"></td>
			<td class="dateCell" id="month10date28"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month11date22"></td>
			<td class="dateCell" id="month11date23"></td>
			<td class="dateCell" id="month11date24"></td>
			<td class="dateCell" id="month11date25"></td>
			<td class="dateCell" id="month11date26"></td>

			<td class="dateCell" id="month11date27"></td>
			<td class="dateCell" id="month11date28"></td>			
		</tr>
		
		<tr>
			<td class="dateCell" id="month8date29"></td>
			<td class="dateCell" id="month8date30"></td>
			<td class="dateCell" id="month8date31"></td>
			<td class="dateCell" id="month8date32"></td>
			<td class="dateCell" id="month8date33"></td>

			<td class="dateCell" id="month8date34"></td>
			<td class="dateCell" id="month8date35"></td>
			<td class="spacer"></td>
			<td class="dateCell" id="month9date29"></td>
			<td class="dateCell" id="month9date30"></td>
			<td class="dateCell" id="month9date31"></td>
			<td class="dateCell" id="month9date32"></td>
			<td class="dateCell" id="month9date33"></td>
			<td class="dateCell" id="month9date34"></td>

			<td class="dateCell" id="month9date35"></td>	
			<td class="spacer"></td>
			<td class="dateCell" id="month10date29"></td>
			<td class="dateCell" id="month10date30"></td>
			<td class="dateCell" id="month10date31"></td>
			<td class="dateCell" id="month10date32"></td>
			<td class="dateCell" id="month10date33"></td>
			<td class="dateCell" id="month10date34"></td>
			<td class="dateCell" id="month10date35"></td>

			<td class="spacer"></td>
			<td class="dateCell" id="month11date29"></td>
			<td class="dateCell" id="month11date30"></td>
			<td class="dateCell" id="month11date31"></td>
			<td class="dateCell" id="month11date32"></td>
			<td class="dateCell" id="month11date33"></td>
			<td class="dateCell" id="month11date34"></td>
			<td class="dateCell" id="month11date35"></td>		
		</tr>

		<tr>
			<td class="dateExtra" id="month8date36"></td>
			<td class="dateExtra" id="month8date37"></td>
			<td class="dateExtra" id="month8date38"></td>
			<td class="dateExtra" id="month8date39"></td>
			<td class="dateExtra" id="month8date40"></td>
			<td class="dateExtra" id="month8date41"></td>
			<td class="dateExtra" id="month8date42"></td>
			<td class="spacer"></td>

			<td class="dateExtra" id="month9date36"></td>
			<td class="dateExtra" id="month9date37"></td>
			<td class="dateExtra" id="month9date38"></td>
			<td class="dateExtra" id="month9date39"></td>
			<td class="dateExtra" id="month9date40"></td>
			<td class="dateExtra" id="month9date41"></td>
			<td class="dateExtra" id="month9date42"></td>	
			<td class="spacer"></td>
			<td class="dateExtra" id="month10date36"></td>

			<td class="dateExtra" id="month10date37"></td>
			<td class="dateExtra" id="month10date38"></td>
			<td class="dateExtra" id="month10date39"></td>
			<td class="dateExtra" id="month10date40"></td>
			<td class="dateExtra" id="month10date41"></td>
			<td class="dateExtra" id="month10date42"></td>
			<td class="spacer"></td>
			<td class="dateExtra" id="month11date36"></td>
			<td class="dateExtra" id="month11date37"></td>

			<td class="dateExtra" id="month11date38"></td>
			<td class="dateExtra" id="month11date39"></td>
			<td class="dateExtra" id="month11date40"></td>
			<td class="dateExtra" id="month11date41"></td>
			<td class="dateExtra" id="month11date42"></td>		
		</tr>		
	</table>
</div>