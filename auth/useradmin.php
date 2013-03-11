<?php 

/* Set the security flag */
define('AUTHdbSEC', true);


/* Start a php session */
session_start();


/* Load common configuration */
include('reminderCommon.php');


/* Load the common functions for authentication */
include($authApi . 'authFunctions.php');

/* Ensure admin only access */
loginAdmin();

	if ((isset ($_REQUEST['delete']))&&($_REQUEST['delete'] != 'admin'))
		{
		
		$replaceTags = array('title' => $l['DelTitle'],
			'java' => '',
			'bar_message' =>$l['DelMessage'] ,
			'main' => $authScripts .'s_delete_user.php',
			'navigation' => $authTemplates . 't_navigation.php');
		}
	
	elseif (isset ($_REQUEST['username']))
		{
		
		$replaceTags = array('title' => $l['AdminEditTitle'],
			'java' => $authScripts .'j_admintools.php',
			'bar_message' => $l['AdminEditMessage'],
			'main' => $authScripts .'s_admin_user.php',
			'navigation' => $authTemplates . 't_navigation.php');
		}
	else
		{
		
		$replaceTags = array('title' => $l['AdminListTitle'],
			'java' => '',
			'bar_message' => $l['AdminListMessage'],
			'main' => $authScripts .'s_list_users.php',
			'navigation' => $authTemplates . 't_navigation.php');
		}
	
createPage($replaceTags,NULL);
?>
