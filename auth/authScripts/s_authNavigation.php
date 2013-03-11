<?php
	/* Test for the security flag */
	secureCheck();
	$userRealName = '';
	if (! isset($pageMessage))
		{
		$pageMessage = 'Authentication';
		}
	if (isset($_SESSION['userid'])&& $_SESSION['userid'] != '')
		{
		$userRealName = getUserRealName ($_SESSION['userid']);
		}
	$replaceTags = array(	'realname' => $userRealName,
							'pageMessage' => $pageMessage);
	return ( createMinimalPage($replaceTags,$authTemplates.'navigationTemplates/t_defaultNavigation.php'));
?>