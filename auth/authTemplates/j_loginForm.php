<script type="text/javascript">

function checkLogonForm (){
	if (document.getElementById('logname').value == "")
		{
		alert("Please enter your username or email address");
		document.getElementById('logname').focus();
		return false;
		}
	if (document.getElementById('pw').value == "")
		{
		alert("Please enter your password");
		document.getElementById('pw').focus();
		return false;
		}
	return true;

}
	$(document).ready(function() {
		document.getElementById('logname').focus();
	});	
</script>
