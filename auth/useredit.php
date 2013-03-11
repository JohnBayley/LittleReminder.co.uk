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

/* Login the user*/
	login();
	$breadcrumb = $l['defaultBreadcrumb'].' : '.'Edit my details';
	$useredit = include 	($authScripts .'s_useredit.php');
	$pageMessage = 'Edit Details';
	$navigationTemplate = include($authScripts.'s_authNavigation.php');
	$navTags = array(	'pageMessage' => 'Edit Details');


	$replaceTags = array(	'pageTitle' =>$l['userEditPageTitle'],
						 	'breadcrumb' => $breadcrumb,
							'java' => $authScripts.'j_useredit.php',
							'navigation' => $navigationTemplate,
							'rightColumn' => $authTemplates.'t_usereditRight.php',
							'main' => $useredit );

	createPage($replaceTags,NULL);
?>
