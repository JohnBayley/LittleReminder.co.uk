var pageUpdated = false;
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
	if(document.getElementById('newpassword1').value != document.getElementById('newpassword2').value)
		{
		alert("The new passwords do not match");
		return false
		}
	pageUpdated = false;	
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

function passwordChanged(){
	checkPassword();
	markDataAsChanged();
	$(".imgtip").tooltip()
}
