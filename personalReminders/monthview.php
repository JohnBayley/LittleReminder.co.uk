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
$breadCrumb = "<a href='/'>Home</a> :: <a href='/personalReminders/'>Reminders</a>";

/* Validate the user */
login();


$replaceTags = array(	'java' => $reminderScripts.'j_reminder.php',
		
				'title' => $l['IndexTitle'],
						'bar_message' => $l['IndexMessage'],
		
				'breadCrumb' => $breadCrumb,
						'main' => $reminderTemplates .'t_reminder_main.php',
		
				'navigation' => $reminderTemplates . 't_homepageNavigation.php');
createPage($replaceTags,$reminderTemplates.'t_reminder_template.php');
?>