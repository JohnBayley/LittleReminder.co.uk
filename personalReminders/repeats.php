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
$breadCrumb = "<a href='/'>Home</a> :: <a href='/personalReminders/repeats.php'>Repeats</a>";
$updateResults = '';

if (isset($_REQUEST['updateRepeats']))
    {
    $updateResults = include ($reminderScripts.'s_manageRepeats.php');
    }
$java = parse ($reminderScripts.'j_repeats.php');
$java = $java . '<script type="text/javascript">$(document).ready(function() {'.$updateResults."});</script>";

/* Validate the user */
login();


$replaceTags = array(	'java' => $java,
		
				'title' => 'Reminder repeats',
						'bar_message' => 'Reminder repeat manager',
		
				'breadCrumb' => $breadCrumb,
						'main' => $reminderScripts .'s_repeats.php',
		
				'navigation' => $reminderTemplates . 't_repeatsLeft.php',
		                'rightColumn' => $reminderTemplates . 't_repeatsRight.php',);
createPage($replaceTags,$reminderTemplates . 't_reminderRepeatMain.php');
?>