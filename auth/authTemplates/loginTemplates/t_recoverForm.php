<div id="info">
	<h1>Password Recovery</h1>
	<form method="post" action="/auth/recover.php" enctype="multipart/form-data" id="userForm">
		<fieldset class="recovery ui-corner-all">
			<legend class="ui-corner-all">Lost Password Recovery</legend>
			<br />
			<h3>Enter your e-mail address to begin recovery</h3>
			<br />
			<label for="email">Email or Username</label>
			<br />
			<input type="text" class="ui-corner-all" id="email" name="email" value="" size="30" maxlength="45" />
			<br />
			<input id="emailSend" type="image" src="/images/buttons/send.png" value="Send" />
		</fieldset>
	</form>
</div>
