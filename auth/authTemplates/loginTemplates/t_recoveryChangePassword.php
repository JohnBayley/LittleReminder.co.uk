<div id="userAdd" class="ui-corner-all">
		<h1>Logged in</h1>
		<p>You are logged in as {username} you may now change your password.</p>
		<br />

		<form method="post" action="{PHP_SELF}" enctype="multipart/form-data" id="edituser"  onSubmit="return checkform()" >
		<fieldset class="recovery recoverySml ui-corner-all">
		<legend class="ui-corner-all">Recover details for {username}</legend>
			<br />
			<input type="hidden" value="{username}" id="username" name="username">
			<input type="hidden" value="true" name="chpw">
			<label for="newpassword1">Password</label>
			<input type="password" class="password ui-corner-all" id="newpassword1" name="newpassword1" maxlength="45" tabindex="6" onchange="javascript:markDataAsChanged()" /></td>
			<br />
			<label for="newpassword2">Confirm</label>
			<div class="inputHolder ui-corner-all">
				<input type="password" class="passwordConf ui-corner-all" id="newpassword2" name="newpassword2" maxlength="45" tabindex="7" />
				<div id="passwordCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Pasword Check" title="If you type matching passwords a tick is shown here" /></div>
			</div>

			<fieldset class="buttons ui-corner-all">
				<a href="javascript:saveChanges()"><img src="/images/buttons/save.png" alt="Save" /></a>
				<a href="/"><img src="/images/buttons/cancel.png" alt="Cancel" /></a>
			</fieldset>
		</fieldset>
		</form>
</div>

