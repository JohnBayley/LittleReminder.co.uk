<?php

/* The main index page which is used to front the authentication.				*/
/* Authentication is dull so the homepage for the chosen application is called 	*/
/* which should require a login, otherwise why use auth :-) 					*/
/* Set the security flag */
define('AUTHdbSEC', true);
/* Start a php session */
session_start();
/* Load common configuration */
include('reminderCommon.php');
/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');
/* Load the auth api */
include $authApi.'authApi.php';
$breadCrumb = "<a href='/'>Home</a> :: <a href='/personalReminders/reminderPlan.php'>Reminder Plan</a>";
$updateResults = '';

$java = $reminderScripts .'j_reminderPlan.php';

/* Validate the user */
login();


$replaceTags = array(	'java' => $java,
		
				'title' => 'Reminder email Plan',
						'bar_message' => 'Reminder Plan',
		
				'breadCrumb' => $breadCrumb,
						'main' => $reminderScripts .'s_reminderPlan.php',
		
				'navigation' => '',
		                'leftColumn' => $reminderTemplates .'t_reminderPlanLeft.php',
		                'rightColumn' => $reminderTemplates .'t_reminderPlanRight.php');
createPage($replaceTags,$reminderTemplates . 't_reminderPlanMin.php');
?>