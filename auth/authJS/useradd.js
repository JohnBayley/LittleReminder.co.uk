var pageUpdated = false;
var validEmail = true;
var validUsername = true;
var lastDefaultRealname = "";
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
		document.getElementById('adduser').submit();
		}
}

function checkform(){
if (document.getElementById('newpassword1').value != '')
	{
	if(document.getElementById('newpassword1').value != document.getElementById('newpassword2').value)
		{
		alert("The new passwords do not match");
		return false
		}
	}

	if(document.getElementById('realname').value == '')
		{
		document.getElementById('realname').focus();
		
		alert("You need to enter your real name");
		return false
		}
	if (validUsername)
		{
		if(document.getElementById('username').value == "")
			{
			document.getElementById('username').focus(); 
			$('#username').addClass('errorField');
			alert("You are required to enter a username");
			return false
			}
		}
	else
		{
		document.getElementById('username').focus();
		$('#username').addClass('errorField');
		var test = document.getElementById('usernameCheck').innerHTML;
		if (test.indexOf("error") != -1)
			{
			alert("This username is already used");
			}
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
function checkUsername(){
	var username = document.getElementById('username').value;
	if (username != '')
		{
		document.getElementById('usernameCheck').innerHTML = '<img class="imgtip" src="/auth/authCSS/images/loadingSmall.gif" alt="Checking" title="Checking the username" />';
		$.ajax({
		  url: "/auth/authAjax/ax_checkUniqueUsername.php",
		  data: {username : username},
		  context: document,
		  dataType: 'html',
		  success: function(data) {
									$('#usernameCheck').html(data);
									$(".imgtip").tooltip();
									if (data.indexOf("tick") != -1)
										{
										validUsername = true;
										}
									else
										{
										validUsername = false;
										}
								  }
			});
		}
	else
		{
		document.getElementById('usernameCheck').innerHTML = '<img class="imgtip" src="/images/fam/information.png" alt="Username Check" title="If the username is available a tick is shown here." />';
		validUsername = false;
		}

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

function defaultRealName(){
var firstname = document.getElementById('firstname').value;
var surname = document.getElementById('surname').value;
var realname = document.getElementById('realname').value;
var defaultRealname = firstname + ' ' + surname;

if (realname == "" || realname == lastDefaultRealname)
	{
	document.getElementById('realname').value = defaultRealname;
	lastDefaultRealname = defaultRealname;
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
function firstnameChanged(){
	defaultRealName()
	markDataAsChanged();
}
function surnameChanged(){
	defaultRealName()
	markDataAsChanged();
}
function realnameChanged(){
	
	markDataAsChanged();
}
function usernameChanged(){
	checkUsername();
	markDataAsChanged();
}