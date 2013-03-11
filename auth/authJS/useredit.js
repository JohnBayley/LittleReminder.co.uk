var pageUpdated = false;
var validEmail = true;
window.onbeforeunload = confirmExit;
function confirmExit()
	{
  	if (pageUpdated)
  		{
    	return 'If you leave now you will loose your changes.';
  		}
	}

function markDataAsChanged(){
	pageUpdated = true;
}

function saveChanges() {
	if (checkform())
		{
		document.getElementById('edituser').submit();
		}
}

function checkform(){
if (document.getElementById('oldpassword').value != '')
	{
	if(document.getElementById('newpassword1').value != document.getElementById('newpassword2').value)
		{
		alert("The new passwords do not match");
		return false
		}
	}
	if (document.getElementById('oldpassword').value == '' && document.getElementById('newpassword1').value != '')
		{
		alert("You need to ener your old password\n to change the password.");
		return false
		}
	if(document.getElementById('realname').value == '')
		{
		document.getElementById('realname').focus();
		
		alert("You need to enter your real name");
		return false
		}
	if (validEmail)
		{
		if(document.getElementById('email').value == "")
			{
			document.getElementById('email').focus();
			$('#email').addClass('errorField');
			alert("You are required to enter a valid e-mail address");
			return false
			}
		else if (echeck(document.getElementById('email').value)==false)
			{
			document.getElementById('email').focus();
			$('#email').addClass('errorField');
			alert("The e-mail address you entered is not valid");
			return false
			}
		}
	else
		{
		document.getElementById('email').focus();
		$('#email').addClass('errorField');
		var test = document.getElementById('emailCheck').innerHTML;
		if (test.indexOf("error") != -1)
			{
			alert("The e-mail address you entered is not unique");
			}
		else
			{
			alert("The e-mail address you entered is not valid");
			}
		return false
		}
	pageUpdated = false;	
	return true
}
function echeck(str) {
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
		return false
		}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		return false
		}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		return false
		}
	if (str.indexOf(at,(lat+1))!=-1){
		return false
		}
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		return false
		}
	if (str.indexOf(dot,(lat+2))==-1){
		return false
		}
	if (str.indexOf(" ")!=-1){
		return false
		}
	return true					
}

function checkPassword(){
	if (document.getElementById('newpassword1').value == document.getElementById('newpassword2').value)
		{
		document.getElementById('passwordCheck').innerHTML = '<img class="imgtip" src="/images/fam/tick.png" alt="Pasword ok" title="The passwords are correct" />';
		}
	else
		{
		document.getElementById('passwordCheck').innerHTML = '<img class="imgtip" src="/images/fam/cancel.png" alt="Paswords do not match" title="The passwords do not match" />';
		}
	$(".imgtip").tooltip();	
}

function checkEmail(){
	var username = document.getElementById('username').value;
	var email = document.getElementById('email').value;
	if (echeck(email))
		{
		document.getElementById('emailCheck').innerHTML = '<img class="imgtip" src="/auth/authCSS/images/loadingSmall.gif" alt="Checking" title="Checking the email address" />';
		$.ajax({
		  url: "/auth/authAjax/ax_checkUniqueEmail.php",
		  data: {username : username, email: email},
		  context: document,
		  dataType: 'html',
		  success: function(data) {
			$('#emailCheck').html(data);
			$(".imgtip").tooltip();
			if (data.indexOf("tick") != -1)
				{
				validEmail = true;
				}
			else
				{
				validEmail = false;
				}
		  }
		});

		
		}
	else
		{
		document.getElementById('emailCheck').innerHTML = '<img class="imgtip" src="/images/fam/cancel.png" alt="Bad Email" title="The email address is not valid." />';
		validEmail = false;
		$(".imgtip").tooltip();
		}
}
function passwordChanged(){
	checkPassword();
	markDataAsChanged();
}
function emailChanged(){
	checkEmail();
	markDataAsChanged();
}