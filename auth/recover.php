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

	$breadcrumb = $l['defaultBreadcrumb'].' : '.'Recover Lost details';
	$recover = include 	($authScripts .'s_recover.php');

	$replaceTags = array(	'pageTitle' =>$l['recoverPageTitle'],
						 	'pageMessage' => $l['recoverMessage'],
						 	'breadcrumb' => $breadcrumb,
							'java' => $authScripts.'j_recover.php',
							'rightColumn' => $recover['right'],
							'main' => $recover['main'] );

	createPage($replaceTags,NULL);
?>
