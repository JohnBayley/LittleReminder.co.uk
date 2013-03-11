<form method="post" action="{PHP_SELF}" enctype="multipart/form-data" id="adduser" onsubmit="return checkform()">
	<div id="userAdd" class="ui-corner-all">
				<h3>Add a new User</h3>
				<fieldset class="userDetails ui-corner-all">
					<legend class="ui-corner-all">User Details</legend>
					<br />
					<fieldset class="userDetailsSub ui-corner-all">
					<legend class="ui-corner-all">Account Details</legend>
						<br />
						<label for="username">Username</label>
						<div class="inputHolder ui-corner-all">
							<input tabindex="1" type="text" class="username textSml ui-corner-all" name="username" id="username" maxlength="32" tabindex="1"  />
							<div id="usernameCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Username Check" title="If the username is available a tick is shown here." /></div>
						</div>
						<br />
						<label for="newpassword1">Password</label>
						<input  tabindex="2" type="password" class="password ui-corner-all" id="newpassword1" name="password1" maxlength="45" tabindex="6" onchange="javascript:markDataAsChanged()" /></td>
						<br />
						<label for="newpassword2">Confirm</label>
						<div class="inputHolder ui-corner-all">
							<input  tabindex="3" type="password" class="passwordConf ui-corner-all" id="newpassword2" name="password2" maxlength="45" tabindex="7"  onchange="javascript:markDataAsChanged()" />
							<div id="passwordCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Pasword Check" title="If you type matching passwords a tick is shown here" /></div>
						</div>
					</fieldset>
					<fieldset class="userDetailsSub ui-corner-all">
					<legend class="ui-corner-all">Personal Details</legend>
						<br />
						<label for="firstname">Firstname</label>					
						<input  tabindex="4" type="text" class="firstname textSml ui-corner-all" name="firstname" id="firstname" maxlength="32" tabindex="2"  />
						<br />
						<label for="surname">Surname</label>					
						<input  tabindex="5" type="text" class="surname textSml ui-corner-all" name="surname" id="surname" maxlength="32" tabindex="3"  />
						<br />	
					</fieldset>
					<fieldset class="userDetailsBottom ui-corner-all">
					<legend class="ui-corner-all">Additional Details</legend>
						<br />
						
						<label for="email">email</label>
						<div class="inputHolderLarge ui-corner-all">
							<input  tabindex="6" type="text" class="email text ui-corner-all" name="email" id="email" maxlength="64" tabindex="5" onchange="javascript:emailChanged()" />
							<div id="emailCheck" class="checkImage"><img class="imgtip" src="/images/fam/information.png" alt="Email Check" title="If you change the email and it checks out ok a tick is displayed here" /></div>
						</div>
						<br />
						<label for="realname">Realname</label>
						<input  tabindex="7" type="text" class="realname text ui-corner-all" name="realname" id="realname" maxlength="64" tabindex="4" onchange="javascript:markDataAsChanged()" />
						
					</fieldset>
				</fieldset>

				<fieldset class="buttons ui-corner-all">
				<input type="hidden" value="true" name="add" /><br />
				<a href="javascript:saveChanges()"><img src="/images/buttons/save.png" alt="Save" /></a>
				<a href="/"><img src="/images/buttons/cancel.png" alt="Cancel" /></a>
				</fieldset>
	</div>
</form>