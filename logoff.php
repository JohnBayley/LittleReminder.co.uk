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
//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk

include $authApi.'authApi.php';

	$breadcrumb = $l['logoffBreadcrumb'];
	$pageMessage = 'Log Off';

unset ($_SESSION['username']);
unset ($_SESSION['password']);
unset ($_SESSION['userImage']);

	$replaceTags = array('title' => $l['LoggedOffTitle'],
	            'rightColumn' => $authTemplates.'loginTemplates/t_logoffRight.php',
				'main' => $authTemplates.'loginTemplates/t_logoff.php');
	createPage($replaceTags,$authTemplates."t_logoffTemplate.php");

?>
