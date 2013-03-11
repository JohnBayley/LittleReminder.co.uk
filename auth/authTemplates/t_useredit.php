<form method="post" action="{PHP_SELF}" enctype="multipart/form-data" id="edituser" onsubmit="return checkform()">
	<div id="userEdit" class="ui-corner-all">
				<h3>Edit details for {username}</h3>
				<fieldset class="userDetails ui-corner-all">
					<legend class="ui-corner-all">User Details</legend>
					<br />
					<label for="username">Username</label>
					<br />
					<input type="text" class="text ui-corner-all" name="username" id="username" value="{username}" size="30" maxlength="32" tabindex="1" disabled="disabled" />
					<br />
					<label for="realname">Realname</label>
					<br />
					<input type="text" class="text ui-corner-all" name="realname" id="realname" value="{realname}" size="30" maxlength="45" tabindex="2" onchange="javascript:markDataAsChanged()" />
					<br />
					<label for="email">email</label>
					<br />
					<input type="text" class="text ui-corner-all" name="email" id="email" value="{email}" size="30" maxlength="45" tabindex="3" onchange="javascript:emailChanged()" /><div id="emailCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Email Check" title="If you change the email and it checks out ok a tick is displayed here" /></div>

				</fieldset>

				<fieldset class="changePassword ui-corner-all">
					<legend class="ui-corner-all">Password</legend>
					<br />
					<label for="oldpassword">Old Password</label>
					<br />
					<input type="password" class="password ui-corner-all" id="oldpassword" name="oldpassword" value="" size="30" maxlength="45" tabindex="5" onchange="javascript:markDataAsChanged()" /></td>
					<br />
					<label for="newpassword1">New Password</label>
					<br />
					<input type="password" class="password ui-corner-all" id="newpassword1" name="newpassword1" value="" size="30" maxlength="45" tabindex="6" onchange="javascript:markDataAsChanged()" /></td>
					<br />
					<label for="newpassword2">Confirm Password</label>
					<br />
					<input type="password" class="password ui-corner-all" id="newpassword2" name="newpassword2" value="" size="30" maxlength="45" tabindex="7" /><div id="passwordCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Pasword Check" title="If you type matching passwords a tick is shown here" /></div>
				</fieldset>
				<fieldset class="buttons ui-corner-all">
				<input type="hidden" value="true" name="edit" /><br />
				<a href="javascript:saveChanges()"><img src="/images/buttons/save.png" alt="Save Changes" /></a>
				<a href="/"><img src="/images/buttons/cancel.png" alt="Cancel" /></a>
				</fieldset>
	</div>
</form>
{alert}