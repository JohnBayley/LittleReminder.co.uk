<div id="sidebar" class="ui-corner-all">

	<h3 class="title">Manage Reminders</h3>
	<p>Block reminder update. Select the change then select the reminders to update</p>
	<hr />
	<br />
	
	<div id="manageList" class="ui-corner-all">
	
	<h3 id="updateText">Block Update Options</h3>
	
	<br />
	
	<p class="blockUpdate ui-corner-all" title="Automatically update selected reminders to the future.">
	
	<input type="radio" name="update" id="autoUpdate" onclick="javascript:updateMode()" />
	
	<label for="autoUpdate">Auto Update</label>
		<a class="infoTool" href="/personalReminders/help/updateHelp.html" title="Information on updating reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>
		
		<p class="blockUpdate ui-corner-all" title="Enable the selected reminders.">
		<input type="radio" name="update" id="enableUpdate" onclick="javascript:updateMode()" />
	
	<label for="enableUpdate">Enable</label>
		<a class="infoTool" href="/personalReminders/help/enableHelp.html" title="Information on enabling/disabling reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>    
		
		<p class="blockUpdate ui-corner-all" title="Disable the selected reminders.">
		<input type="radio" name="update" id="disableUpdate" onclick="javascript:updateMode()" />
	
	<label for="disableUpdate">Disable</label>
		<a class="infoTool" href="/personalReminders/help/enableHelp.html" title="Information on enabling/disabling reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>
		
		<p class="blockUpdate ui-corner-all">
		<input type="radio" name="update" id="archiveUpdate" onclick="javascript:updateMode()" title="Deactivate the selected reminders."/>
	
	<label for="archiveUpdate" title="Reactivate the selected reminders.">Archive</label>
		<a class="infoTool" href="/personalReminders/help/archiveHelp.html" title="Information on archived reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>   
		
		<p class="blockUpdate ui-corner-all">
		<input type="radio" name="update" id="unarchiveUpdate" onclick="javascript:updateMode()" title="Deactivate the selected reminders."/>
	
	<label for="unarchiveUpdate" title="Deactivate the selected reminders.">Un archive</label>
		<a class="infoTool" href="/personalReminders/help/archiveHelp.html" title="Information on archived reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>    
		
		<p class="blockUpdate ui-corner-all" title="Delete the selected reminders.">
		<input type="radio" name="update" id="delUpdate" onclick="javascript:updateMode()" />
		<label for="delUpdate">Delete</label>
		<a class="infoTool" href="/personalReminders/help/deleteHelp.html" title="Information on deleted reminders."><img class="infoIcon" src="/images/fam/information.png" alt="info" /></a>
		</p>
		
		<p class="blockUpdate ui-corner-all" title="Do not change anything.">
		<input type="radio" name="update" id="noneUpdate" onclick="javascript:updateMode()" />
		<label for="autoUpdate">No Change</label>
		</p>
			
		<br />
		<br />
		<img src="/images/buttons.en/update.png" alt="update" class="manageImage" onclick="javascript:submitRepeats()"/>
		<br />
		<br />
		</div>
</div>    
