<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<meta name="keywords" content="Web design web applications SQL database design John R. Bayley" />
	<meta name="description" content="John R. Bayley" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<Meta http-equiv="Author" Content="J.R.Bayley" />
	<title>Little Reminder : Free reminders to your inbox</title>


	{java}




</head>

<body>
<div id="reminderEditor">
	<fieldset class="ui-corner-all">
		<legend class="ui-corner-all">Create Reminder</legend>
		<br />
		<label for="rmDesc">Description</label>
		<br />
		<input class="ui-corner-all" type="text" name="rmDesc" id="rmDesc" value="{reminderDesc}" maxlength ="60"/>
		<br />
		<label for="rmPeriod">Repeat Period</label>
		<br />
		<select name="rmPeriod" id="rmPeriod">
			{periodSelections}
		</select>
		<br />
		<div id="rmLeft">
		<label for="rmDate">Date</label>
		<br />
		<input class="ui-corner-all" type="text" name="rmDate" id="rmDate" value="{reminderDate}" />
		</div>
		<div id="rmRight">
		<label for="rmTime">Time</label>
		<br />
		<input class="ui-corner-all" type="text" name="rmTime" id="rmTime" value="{reminderTime}" />
		</div>
		<br />
		<label for="rmComment">Comment</label>
		<br />
		<textarea class="ui-corner-all" name="rmNotes" id="rmNotes" cols="35" rows="5" maxlength ="2020">{reminderComment}</textarea>
		<input type="hidden" name="rmId" id="rmId" value="new" />
		<br />
		<fieldset class="buttonHolder ui-corner-all">
			<span class="fg-button ui-state-default ui-corner-all" onclick="javascript:saveReminder()" title="Save Changes"><img src="/images/fam/disk.png" alt=">" /> Save</span>
			<span class="fg-button ui-state-default ui-corner-all" onclick="javascript:cancelReminder()" title="Cancel Changes"><img src="/images/fam/cancel.png" alt=">" /> Cancel</span>
		</fieldset>
	</fieldset>
</div>
</body>
</head>