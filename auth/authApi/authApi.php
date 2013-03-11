<?php

function getUserRealName ($username) {
/* Load and return the users realname */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot get user details without the username');
		}

	include 'authSql.php';
	$result = mysql_query($getUserDetailsSql) or die('Could not successfully run unique email query ($getUserDetailsSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['realname']);
}
function getUserId ($username) {
/* Load and return the users realname */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot get user details without the username');
		}

	include 'authSql.php';
	$result = mysql_query($getUserDetailsSql) or die('Could not successfully run unique email query ($getUserDetailsSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['userid']);
}
function getUserLastLogin ($username) {
/* Load and return the users realname */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot get user details without the username');
		}

	include 'authSql.php';
	$result = mysql_query($getUserDetailsSql) or die('Could not successfully run unique email query ($getUserDetailsSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['lastlogin']);
}

function getUsers($org){
/* Load the common access and setup */
include 'authCommon.php';
	if (!isset($org))
		{
		die ('getusers: Cannot retrieve users without a valid org code');
		}
	$users = "";

	$username = $_SESSION['username'];
	include $authApi.'authSql.php';
	/* Query the database */
	$result = mysql_query($getUsersSql);
	$count = 0;
	while($row = mysql_fetch_assoc($result))
		{
			if ($count > 0)
				{
				$users .= ' , ';
				}
			$users .= '{	value: "'.$row['username'].'",
							label: "'.$row['realname'].'"}';
		$count++;
		}

	return $users;
}
function recoverDetailsCheck($username,$jbepw){
	if (!isset($username) || $username == '')
		{
		die ('Cannot recover details without the username');
		}
	if (!isset($jbepw) || $jbepw == '')
		{
		die ('Cannot recover details without the password');
		}
	include 'authSql.php';
	$result = mysql_query($recoveryTestSql) or die('Could not successfully run recovery check query ($recoveryTestSql) from DB: ' . mysql_error());
	return ($result);
}

function recoverDetails($username,$jbepw){
	if (!isset($username) || $username == '')
		{
		die ('Cannot recover details without the username');
		}
	if (!isset($jbepw) || $jbepw == '')
		{
		die ('Cannot recover details without the password');
		}
	include 'authSql.php';
	/* Load and return the users realname */
	$result = mysql_query($recoverySql) or die("Could not successfully run query ($recoverySql) from DB: " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$details = array(	'username'		=>$row['username'],
						'realname'		=>$row['realname'],
						'firstname'		=>$row['firstname'],
						'surname'		=>$row['surname'],
						'password'		=>$row['password'],
						'email'			=>$row['email']);
	return ($details);
}

function checkUniqueUsername ($username) {
/* Load and return the users realname */

	if (!isset($username) || $username == '')
		{
		die ('Cannot check details without a username');
		}
	include 'authSql.php';
	$result = mysql_query($uniqueUsernameCheckSql) or die('Could not successfully run unique username query ($uniqueUsernemCheckSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['usernameCount'] == 0);
}
function checkAccountExistsFB($fbUsername, $fbEmail) {
/* Test to see if the user exists when using facebook login */

	include 'authSql.php';
	$result = mysql_query($fbUserCheckSql) or die('checkAccountExistsFB: Could not successfully run user test query ($fbUserCheckSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['userCount']);
}
function checkAccountExistsButNotLocalisedFB($fbUsername) {
/* Test to see if the user exists when using facebook login */

	include 'authSql.php';
	$result = mysql_query($fbUserCheckNotLocalisedSql) or die('checkAccountExistsButNotLocalisedFB: Could not successfully run user test query ($fbUserCheckSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['userCount']);
}
function createFBAccount($fbUsername,$fbFirstName,$fbSurname,$fbName,$fbEmail){
    if (insertUser($fbUsername,md5('facebook'),$fbEmail,$fbName,$fbFirstName,$fbSurname) == 1)
        {
        $update = updateConfirmation ($fbUsername);
        }

}
function checkUniqueEmail ($email) {
/* check for unique email */
	if (!isset($email) || $email == '')
		{
		die ('Cannot check details without an email address');
		}

	include 'authSql.php';
	$result = mysql_query($uniqueEmailCheckSql) or die('Could not successfully run query ($uniqueEmailCheckSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['emailCount'] == 0);
}

function updateConfirmation ($username) {
	if (!isset($username) || $username == '')
		{
		die ('updateConfirmation: Cannot update without a username.');
		}

	include 'authSql.php';
	$result = mysql_query($updateUserConfirmationSql) ;
	return (mysql_affected_rows());
}


function checkUniqueUserEmail ($username,$email) {
/* check for unique email not including this user */
	if (!isset($email) || $email == '')
		{
		die ('Cannot check details without an email address');
		}
	if (!isset($username) || $username == '')
		{
		die ('Cannot check details without a username');
		}
	include 'authSql.php';
	$result = mysql_query($uniqueUserEmailCheckSql) or die('Could not successfully run query ($uniqueUserEmailCheckSql) from DB: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	return ($row['emailCount'] == 0);
}
function getAllUserDetails ($username) {
/* Load and return the user details*/
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot get user details without the username');
		}
	include 'authSql.php';
	/* Load and return the users realname */
	$result = mysql_query($getUserDetailsSql) or die("Could not successfully run query ($getUserDetailsSql) from DB: " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$details = array(	'userid'		=>$row['userid'],
	                    'username'		=>$row['username'],
						'realname'		=>$row['realname'],
						'firstname'		=>$row['firstname'],
						'surname'		=>$row['surname'],
						'password'		=>$row['password'],
						'email'			=>$row['email']);
	return ($details);
	}



function updateUserPassword($username,$newPassword,$oldPassword) {
/* Update the users password */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot update user details without the username');
		}
	if (!isset($newPassword) || $newPassword == '')
		{
		die ('Cannot update password when the new password is blank');
		}
	if (!isset($oldPassword) || $oldPassword == '')
		{
		die ('Cannot update password when the old password is blank');
		}
	include 'authSql.php';
	$result = mysql_query($updateUserPasswordSql)or die("Could not successfully run query ($updateUserPasswordSql) from DB: " . mysql_error());
	return (mysql_affected_rows());
}

function updateUserEmail($username,$email) {
/* Update the users email */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot update user details without the username');
		}

	if (!isset($email) || $email == '')
		{
		die ('Cannot update without an email');
		}
	include 'authSql.php';
	$result = mysql_query($updateUserEmailSql)or die("Could not successfully run query ($updateUserEmailSql) from DB: " . mysql_error());
	return (mysql_affected_rows());
}
function updateUserConfirmation($username,$eusername) {
/* Update the users account confirmation */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot update user details without the username');
		}

	include 'authSql.php';
	$result = mysql_query($updateUserConfirmationSql)or die("Could not successfully run confirmation Update query ($updateUserConfirmationSql) from DB: " . mysql_error());
	return (mysql_affected_rows());
}
function updateUserRealname($username,$realname) {
/* Update the users password */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('Cannot update user details without the username');
		}
	if (!isset($realname) || $realname == '')
		{
		die ('Cannot update without a realname');
		}
	include 'authSql.php';
	$result = mysql_query($updateUserRealnameSql)or die("Could not successfully run query ($updateUserRealnameSql) from DB: " . mysql_error());
	return (mysql_affected_rows());
}
function insertUser($username,$password,$email,$realname,$firstname,$surname) {
/* insert the user */
	// include 'authCommon.php';
	if (!isset($username) || $username == '')
		{
		die ('insertUser: Cannot insert user without a username');
		}
	if (!isset($password) || $password == '')
		{
		die ('insertUser: Cannot insert user without a password');
		}
	if (!isset($email) || $email == '')
		{
		die ('insertUser: Cannot insert user without an email address');
		}

	include 'authSql.php';
	$result = mysql_query($insertUserSql)or die("Could not successfully run query ($insertUserSql) from DB: " . mysql_error());
	return (mysql_affected_rows());
}
function gritterMessage($title,$message){
	$alert = ('<script type="text/javascript">
				$(document).ready(function() {	$.gritter.add({
												title: "'.$title.'",
												text: "'.$message.'"});
											});
				</script>');
	return($alert);
}

?>