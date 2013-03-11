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
		'main' => $authScripts . 's_insert_customer.php');
	}

/* Fallthrough to display customer addition page */
else
	{
	$replaceTags = array('title' => 'Authentication System db - Add a new user to the database',
		'java' => $authScripts . 'j_bcheckadd.php',
		'bar_message' => 'Register a new user',
		'main' => $authScripts . 's_add_buser.php');
	}
createPage($replaceTags,NULL);
?>
