var dateObj = new Date; /* Calendar Date - Only month and year are valid */
var createReminder = new Reminder; /* For creating by clicking on the cell */
var myDays= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
var myShortDays= ["Su","Mo","Tu","We","Th","Fr","Sa","Su"];
var myMonths = ["January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December"];
var myImageMonths = ["january", "february", "march", "april", "may", "june",
			"july", "august", "september", "october", "november", "december"];
var todaysDate = new Date; /* Date that moves etc start from ie before the change */
var reminders = []; /* Reminders Array */
/* Draw the month dates into the table */
function drawMonth(){
	var startMonth = dateObj.getMonth();
	var prevDate = new Date;
	var drawDate = new Date;
	/* Create a date object for this month */
	drawDate.setDate(1);
	drawDate.setMonth(dateObj.getMonth());
	drawDate.setYear(dateObj.getFullYear());
	drawDate.setDate(1);
	/* Create a date object for the previous month */
	prevDate.setDate(1);
	prevDate.setMonth(dateObj.getMonth());
	prevDate.setYear(dateObj.getFullYear());
	prevDate.setDate(1);
	prevDate.setMonth(dateObj.getMonth()-1);
	document.getElementById("currentMonth").innerHTML = myMonths[dateObj.getMonth()];
	document.getElementById("currentYear").innerHTML = drawDate.getFullYear();
	document.getElementById("monthVertical").src="/images/calendar/"+myImageMonths[dateObj.getMonth()]+".png";
	$('#monthVertical').css("top",($('#calendarHolder').css("height").replace("px", "") /2) + $('#monthVertical').css("height")/2);
	document.getElementById("prevMonth").innerHTML = "&lt; "+myMonths[prevDate.getMonth()];
	document.getElementById("prevMonth").title = "Back to "+myMonths[prevDate.getMonth()].toLowerCase()+" "+prevDate.getFullYear();
	prevDate.setYear(dateObj.getFullYear());
	prevDate.setMonth(dateObj.getMonth()+1);
	document.getElementById("nextMonth").innerHTML = myMonths[prevDate.getMonth()]+" &gt;";
	document.getElementById("nextMonth").title = "Fowrard to "+myMonths[prevDate.getMonth()]+" "+prevDate.getFullYear();
	try{
		$( ".dateBox" ).droppable("destroy");
		}
	catch(err){}
	myOffset = drawDate.getDay()-1;

	if (myOffset < 0){myOffset = myOffset + 7 ;}
	/* Load the dates into the calendar */

	/* Clear the current calendar */
	for (var dateOffset=1; dateOffset < 39; dateOffset++)
		{
		/*Start by clearing the old dates */
		document.getElementById('d'+ dateOffset).innerHTML = "";
		document.getElementById('d'+ dateOffset).className = "dateExt";
		document.getElementById('d'+ dateOffset).title = "";
		}
	/* Delete any reminder Divs */
	$('.gotReminder').remove();
	$('.reminderRpt').remove();

	$('.disabledReminder').remove();
	/* Calendar is clear so rebuild the dates */
	for (var dateOffset=1; dateOffset < 40; dateOffset++)
		{
		/* If this is the first seven days, draw the weekdays */
		if (dateOffset <= 7)
			{
			document.getElementById("day" + dateOffset).innerHTML = myDays[dateOffset];
			}
		/*If we are still in the current month, draw this date */
		if (drawDate.getMonth() == startMonth)
			{
			/*Calculate the cell ID */
			var dateToUse = dateOffset + myOffset;
			document.getElementById('d'+dateToUse).innerHTML = "<div class='dateind'>" + drawDate.getDate() + "</div>";
			document.getElementById('d'+dateToUse).title = myDays[drawDate.getDay()]+", "+myMonths[drawDate.getMonth()]+" "+drawDate.getDate()+", "+drawDate.getFullYear();
			document.getElementById('d'+dateToUse).className = "dateBox ui-droppable";
			if (drawDate.getDate() == todaysDate.getDate() && drawDate.getMonth() == todaysDate.getMonth() && drawDate.getFullYear() == todaysDate.getFullYear())
				{
				document.getElementById("d"+dateToUse).className = "todayHighlight ui-droppable";
				document.getElementById("d"+dateToUse).title = "Today";
				document.getElementById("d"+dateToUse).innerHTML += " (Today)<br />";
				}
			if (drawDate < todaysDate)
				{
				document.getElementById('d'+dateToUse).innerHTML = "<div class='dateindPast'>" + drawDate.getDate() + "</div>";
				document.getElementById('d'+dateToUse).title = "Past Date "+myDays[drawDate.getDay()]+", "+myMonths[drawDate.getMonth()]+" "+drawDate.getDate()+", "+drawDate.getFullYear();
				document.getElementById('d'+dateToUse).className = "datePast";
				}
			/*Increment*/
			drawDate.setDate(drawDate.getDate()+1 );
			}
		}
		$( ".dateBox" ).droppable({	activeClass: "ui-state-hover",
									hoverClass: "ui-state-active redish",
									drop: function( event, ui ) {	handleDroppedObject(ui.draggable,this.id);
																	ui.helper.slideUp(500);	}
																});
		listReminders();
}

/* Delete and redwaw the reminders */
function drawReminders(){
	$('.disabledReminder').remove();
	$('.gotReminder').remove();
	$('.reminderRpt').remove();
	for (var x = 0;x < reminders.length; x++)
		{
		displayReminder(reminders[x]);

		}
	$( ".gotReminder" ).draggable({ 	revert: "valid" ,
										opacity: 0.7,
										helper: "clone",
										cursorAt: { cursor: "hand", top:5, left: 10}
	});
	$('.gotReminder').click(function() { editReminder(this);	});
	$('.disabledReminder').click(function() { editReminder(this);	});
	$('.reminderRpt').click(function() { editReminder(this);	});
}

/* Create a new calendar reminder */
function displayReminder(rmObj){
	var newRem = document.createElement("div");
	newRem.id = "reminder" + rmObj.rmId;
	newRem.innerHTML = rmObj.rmDesc+" "+rmObj.rmTime;
	if (rmObj.rmEnabled == 1)
		{
		newRem.className = "gotReminder ui-corner-all";
		}
	else
		{
		newRem.className = "disabledReminder ui-corner-all";
		newRem.title = "This Reminder is Disabled";
		}

	var reminderDate = rmObj.getRmDate()
	//alert(dateObj + " " + reminderDate);
	if ((dateObj.getMonth() == reminderDate.getMonth()) && (dateObj.getFullYear() == reminderDate.getFullYear()))
		{
			document.getElementById('d'+ (reminderDate.getDate() + myOffset)).appendChild(newRem);
			document.getElementById('d'+ (reminderDate.getDate() + myOffset)).className = "rmHighlight";
		}

	//if (reminderDate > todaysDate)
		//{
 		displayRepeat(rmObj);
		//}
}

function editReminder(ele){
	var reminderElId = $(ele).attr('id');
	var reminderId = reminderElId.split('reminder');
	reminderId = reminderId[1];
	document.getElementById('rmEditLink').href ='/personalReminders/reminderEditor.php?rmId='+reminderId;
	$('#rmEditLink').click();

}

function displayRepeat(rmObj){
	var reminderDate = rmObj.getRmDate()
	var endDate = new Date;
	endDate.setYear(dateObj.getFullYear());
	endDate.setMonth(dateObj.getMonth() + 1);
	endDate.setDate(1);
	while (reminderDate < endDate)
		{
		switch(rmObj.rmPeriod*1)
			{
			case 0:
				reminderDate.setYear(reminderDate.getFullYear() + 1);
				break;
			case 30:
				reminderDate.setMonth(reminderDate.getMonth() + 1);
				break;
			case 90:
				reminderDate.setMonth(reminderDate.getMonth() + 3);
				break;

			case 180:
				reminderDate.setMonth(reminderDate.getMonth() + 6);
				break;

			case 365:
				reminderDate.setYear(reminderDate.getFullYear() + 1);
				break;
			default:
				reminderDate.setDate(reminderDate.getDate() + rmObj.rmPeriod *1);
			}

		if ((dateObj.getMonth() == reminderDate.getMonth()) && (dateObj.getFullYear() == reminderDate.getFullYear()))
			{
			var newRem = document.createElement("div");
			var origDate = rmObj.rmDate.split('-');
			newRem.id = "reminder" + rmObj.rmId;
			newRem.innerHTML = rmObj.rmDesc;
			newRem.title = 'Repeat of '+rmObj.rmDesc+' [Original: '+origDate[2]+'-'+myMonths[(origDate[1]-1)]+'-'+origDate[0]+']';
			newRem.className = "reminderRpt ui-corner-all";
			document.getElementById('d'+ (reminderDate.getDate() + myOffset)).appendChild(newRem);
			document.getElementById('d'+ (reminderDate.getDate() + myOffset)).className = "rmHighlight";
			}
		}
}



function prevMonth(){
	monthDn(1);
}
function nextMonth(){
	monthUp(1);
}
function monthUp(difference){
		dateObj.setMonth(dateObj.getMonth()+difference);
		drawMonth();


}
/*Move a month back / down */
function monthDn(difference){
		dateObj.setMonth(dateObj.getMonth()-difference);
		drawMonth();
}

function jumpToDate(ele){
	for(var i=0; i<reminders.length; i++)
		{
		if(	reminders[i].rmId == ele)
			{
				var reminderDate=reminders[i].rmDate.split("-");
				dateObj.setDate(1);
				dateObj.setMonth(reminderDate[1]);
				dateObj.setYear(reminderDate[0]);
				drawMonth();
			}
		}
	}

function handleDroppedObject($ele,elid){
	var reloadPage = false;
	var reminderId = 'new';
	var reminderElId = $ele.attr("id");
	var newReminderDesc =$ele.html();
	var newReminderPeriod = '';
	var newReminderNotes = '';
	/* Transfer if this is a clipboard reminder */
	if ($('#'+reminderElId).is('.clipReminder'))
		{
		$ele.appendTo('#'+elid);
		$ele.removeClass('clipReminder');
		$ele.addClass('gotReminder');
		}
	/* If this is not a quick reminder then get the existing reminder details */
	if ($('#'+reminderElId).is('.reminderPortlet'))
		{
		/* Adding new item from the portlet */
		if (newReminderDesc == 'Birthday')
			{
			var bd = prompt ("Who's Birthday is it ?");
			newReminderDesc = bd + "'s "+newReminderDesc;
			newReminderPeriod = '365';
			}
		}
	else
		{
		$ele.appendTo('#'+elid);
		reminderId = reminderElId.split('reminder');
		reminderId = reminderId[1];
		}
	/* Calculate the new date */
	var selectedDay = padZeros($('#'+elid).children(":first").html());
	var month = padZeros((dateObj.getMonth()*1)+1);
	var year = dateObj.getFullYear();
	/* Save the changes to the database */
	reminderSave(reminderId, selectedDay,month,year,newReminderDesc,newReminderPeriod,newReminderNotes);

}
function storeClip($ele,elid){
	$ele.appendTo("#clip");
	$ele.removeClass('gotReminder');
	$ele.addClass('clipReminder');
}

function cellDetail(ele) {
	var elId = ele.id;
	elId = elId.substr(1)*1-myOffset;
	var rmDay = padZeros(elId);
	var tmpMonth = padZeros((dateObj.getMonth()*1)+1);
	var myDate = rmDay+"-"+tmpMonth+"-"+dateObj.getFullYear();
	var myDesc = $(ele).html();
	var myId = 0;
	var myNotes = '';
	var myPeriod = '';
	createReminder = new Reminder(myDate,myDesc,myId, myNotes, myPeriod, myNotes)

	$('#rmCreateLink').click();

}

function padZeros(number) {
     return (number < 10 ? '0' : '') + number
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
  										drawReminders();}
	});
}

function saveReminder(){
	var rmId = $('#rmId').val();
	var rmDesc = $('#rmDesc').val();
	var reminderDateStr = $('#rmDate').val();
	var reminderDate = reminderDateStr.split("-");
	var rmDay = reminderDate[0];
	var rmMonth = reminderDate[1];
	var rmYear = reminderDate[2];
	var rmPeriod = $('#rmPeriod').val();
	var rmNotes = $('#rmNotes').val();
	var rmEnabled = 0;
	var rmTime = $('#rmTime').val();
	if ($('#rmEnabled').is(':checked'))
		{
		rmEnabled = 1;
		}
	reminderSave(rmId, rmDay,rmMonth,rmYear,rmDesc,rmPeriod,rmNotes,rmEnabled,rmTime);
	listReminders();
	$.fancybox.close();
}

function cancelReminder(){
	$.fancybox.close();
}

function reminderSave(rmId, rmDay,rmMonth,rmYear,rmDesc,rmPeriod,rmNotes,rmEnabled,rmTime) {
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderSave.php",
				data: {rmId:rmId, rmDay:rmDay,rmMonth:rmMonth,rmYear:rmYear,rmDesc:rmDesc,rmPeriod:rmPeriod,rmNotes:rmNotes,rmEnabled:rmEnabled,rmTime:rmTime },
				context: document,
				dataType: 'html',
				success: function(data) {  	if (data != '')
												{
													showData('Saved Reminder','<img src="/images/fam/database_save.png" alt="Saved"> '+data);
												}
											listReminders();

										}
		});
}
function reminderDelete(rmId) {
if ($(rmId).is('.reminderPortlet'))
	{return;}
if (confirm('Really Delete this reminder?'))
	{
	var confirmedDelId = $(rmId).attr('id');
	var	reminderId = confirmedDelId.split('reminder');
	reminderId = reminderId[1];
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderDelete.php",
				data: {rmId:reminderId},
				context: document,
				dataType: 'html',
				success: function(data) {  	showData('Deleted Reminder','<img src="/images/fam/database_delete.png" alt="Deleted"> Deleted Reminder');
											listReminders();
							}
		});
	}
}

$(window).resize(function() {
	$('#currentReminders').css("height", $('#currentRemindersHolder').css("height").replace("px", "") -84);
	$('#quickReminders').css("height", $('#quickRemindersHolder').css("height").replace("px", "") -84);
	$('#calendarMain').css("height", $('#calendarHolder').css("height").replace("px", "") -10);
	$('#monthVertical').css("top",($('#calendarHolder').css("height").replace("px", "") /2) + $('#monthVertical').css("height")/2);
	$('#calendarMain').css("width", $('#calendarHolder').css("width").replace("px", "") -70);

});


function showTools() {
    $('#currentReminderToolsHolder').slideDown();
}
function hideTools() {
    listReminders();
    $('#currentReminderToolsHolder').slideUp();
}

$(document).ready(function() {
	/* Read the date from the URL if there is one */
	var url = window.location.href;
	var qparts = url.split("?");
	var mValue = 0;
	var yValue = 0;
	if (qparts.length > 1)
		{
		var query = qparts[1];
		var vars = query.split("&");
		var value = "";
		for (var i=0;i<vars.length;i++)
			{
			var parts = vars[i].split("=");
			if (parts[0] == "month")
				{
				mValue = parts[1];
				mValue.replace(/\+/g," ");
				}
			if (parts[0] == "year")
				{
				yValue = parts[1];
				yValue.replace(/\+/g," ");
				}
			}
		}
	dateObj = new Date();
	dateObj.setDate(1);
	if (yValue > 0)
		{
		dateObj.setMonth(mValue);
		dateObj.setYear(yValue);
		}

	/* Initialise jQuery items */

	$(".rmEdit").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'autoScale'		:	true,
		'speedIn'		:	600,
		'speedOut'		:	200,
		'overlayShow'	:	true,
		'onComplete'	:	function(){initFancyBoxEdit();}
	});
	$("#rmCreateLink").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'autoScale'		:	true,
		'speedIn'		:	600,
		'speedOut'		:	200,
		'overlayShow'	:	true,
		'onComplete'	:	function(){initFancyBoxCreate();}
	});

	$( ".reminderPortlet" ).draggable({ 	revert: "valid" ,

											helper: "clone",
											cursorAt: { cursor: "hand", top:50, left: 10}
									});
	$( "#clip" ).droppable({	activeClass: "ui-state-hover",
									hoverClass: "ui-state-active redish",
									drop: function( event, ui ) {	storeClip(ui.draggable,this.id);
																	ui.helper.slideUp(500);	}
									});
	$( "#wpb" ).droppable({	activeClass: "ui-state-hover",
									hoverClass: "ui-state-active redish",
									drop: function( event, ui ) {	reminderDelete(ui.draggable);
																	ui.helper.slideUp(500);	}
									});
	$( "#edit" ).droppable({	activeClass: "ui-state-hover",
									hoverClass: "ui-state-active redish",
									drop: function( event, ui ) {	editReminder(ui.draggable);
																	ui.helper.slideUp(500);	}
									});
	$(".dateBox").live('click', function(e) {
											  if( (!$.browser.msie && e.button == 0) || ($.browser.msie && e.button == 1) ) {
												   cellDetail(this);
												}
											});

	document.getElementById("currentReminders").innerHTML = '<img src="/images/reminderLoading.gif" alt="Loading">';
	$('#currentReminders').css("height", $('#currentRemindersHolder').css("height").replace("px", "") -84);
	$('#quickReminders').css("height", $('#quickRemindersHolder').css("height").replace("px", "") -84);
	$('#calendarMain').css("height", $('#calendarHolder').css("height").replace("px", "") -10);
	$('#calendarMain').css("width", $('#calendarHolder').css("width").replace("px", "") -70);


	drawMonth();
	listReminders();
	initialiseMonthList();
	initialiseYearList();
});

function initFancyBoxEdit(){
	$('#rmDate').datepicker({numberOfMonths: 2,showButtonPanel: true, minDate: "+0D" ,dateFormat: 'dd-mm-yy'});
	$('#rmTime').timepicker();
}
function initFancyBoxCreate(){

	$('#rmDate').val(createReminder.rmDate);
	$('#rmDate').datepicker({numberOfMonths: 2,showButtonPanel: true, minDate: "+0D" ,dateFormat: 'dd-mm-yy'});
	$('#rmTime').timepicker();
}
function showData(gtitle,gmessage){
if (!gtitle==''&& !gmessage=='')
	{
	gtitle == '' ? 'Saved' : gtitle;
	$.gritter.add({	title: gtitle,
					text: gmessage});
	}
}


/* Populate the month names in the month table */
function initialiseMonthList(){
	for (var x = 0; x <12; x++)
		{
		if 	(myMonths[((dateObj.getMonth() + x +10)%12)] == document.getElementById("currentMonth").innerHTML)
			{
			document.getElementById('monthlist'+x).innerHTML = "<a href=\"javascript:gotoMonth("+ ((dateObj.getMonth() + x +10)%12) + ")\" class='calNavigationCurrent'>" + myMonths[((dateObj.getMonth() + x +10)%12)] +  "</a>";
			}
		else
			{
			document.getElementById('monthlist'+x).innerHTML = "<a href=\"javascript:gotoMonth("+ ((dateObj.getMonth() + x +10)%12) + ")\" class='calNavigation' >" + myMonths[((dateObj.getMonth() + x +10)%12)] + "</a>";
			}
		}
}

/* Display month selector */
function listMonths(){
	if ($("#monthListTable").is(':visible'))
		{
		$("#monthListTable").fadeOut();
		$("#yearListTable").fadeOut();
		}
	else
		{
		$("#monthListTable").fadeIn();
		$("#yearListTable").fadeIn();
		}
}

/* Jump to the selected month */
function gotoMonth(selMonth){
	dateObj.setMonth(selMonth);
	drawMonth();
	document.getElementById("monthListTable").style.display = 'none';
	document.getElementById("yearListTable").style.display = 'none';
	initialiseMonthList();
}

/* Populate year table */
function initialiseYearList(){
	for (var x = 0; x <8; x++)
		{
		if (todaysDate.getFullYear()*1 + x*1 == todaysDate.getFullYear()*1)
			{
			document.getElementById('yearlist'+x).innerHTML = "<a href='javascript:gotoYear(\""+ (todaysDate.getFullYear()*1 + x*1) + "\")' title='Go to "+(todaysDate.getFullYear()*1 + x*1)+"' class='calNavigationCurrent'>" + (todaysDate.getFullYear()*1 + x*1) + "</a>";
			}
		else
			{
			document.getElementById('yearlist'+x).innerHTML = "<a href='javascript:gotoYear(\""+ (todaysDate.getFullYear()*1 + x*1) + "\")' title='Go to "+(todaysDate.getFullYear()*1 + x*1)+"' class='calNavigation'>" + (todaysDate.getFullYear()*1 + x*1) + "</a>";
			}
		}
}

/* Display year selector */
function yearPopup(){
	hideMe();
	document.getElementById("yearListTable").style.left = mousePos.x + 15;
	document.getElementById("yearListTable").style.top = mousePos.y + 15;
	document.getElementById("yearListTable").style.display = (document.getElementById("yearListTable").style.display == 'block') ? 'none' : 'block';
}


/* Jump to the selected year */
function gotoYear(selYear){
	dateObj.setYear(selYear);
	drawMonth();
	document.getElementById("monthListTable").style.display = 'none';
	document.getElementById("yearListTable").style.display = 'none';
	initialiseYearList();
}

/****************************************************************************/
/****************************************************************************/
/* Reminder Class Definition and class required routines					*/
/****************************************************************************/
/****************************************************************************/

function Reminder(rmDate, rmDesc, rmId, rmNotes, rmPeriod,rmEnabled,rmTime){
	this.rmDate = rmDate;
	this.rmDesc = rmDesc;
	this.rmPeriod = rmPeriod;
	this.rmId = rmId;
	this.rmNotes = rmNotes;
	this.rmEnabled = rmEnabled;
	this.rmTime = rmTime;
	this.getRmDate = function(){
		var myDate = new Date;
		var tmpDate = this.rmDate.split("-")
		myDate.setDate(1);
		myDate.setMonth((tmpDate[1]));
		myDate.setYear(tmpDate[0]);
		myDate.setDate(tmpDate[2]);
		//alert(myDate);
		return myDate;
	}
}

/* 	Add reminder to the java collection
	Incoming dates are real and converted to java 0-11 months format 	*/
function addReminder(myDate, myDesc, myId, myNotes, myPeriod,myEnabled,myTime){
	var reminderDate=myDate.split("-");
	myDate = reminderDate[0]+"-"+((reminderDate[1]*1)-1)+"-"+reminderDate[2];
	reminders.push(new Reminder(myDate,myDesc,myId, myNotes, myPeriod,myEnabled,myTime));
}

