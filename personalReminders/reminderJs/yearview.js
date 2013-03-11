var myMonths = ["January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December"];
var myMonthslc = ["january", "february", "march", "april", "may", "june",
			"july", "august", "september", "october", "november", "december"];
var myShortMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
			"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var myShortMonthslc = ["jan", "feb", "mar", "apr", "may", "jun",
			"jul", "aug", "sep", "oct", "nov", "dec"];
var myDays= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
var myShortDays= ["Mo","Tu","We","Th","Fr","Sa","Su"];
var reminders = [];	// Hold the reminders
var datCurrentDate = new Date; //Date start point
var endDate = new Date;	// Date end point
var datTodaysDate = new Date; // Todays date
var intMonthOffset; // Month offset
var intYear = datTodaysDate.getFullYear(); // Selected Year to start from

var intMonth = datTodaysDate.getMonth() - 1;	//Selected Month to start from
	

function initialise(){

	/* Calculate the start month (current - 1)*/
	intMonthOffset = (12 - intMonth);
	var intPreviousMonth = 99;
	
	/*Build the current date object*/
	datCurrentDate.setDate(1);
	datCurrentDate.setMonth(intMonth);
	datCurrentDate.setFullYear(intYear);
	/* Build the end date one year on */
	endDate.setDate(1);
	endDate.setMonth(intMonth);
	endDate.setFullYear(datCurrentDate.getFullYear()+1);
	endDate.setDate(1);
	document.getElementById("yearDisplay").innerHTML = "";
	/* Loop through the display 12 months and draw the plan */
	while (datCurrentDate< endDate)
		{
		
		/*Test for new month */
		if (datCurrentDate.getMonth() != intPreviousMonth)
			{
			/* Clear all previous cell data */
			for (var x = 1; x<=42; x++)
				{
				clrElid = "month" + (( datCurrentDate.getMonth() + intMonthOffset ) % 12) + "date" + x;
				document.getElementById(clrElid).innerHTML = "";
				document.getElementById(clrElid).className = "dateExtra";
				}
			/* Create the month jump controls and its title */
			elid = "monthHeader" + (( datCurrentDate.getMonth() + intMonthOffset) % 12);
			document.getElementById(elid).onclick = function(){	jumpMonthHead(this);	};
			document.getElementById(elid).innerHTML =  myMonths[datCurrentDate.getMonth()] + " " +datCurrentDate.getFullYear();
			intPreviousMonth = datCurrentDate.getMonth();
			intDayOffset = datCurrentDate.getDay() + 6;
			//alert(intDayOffset);
			}
		/* Draw the weekdays for the first seven days */
		if (datCurrentDate.getDate() < 8)
			{
			strDateId = "month" + (( datCurrentDate.getMonth() + intMonthOffset ) % 12) + "day" + (( datCurrentDate.getDate() +  intDayOffset) % 7);
			document.getElementById(strDateId).innerHTML = myShortDays[datCurrentDate.getDay()];
			//document.getElementById(strDateId).innerHTML = datCurrentDate.getDay();
			}
		strDayId = "month" + (( datCurrentDate.getMonth() + intMonthOffset ) % 12) + "date" + ( datCurrentDate.getDate() +  (intDayOffset %7));
		document.getElementById(strDayId).innerHTML =  datCurrentDate.getDate();
		document.getElementById(strDayId).title =  "";
		document.getElementById(strDayId).className = "dateShow";
		document.getElementById(strDayId).onclick = function(){	jumpMonth(this);	};
		datCurrentDate.setDate(datCurrentDate.getDate()+1);
		}
	if (intYear == endDate.getFullYear())
		{
		document.getElementById("yearDisplay").innerHTML = intYear;
		document.getElementById("imgLeft").title = "Go back to " + intYear -1;
		document.getElementById("imgRight").title = "Go forward to " + intYear+1;
		}
	else
		{
		document.getElementById("yearDisplay").innerHTML = intYear + "/" + endDate.getFullYear();
		document.getElementById("imgLeft").title = "Go back to " + (intYear * 1 -1) + "/" + (endDate.getFullYear() *1 -1);
		document.getElementById("imgRight").title = "Go forward to " + (intYear * 1 + 1) + "/" + (endDate.getFullYear() * 1 +1);
		}
	//listReminders();
	
	
	}
function highlightDate(obj){
//Find the date to highlight
datDateToHighlight = obj.getRmDate();
//Build a new reference date to determine the offset of the selected month
datHiLite = new Date;
//Set the date to the passed date
datHiLite.setMonth ( datDateToHighlight.getMonth());
datHiLite.setFullYear (datDateToHighlight.getFullYear());
datHiLite.setDate(1);
intDayOffset = (datHiLite.getDay() + 6) % 7;
strYearText = "monthHeader" + (( datHiLite.getMonth() + intMonthOffset ) % 12);
//alert(datHiLite);
strYear = document.getElementById(strYearText).innerHTML;
if (strYear.substring(strYear.length -4) == datHiLite.getFullYear ())
	{
	strDayId = "month" + (( datDateToHighlight.getMonth() + intMonthOffset ) % 12) + "date" + ( datDateToHighlight.getDate() +  intDayOffset);
	if(obj.rmEnabled == 1)
	    {
	    document.getElementById(strDayId).className =  "gotRmDay";
	    document.getElementById(strDayId).title += obj.rmDesc + " ";
	    }
	else
	    {
	    document.getElementById(strDayId).className =  "disabledRmDay";
	    document.getElementById(strDayId).title += "Disabled ["+obj.rmDesc + "] ";
	    }
	
	}
if (datDateToHighlight >= datTodaysDate)
	{
	highlightRepeat(obj);
	}
	$(".gotRmDay").tooltip({position:"bottom center",effect:"fade",tipClass:"tooltipu"});
	
}
function highlightRepeat(obj){
//Find the date to highlight
datDateToHighlight = obj.getRmDate();
//Build a new reference date to determine the offset of the selected month
datHiLite = new Date;
datOffset = new Date;
datHiLite.setMonth ( datDateToHighlight.getMonth());
datHiLite.setDate(datDateToHighlight.getDate());
datOffset.setMonth ( datHiLite.getMonth());
datOffset.setYear ( datHiLite.getFullYear());
datOffset.setDate(1);
datEndDate = new Date;
datEndDate.setDate(1);
datEndDate.setMonth(datCurrentDate.getMonth());
datEndDate.setYear(datCurrentDate.getFullYear()+1);
datEndDate.setDate(datCurrentDate.getDate());
while (datHiLite < datEndDate )
	{
	
	switch(obj.rmPeriod*1)
		{
		case 0:
			datHiLite.setYear ( datHiLite.getFullYear() + 1);
			datHiLite.setMonth ( datHiLite.getMonth());
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;
		case 7:
			
			datHiLite.setDate ( datHiLite.getDate()+7);
			datHiLite.setYear ( datHiLite.getFullYear());
			datHiLite.setMonth ( datHiLite.getMonth());
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;			
		case 30:
			datHiLite.setMonth ( datHiLite.getMonth() +1);
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;
		case 90:
			datHiLite.setMonth ( datHiLite.getMonth() +3);
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;
		case 180:
			datHiLite.setMonth ( datHiLite.getMonth() +6);
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;
		case 365:
			datHiLite.setYear ( datHiLite.getFullYear() + 1);
			datHiLite.setMonth ( datHiLite.getMonth());
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
			break;
		default:
			datHiLite.setDate ( datHiLite.getDate() + obj.rmPeriod *1);
			datOffset.setDate ( datHiLite.getDate());
			datOffset.setMonth ( datHiLite.getMonth());
			datOffset.setYear ( datHiLite.getFullYear());
		}
	datOffset.setDate(1);
	intDayOffset = (datOffset.getDay() + 6) % 7;
	//alert(datHiLite + " " + datOffset )
	strYearText = "monthHeader" + (( datHiLite.getMonth() + intMonthOffset ) % 12);
	strYear = document.getElementById(strYearText).innerHTML;
	if (strYear.substring(strYear.length -4) == datHiLite.getFullYear ())
		{
		strDayId = "month" + (( datHiLite.getMonth() + intMonthOffset ) % 12) + "date" + ( datHiLite.getDate() +  intDayOffset);
		document.getElementById(strDayId).className =  "gotRmDayRpt";
		document.getElementById(strDayId).title += obj.rmDesc + " ";
		}
	}
$(".gotRmDayRpt").tooltip({position:"bottom center",effect:"fade",tipClass:"tooltipu"});	
}
/****************************************************************************/

/****************************************************************************/
function refreshSub(){
	initialise();
	hideMe();
}
/****************************************************************************/
/****************************************************************************/
/* Calendar jumping functions 												*/
/****************************************************************************/
/****************************************************************************/
/*Jump to the current year 													*/
/****************************************************************************/
function goToToday(){
	var tempDate = new Date;
	intYear = tempDate.getFullYear();
	listReminders();
	initialise();

}

/****************************************************************************/
/*Move a year up / forward 													*/
/****************************************************************************/
function yearUp(){
	intYear++;
	listReminders();
	initialise();

	}
/****************************************************************************/
/*Move a year back / down 													*/
/****************************************************************************/
function yearDn(){
	intYear--;
	listReminders();
	initialise();

}
/********************************************************************************/
/* Not used																		*/
/********************************************************************************
function jumpToMonth(ele){
	for(var i=0; i<reminders.length; i++)
		{
		if(	reminders[i].rmId == ele)
			{
			var reminderDate=reminders[i].rmDate.split("-");
			intYear = reminderDate[0];
			intMonth = reminderDate[1] -1;
			initialise();
			}
		}
}
*/

/********************************************************************************/
/* Jump to the month view using a html objectID 								*/
/* The object ID holds the month offset with 0 being the first month displayed	*/
/* Use this offset to find the month name and the year from the page. 			*/
/* Then use the month array to find the month value.							*/
/********************************************************************************/
function jumpMonth(obj){
var monthId = obj.id.substr(5);
var monthParts = monthId.split("date");
var mId = "monthHeader" + monthParts[0];
var dateVal = obj.innerHTML;
var yearVal = document.getElementById(mId).innerHTML.substr(-4);
var monthStr = document.getElementById(mId).innerHTML.split(" ");
for (var x=0; x<myMonths.length;x++)
	{
	if (myMonths[x] == monthStr[0])
		{
		monthVal = x;
		}
	}
document.location = "/personalReminders/monthview.php?date=" + dateVal + "&month=" + monthVal + "&year=" + yearVal;
}

/********************************************************************************/
/*Jump to the month view using only a reminder id 								*/
/*find the reminder then find its date. Jump to the month view for this date 	*/
/********************************************************************************/

function jumpToDate(ele){
	for(var i=0; i<reminders.length; i++)
		{
		if(	reminders[i].rmId == ele)
			{
			var reminderDate=reminders[i].rmDate.split("-");
			intYear = reminderDate[0];
			intMonth = reminderDate[1];
			document.location = "/personalReminders/monthview.php?date=01&month=" + intMonth + "&year=" + intYear;
			}
		}
}	
/********************************************************************************/
/* Jump to the month view from the month Header 								*/
/* Use the month array to find the value for this month name					*/
/********************************************************************************/
function jumpMonthHead(obj){
var mId = obj.id;
var dateVal = 1;
var yearVal = document.getElementById(mId).innerHTML.substr(-4);
var monthStr = document.getElementById(mId).innerHTML.split(" ");
for (var x=0; x<myMonths.length;x++)
	{
	if (myMonths[x] == monthStr[0])
		{
		monthVal = x;
		}
	}
document.location = "/personalReminders/monthview.php?date=" + dateVal + "&month=" + monthVal + "&year=" + yearVal;
}
/****************************************************************************/
/****************************************************************************/
/* Reminder Class Definition and class required routines					*/
/****************************************************************************/
/****************************************************************************/
/* Reminder Class Definition */


function Reminder(rmDate, rmDesc, rmId, rmNotes, rmPeriod, rmEnabled){
this.rmDate = rmDate;
this.rmDesc = rmDesc;
this.rmPeriod = rmPeriod;
this.rmId = rmId;
this.rmNotes = rmNotes;
this.rmEnabled = rmEnabled;
this.getRmDate = function(){
								var myDate = new Date;
								var tmpDate = this.rmDate.split("-");
								myDate.setDate(1);
								myDate.setMonth((tmpDate[1]));
								myDate.setYear(tmpDate[0]);
								myDate.setDate(tmpDate[2]);
								//alert(myDate);
								return myDate;
	}
}

/* Add reminder to the java collection
	Incoming dates are real and converted to java 0-11 months format */
function addReminder(myDate, myDesc, myId, myNotes, myPeriod, myEnabled){
var reminderDate=myDate.split("-");
myDate = reminderDate[0]+"-"+((reminderDate[1]*1)-1)+"-"+reminderDate[2];
reminders.push(new Reminder(myDate,myDesc,myId, myNotes, myPeriod, myEnabled));
}
/****************************************************************************/
/*Reset colours
	
	Turn all the date cells back to the standard class then examine the
	current reminder object array. If there are reminders in the current month
	colour them according to the gotReminder class style */
/****************************************************************************/


function resetColours(){
for (var x = 0;x < reminders.length; x++)
	{
	highlightDate(reminders[x]);
	}
}

/****************************************************************************/
/* Initialisation of the window once loaded 								*/
/****************************************************************************/

window.onload = function(){
listReminders();
initialise();


}

/****************************************************************************/
/* Exernal plan popup														*/
/****************************************************************************/
function showPlan(){
	var popupWindow = window.open("reminderPlan.php","ReminderPlan","status=1,toolbar=0,scrollbars=yes,resizable=1, height=600,width=600");
	popupWindow.focus();
}

/****************************************************************************/
/****************************************************************************/
/* Manual reminder creation	/ edit routines									*/
/****************************************************************************/
/****************************************************************************/
/* Display the reminder creator */

function createNew(intDate){
	var dateObj = new Date;
	document.getElementById("reminderEdit").style.display = 'block';
	clearForm();
	document.getElementById("reminderDate").value = intDate;
	document.getElementById("reminderMonth").value = myShortMonths[dateObj.getMonth()];
	document.getElementById("reminderYear").value = dateObj.getFullYear();
	document.getElementById("reminderMode").value = "new";
}

/* Hide the reminder editor */
function hideMe(){
	document.getElementById("reminderEdit").style.display = 'none';
}

/* Hide the reminder editor and redraw the calendar with the updates */
function hideAndRedraw(){
	hideMe();
	clearForm();
	initialise();
}

/*Reset the form contents */
function clearForm(){
	document.getElementById("reminderDate").value = "";
	document.getElementById("reminderMonth").value = "";
	document.getElementById("reminderYear").value = "";
	document.getElementById("reminderMode").value = "";
	document.getElementById("reminderId").value = "";
}


function createMe(){
	if (document.getElementById("reminderDate").value == '')
		{
		alert("You must enter a date");
		return false;
		}
	if (document.getElementById("reminderMonth").value == '')
		{
		alert("You must enter a month");
		return false;
		}
	if (document.getElementById("reminderYear").value == '')
		{
		alert("You must enter a year");
		return false;
		}
	//try{
	
	var testDateObj = new Date();
	testDateObj.setDate(1);
	testDateObj.setYear(document.getElementById("reminderYear").value);
	for (var d=0;d<myShortMonths.length;d++)
		{
		if ((myShortMonths[d] == document.getElementById("reminderMonth").value) ||(d == (document.getElementById("reminderMonth").value *1)))
			{
			testDateObj.setMonth(d);
			}
		}
	testDateObj.setDate(document.getElementById("reminderDate").value);
	if ((testDateObj.getDate()!= document.getElementById("reminderDate").value)||(testDateObj.getFullYear() != document.getElementById("reminderYear").value))
		{
		if (! confirm ("You entered a bad date. The date you entered was translated to \n" + myDays[testDateObj.getDay()] +" "+ testDateObj.getDate() + "-"  + myMonths[testDateObj.getMonth()] + "-"  + testDateObj.getFullYear() + "\n\n is this OK?"))
			{
			return false;
			}
		}
	if (document.getElementById("reminderMode").value == 'edit')
		{
		removeReminder(document.getElementById("reminderId").value);
		document.getElementById("frmReminders").src = "reminders2.php?update=" + document.getElementById("reminderId").value + "&rmDay=" + testDateObj.getDate() + "&rmMonth=" + (testDateObj.getMonth() +1) + "&rmYear=" + testDateObj.getFullYear() + "&rmDesc=" + document.getElementById("reminderDesc").value+ "&rmNotes=" + document.getElementById("reminderNotes").value + "&rmPeriod=" + document.getElementById("reminderPeriod").value;
		}
	else
		{
		document.getElementById("frmReminders").src = "reminders2.php?add=true&rmDay=" + testDateObj.getDate() + "&rmMonth=" + (testDateObj.getMonth() +1) + "&rmYear=" + testDateObj.getFullYear() + "&rmDesc=" + document.getElementById("reminderDesc").value + "&rmPeriod=" + document.getElementById("reminderPeriod").value;
		}
	/*	}
	
catch(err)
	{
	alert("you entered a bad date");
	}
	hideMe();
	*/

}
function listReminders() {
var activeReminder = $('#activeReminder').attr('checked');
var disabledReminder = $('#disabledReminder').attr('checked');
var expiredReminder = $('#expiredReminder').attr('checked');
var archivedReminder = $('#archivedReminder').attr('checked');
if( ! (activeReminder || disabledReminder || expiredReminder ||archivedReminder))
	{
	activeReminder = !activeReminder;
	}

$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderList.php",
            data: {activeReminder:activeReminder,expiredReminder:expiredReminder,disabledReminder:disabledReminder, archivedReminder:archivedReminder},
  		  	context: document,
  			dataType: 'html',
  			success: function(data) { $('#currentReminders').html(data);
  										resetColours();
  										}
	});
}



function showData(gtitle,gmessage){
if (!gtitle==''&& !gmessage=='')
	{
	gtitle == '' ? 'Saved' : gtitle;
	$.gritter.add({	title: gtitle,
					text: gmessage});
	}
}