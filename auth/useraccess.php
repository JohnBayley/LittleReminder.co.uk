<?php 

include('reminderCommon.php');
include($authApi . 'authFunctions.php');
/* Load the auth api */
include $authApi.'authApi.php';
login();
$replaceTags = array(	'title' => $l['EditTitle'],
				'java' => $authScripts .'j_access.php',
				'bar_message' => $l['EditMessage'],
				'main' => $authScripts .'s_edit_access.php',
				'navigation' => $authTemplates . 't_navigation.php');
createPage($replaceTags,NULL);
?>
