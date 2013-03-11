<?php

/* Set the security flag */

/* This is required to enable functions and active pages */
define('AUTHdbSEC', true);
/* Start a php session */
session_start();
/* Load the common access and setup */
include 'reminderCommon.php';
/* Load the common auth functions */
include $authApi.'authFunctions.php';
/* Load the auth api */
include $authApi.'authApi.php';

	$breadcrumb = $l['defaultBreadcrumb'].' : '.'New User';
	
	$java = $authScripts.'j_useradd.php';

/* Test for adding a new user and if so enter details to db */
if ( isset ($_REQUEST['add']))
	{
	$title= $l['insertUserTitle'];
	$message= $l['insertUserMessage'];
	include $authScripts.'s_insertUser.php';
	$insertResults = sInsertUser();
	$rightColumn = $insertResults['right'];
	$useradd = $insertResults['main']; 
	}

/* Test for di flag indicating a user account to be authenticated */
elseif ( isset ($_REQUEST['di']))
	{
	$title= $l['emailConfirmedTitle'];
	$message= $l['emailConfirmedMessage'];
	$resultSet = include $authScripts . 's_enableUser.php';
	$useradd = $resultSet['main'];
	$rightColumn = $resultSet['rightColumn'];
	}

/* Test for reconfirm request */
elseif ( isset ($_REQUEST['reconfirm']))
	{
	$title= $l['confirmTitle'];
	$message= $l['confirmMessage'];
	$reConfirm = include $authScripts . 's_sendConfirmation.php';
	$rightColumn = $reConfirm['right'];
	$useradd = $reConfirm['main'];
	
	}

/* Fallthrough to display registration page */
else
	{
	$title= $l['addFormTitle'];
	$message= $l['addFormMessage'];
	$rightColumn = $authTemplates.'t_addUserFormRight.php';
	$useradd = include $authScripts . 's_addUser.php';
	}
$replaceTags = array(	'pageTitle' =>$title,
						'pageMessage' => $message,
						'breadcrumb' => $breadcrumb,
						'java' => $java,
						'rightColumn' => $rightColumn,
						'main' => $useradd );

createPage($replaceTags,NULL);
?>
