<?php

function sInsertUser()
	{
	/* Load common configuration */
	include('reminderCommon.php');

	/* Test for the security flag */
	secureCheck();

	//Get transfered data
	$username = mysql_real_escape_string($_REQUEST['username']);
	$password = md5(mysql_real_escape_string($_REQUEST['password1']));
    $firstname = mysql_real_escape_string($_REQUEST['firstname']);
	$surname = mysql_real_escape_string($_REQUEST['surname']);
	$realname = mysql_real_escape_string($_REQUEST['realname']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$title = 'Tester';
	$org= 'default';
	$now = date("Y-m-d H:i:s");
	$pageData = '';
	$taglist = array(	'username'		=>$username,
						'firstname'		=>$firstname,
						'surname'		=>$surname,
						'realname'		=>$realname,
						'email'			=>$email);
	//Confirm unique username
	if (! checkUniqueUsername ($username))
		{
		$includeFile = file_get_contents ( $authTemplates."loginTemplates/t_insertUserExists.php");
		$includeFileRight = file_get_contents ( $authTemplates."loginTemplates/t_insertUserExistsRight.php");
		$ERROR_REPORTED = 1;
		}
	//Confirm unique email
	if (! checkUniqueEmail ($email))
		{
		$includeFile = file_get_contents ( $authTemplates."loginTemplates/t_insertEmailExists.php");
		$includeFileRight = file_get_contents ( $authTemplates."loginTemplates/t_insertEmailExistsRight.php");
		$ERROR_REPORTED = 1;
		}

	if (! isset ($ERROR_REPORTED))
		{
		$insertCount = insertUser($username,$password,$email,$realname,$firstname,$surname,$title);
		/* Send confirmation email */

		$confirmResult = include $authScripts.'s_sendConfirmation.php';
		$includeFile = $confirmResult['main'];
		$includeFileRight = $confirmResult['right'];
		}
	else
		{

		foreach ($taglist as $tag => $data)
			{
			$includeFile = eregi_replace('{'.$tag.'}', $data ,$includeFile);
			}
		}

	$userInsertTags = array(	'main'		=>$includeFile,
								'right'		=>$includeFileRight);
	return $userInsertTags;
	}
?>