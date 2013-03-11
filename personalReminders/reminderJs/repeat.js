var slidePanels = true;

function selectAll() {
    var checkVal = false;
    if (document.getElementById("all").checked)
		{
		checkVal = true;
		}
    for (var x=0;x<=reminderCount;x++)
		{
		try {
			document.getElementById("check"+x).checked=checkVal;
			}
		catch(err){}
		}
}


function updateMode(){
	if (document.getElementById("autoUpdate").checked)
		{
		document.getElementById("updateMode").value = "autoUpdate";
		document.getElementById("updateText").innerHTML = "Auto Update";
		}
	if (document.getElementById("enableUpdate").checked)
		{
		document.getElementById("updateMode").value = "enableUpdate";
		document.getElementById("updateText").innerHTML = "Enable";
		}
	if (document.getElementById("disableUpdate").checked)
		{
		document.getElementById("updateMode").value = "disableUpdate";
		document.getElementById("updateText").innerHTML = "Disable";
		}
	if (document.getElementById("archiveUpdate").checked)
		{
		document.getElementById("updateMode").value = "archiveUpdate";
		document.getElementById("updateText").innerHTML = "Archive";
		}
	if (document.getElementById("unarchiveUpdate").checked)
		{
		document.getElementById("updateMode").value = "unarchiveUpdate";
		document.getElementById("updateText").innerHTML = "Un Archive";
		}
	if (document.getElementById("delUpdate").checked)
		{
		document.getElementById("updateMode").value = "Delete";
		document.getElementById("updateText").innerHTML = "Delete";
		}
	if (document.getElementById("nonelUpdate").checked)
		{
		document.getElementById("updateMode").value = "";
		document.getElementById("updateText").innerHTML = "Update Options";
		}
}


function submitRepeats() {
	document.getElementById("repeatsForm").submit();
}


function showData(gtitle,gmessage){
if (!gtitle==''&& !gmessage=='')
	{
	gtitle == '' ? 'Saved' : gtitle;
	$.gritter.add({	title: gtitle,
					text: gmessage});
	}
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


										}
		});
}

function updateReminderArchive(rmId,archive){
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderArchive.php",
				data: {rmId:rmId, archive:archive },
				context: document,
				dataType: 'html',
				success: function(data) {  	if (data != '')
												{
												showData('Archive Reminder','<img src="/images/fam/database_save.png" alt="Saved"> '+data);
												if (archive==0)
													{
													$("#reminderArchive"+rmId).html('<img src="/images/fam/dash_grey.png" alt="not archived" title="This reminder is not archived"/>');
													$("#reminderArchive"+rmId).attr("href", "javascript:archiveReminder('"+rmId+"')");
													}
												else
													{
													$("#reminderArchive"+rmId).html('<img src="/images/fam/tick.png" alt="archived" title="This reminder is archived"/>');
													$("#reminderArchive"+rmId).attr("href", "javascript:unArchiveReminder('"+rmId+"')");
													}
												}

										}
		});
}

function archiveReminder(rmId){
	updateReminderArchive(rmId,"1");
}

function unArchiveReminder(rmId){
	updateReminderArchive(rmId,"0");
}
function updateReminderEnable(rmId,enable){
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderEnable.php",
				data: {rmId:rmId, enable:enable },
				context: document,
				dataType: 'html',
				success: function(data) {  	if (data != '')
												{
												showData('Enable Reminder','<img src="/images/fam/database_save.png" alt="Saved"> '+data);
												if (enable==0)
													{
													$("#reminderEnable"+rmId).html('<img src="/images/fam/cross.png" alt="disabled" title="This reminder is disabled"/>');
													$("#reminderEnable"+rmId).attr("href", "javascript:enableReminder('"+rmId+"')");
													}
												else
													{
													$("#reminderEnable"+rmId).html('<img src="/images/fam/tick.png" alt="enabled" title="This reminder is enabled"/>');
													$("#reminderEnable"+rmId).attr("href", "javascript:disableReminder('"+rmId+"')");
													}
												}

										}
		});
}

function updateReminderEnable(rmId,enable){
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderEnable.php",
				data: {rmId:rmId, enable:enable },
				context: document,
				dataType: 'html',
				success: function(data) {  	if (data != '')
												{
												showData('Enable Reminder','<img src="/images/fam/database_save.png" alt="Saved"> '+data);
												if (enable==0)
													{
													$("#reminderEnable"+rmId).html('<img src="/images/fam/cross.png" alt="disabled" title="This reminder is disabled"/>');
													$("#reminderEnable"+rmId).attr("href", "javascript:enableReminder('"+rmId+"')");
													}
												else
													{
													$("#reminderEnable"+rmId).html('<img src="/images/fam/tick.png" alt="enabled" title="This reminder is enabled"/>');
													$("#reminderEnable"+rmId).attr("href", "javascript:disableReminder('"+rmId+"')");
													}
												}

										}
		});
}

function enableReminder(rmId){
	updateReminderEnable(rmId,"1");
}

function disableReminder(rmId){
	updateReminderEnable(rmId,"0");
}

function initFancyBoxEdit(){
	$('#rmDate').datepicker({numberOfMonths: 2,showButtonPanel: true, minDate: "+0D" ,dateFormat: 'dd-mm-yy'});
	$('#rmTime').timepicker();
}

function delReminder(reminderId){
if (confirm("Do you really want to delete this reminder??\n This cannot be undone.\nYou could archive it to tuck it away for later.\n Continue with Delete??"))
	{
	$.ajax({	url: "/personalReminders/reminderAjax/ax_reminderDelete.php",
				data: {rmId:reminderId },
				context: document,
				dataType: 'html',
				success: function(data) {
				                        	if (data == 1)
												{
												$('#reminder'+reminderId).slideUp();
												showData('Deleted Reminder','<img src="/images/fam/database_save.png" alt="Deleted"> ');
												}
                                            else
												{
												showData('Delete Failed','<img src="/images/fam/database_save.png" alt="Delete Failed"> ');
												}
										}
		});
	}
}
$(document).ready(function(){
var $scrollingDiv = $(".scrollPanel");
		$(window).scroll(function(){
		    if (slidePanels)
		        {
		        if($(window).scrollTop() > 59)
		            {
                    $scrollingDiv
                        .stop()
                        .animate({"marginTop": ($(window).scrollTop() - 70)  + "px"}, "slow" );
                    }
                else
                    {
                    $scrollingDiv
                        .stop()
                        .animate({"marginTop": "5px"}, "slow" );
                    }
                }
		});
	});

function showData(gtitle,gmessage){
if (!gtitle==''&& !gmessage=='')
	{
	gtitle == '' ? 'Saved' : gtitle;
	$.gritter.add({	title: gtitle,
					text: gmessage});
	}
}