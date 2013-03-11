<div id="loginHolder" class="ui-corner-all">
    <h1>Choose how to log in</h1>
    <div id="loginBody" class="ui-corner-all">
            <form method="post" action="" onsubmit="return checkLogonForm()">
            <fieldset class="ui-corner-all">
            <legend class="ui-corner-all">Reminder Users</legend>
             <label for="logname">Username</label>
             <br />
              <input type="text" name="logname" id="logname" class="logon ui-corner-all" />
              <br />
             <label for="pw">Password</label>
             <br />
            <input type="password" name="logpassword" id="pw" class="logon ui-corner-all" />
            <br />
            <input class="button" type="image" src="/images/buttons/login.png" value="submit" />
            </fieldset>
            </form>
    </div>
    <div id="fbLoginBody" class="ui-corner-all">
            <fieldset class="ui-corner-all">
            <br /><br /><br />
            <p>You can login using your facebook ID.</p>
            <p>For new users this saves the trouble of registration.</p>
            <br />
            <fb:login-button perms="email"></fb:login-button>
    </div>
</div>
<div id="loginFooter" class="ui-corner-all">
<p>Forgotten your password? You can reset your password using the automatic <a href="/auth/recover.php">Lost Password Recovery</a>.</p>
<br />
<br />
<p>Worried about giving out your e-mail address?? Check our <a href="/privacy.html" title="Little Reminder Privacy Policy">Privacy policy</a> for more details</p>
<p>Use of this site show acceptance of the <a href="/terms.html" title="Little Reminder Terms and Conditions">terms and conditions</a>.</p>

</div>