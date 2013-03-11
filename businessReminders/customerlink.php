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
include($authScripts . 'functions.php');

/* Validate the user */
blogin();


$replaceTags = array(	'java' => $authScripts .'j_business.php',
				'title' => $l['IndexTitle'],
				'bar_message' => $l['IndexMessage'],
				'main' => $authScripts .'s_custlink.php',
				'navigation' => $authTemplates . 't_homepageNavigation.php');
createPage($replaceTags,NULL);
?>