<?php 

/* Set the security flag */
define('AUTHdbSEC', true);

/* Start a php session */
session_start();

/* Load common configuration */
include('reminderCommon.php');

/* Load the common functions for authentication */
include($authScripts . 'functions.php');

/* Test for adding a new user and if so enter details to db */
if ( isset ($_REQUEST['add']))
	{
	$replaceTags = array('title' => 'Authentication System db - Add a new user to the database',
		'bar_message' => 'Add a new user',
		'main' => $authScripts . 's_insert_buser.php');
	}
/* Test for di flag indicating a user account to be authenticated */
elseif ( isset ($_REQUEST['di']))
	{
	$replaceTags = array('title' => 'Authentication System db - Enable a user account',
		'bar_message' => 'Enable a new user',
		'main' => $authScripts . 's_enable_user.php');
	}
/* Test for reconfirm request */
elseif ( isset ($_REQUEST['reconfirm']))
	{
	$replaceTags = array('title' => 'Authentication System db - resend confirmation mail',
		'bar_message' => 'Resend confirmation',
		'main' => $authScripts . 's_confirm.php');
	}
/* Fallthrough to display registration page */
else
	{
	$replaceTags = array('title' => 'Authentication System db - Add a new user to the database',
		'java' => $authScripts . 'j_checkadd.php',
		'bar_message' => 'Register a new user',
		'main' => $authScripts . 's_add_business.php');
	}
createPage($replaceTags,NULL);
?>
